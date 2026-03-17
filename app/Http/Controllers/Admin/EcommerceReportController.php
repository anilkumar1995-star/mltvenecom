<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\Order;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcommerceReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfDay();

        if ($request->has('date_range')) {
            $dates = explode(' to ', $request->date_range);
            if (count($dates) == 2) {
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();
            } elseif(count($dates) == 1) {
                 $startDate = Carbon::parse($dates[0])->startOfDay();
                 $endDate = Carbon::parse($dates[0])->endOfDay();
            }
        }

        $dateRange = $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d');

        // --- 10 Widgets Data ---
        $ordersQuery = Order::whereBetween('created_at', [$startDate, $endDate]);
        $revenue = (float) $ordersQuery->sum('amount');
        $taxAmount = (float) $ordersQuery->sum('tax_amount');
        $ordersCount = $ordersQuery->count();
        $averageOrderValue = $ordersCount > 0 ? $revenue / $ordersCount : 0;

        $productStats = DB::table('ec_order_product')
            ->join('ec_orders', 'ec_order_product.order_id', '=', 'ec_orders.id')
            ->join('ec_products', 'ec_order_product.product_id', '=', 'ec_products.id')
            ->whereBetween('ec_orders.created_at', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(ec_order_product.qty * ec_order_product.price) as total_sales'),
                DB::raw('SUM(ec_order_product.qty * COALESCE(ec_products.cost_per_item, 0)) as total_cost')
            )
            ->first();

        $expenses = (float) ($productStats->total_cost ?? 0);
        $profit = (float) (($productStats->total_sales ?? 0) - $expenses);

        $customersCount = Customer::whereBetween('created_at', [$startDate, $endDate])->count();
        $productsCount = EcProduct::count();

        $reviewsData = DB::table('ec_reviews')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('COUNT(*) as count'), DB::raw('AVG(star) as avg'))
            ->first();
        $reviewsCount = (int) $reviewsData->count;
        $reviewsAvg = (float) $reviewsData->avg;

        $conversionRate = $customersCount > 0 ? ($ordersCount / $customersCount) * 100 : 0;
        if($conversionRate > 100) $conversionRate = 100;

        // --- Tables ---
        $recentOrders = Order::with(['user', 'payment'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $topProducts = EcProduct::join('ec_order_product', 'ec_products.id', '=', 'ec_order_product.product_id')
            ->join('ec_orders', 'ec_order_product.order_id', '=', 'ec_orders.id')
            ->whereBetween('ec_orders.created_at', [$startDate, $endDate])
            ->select('ec_products.id as product_id', 'ec_products.name', DB::raw('SUM(ec_order_product.qty) as total_qty'))
            ->groupBy('ec_products.id', 'ec_products.name')
            ->orderBy('total_qty', 'desc')
            ->take(10)
            ->get();

        $trendingProducts = EcProduct::orderBy('views', 'desc')->take(10)->get();

        return view('admin-layouts.reports.index', compact(
            'revenue', 'profit', 'expenses', 'averageOrderValue', 'taxAmount',
            'ordersCount', 'customersCount', 'productsCount', 'reviewsCount', 'reviewsAvg', 'conversionRate',
            'recentOrders', 'topProducts', 'trendingProducts', 'dateRange'
        ));
    }

    public function getRevenueChartData(Request $request)
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfDay();

        if ($request->has('date_range')) {
            $dates = explode(' to ', $request->date_range);
            if (count($dates) == 2) {
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();
            }
        }

        $dates = [];
        $dataMap = [];
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->toDateString();
            $dates[] = $currentDate->format('M d');
            $dataMap[$dateStr] = [
                'revenue' => 0,
                'profit' => 0,
                'expenses' => 0,
                'orders' => 0,
                'customers' => 0,
                'returning_customers' => 0,
            ];
            $currentDate->addDay();
        }

        // Daily Orders & Revenue
        $dailyOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(amount) as revenue, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        foreach ($dailyOrders as $item) {
            if (isset($dataMap[$item->date])) {
                $dataMap[$item->date]['revenue'] = (float) $item->revenue;
                $dataMap[$item->date]['orders'] = (int) $item->count;
            }
        }

        // Daily Customers
        $dailyCustomers = Customer::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        foreach ($dailyCustomers as $item) {
            if (isset($dataMap[$item->date])) {
                $dataMap[$item->date]['customers'] = (int) $item->count;
            }
        }

        // Daily Financials (Profit/Ex)
        $dailyFinancials = DB::table('ec_order_product')
            ->join('ec_orders', 'ec_order_product.order_id', '=', 'ec_orders.id')
            ->join('ec_products', 'ec_order_product.product_id', '=', 'ec_products.id')
            ->whereBetween('ec_orders.created_at', [$startDate, $endDate])
            ->selectRaw('DATE(ec_orders.created_at) as date,
                         SUM(ec_order_product.qty * ec_order_product.price) as sales,
                         SUM(ec_order_product.qty * COALESCE(ec_products.cost_per_item, 0)) as cost')
            ->groupBy('date')
            ->get();

        foreach ($dailyFinancials as $item) {
            if (isset($dataMap[$item->date])) {
                $sales = (float) $item->sales;
                $cost = (float) $item->cost;
                $dataMap[$item->date]['expenses'] = $cost;
                $dataMap[$item->date]['profit'] = $sales - $cost;
            }
        }

        // Flatten for JS
        $revenueData = []; $profitData = []; $expensesData = []; $ordersData = []; $customersData = [];
        foreach ($dataMap as $row) {
            $revenueData[] = $row['revenue'];
            $profitData[] = $row['profit'];
            $expensesData[] = $row['expenses'];
            $ordersData[] = $row['orders'];
            $customersData[] = $row['customers'];
        }

        // 1. Category Sales
        $categorySales = DB::table('ec_product_categories')
            ->join('ec_product_category_product', 'ec_product_categories.id', '=', 'ec_product_category_product.category_id')
            ->join('ec_order_product', 'ec_product_category_product.product_id', '=', 'ec_order_product.product_id')
            ->join('ec_orders', 'ec_order_product.order_id', '=', 'ec_orders.id')
            ->whereBetween('ec_orders.created_at', [$startDate, $endDate])
            ->select('ec_product_categories.name', DB::raw('SUM(ec_order_product.qty * ec_order_product.price) as total'))
            ->groupBy('ec_product_categories.id', 'ec_product_categories.name')
            ->get();

        // 2. Order Statuses
        $orderStatuses = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // 3. Payment Methods
        $paymentMethods = DB::table('ec_orders')
            ->join('payments', 'ec_orders.payment_id', '=', 'payments.id')
            ->whereBetween('ec_orders.created_at', [$startDate, $endDate])
            ->select('payments.payment_channel as payment_method', DB::raw('count(*) as total'))
            ->groupBy('payments.payment_channel')
            ->get();

        // 4. Shipping Methods
        $shippingMethods = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('shipping_method', DB::raw('count(*) as total'))
            ->groupBy('shipping_method')
            ->get();

        return response()->json([
            'dates' => $dates,
            'revenue' => $revenueData,
            'profit' => $profitData,
            'expenses' => $expensesData,
            'orders' => $ordersData,
            'customers' => $customersData,
            'categorySales' => $categorySales,
            'orderStatuses' => $orderStatuses,
            'paymentMethods' => $paymentMethods,
            'shippingMethods' => $shippingMethods
        ]);
    }
}

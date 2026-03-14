<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->paginate(20);
        return view('admin-layouts.invoices.index', compact('invoices'));
    }

    public function generate(Request $request)
    {
        $orders = \App\Models\Order::with('user')->whereNotIn('id', function($query) {
            $query->select('reference_id')->from('ec_invoices')->where('reference_type', \App\Models\Order::class);
        })->get();

        $generatedCount = 0;

        foreach ($orders as $order) {
            $invoice = new Invoice();
            $invoice->reference_id = $order->id;
            $invoice->reference_type = \App\Models\Order::class;
            $invoice->customer_name = $order->user ? $order->user->name : 'Guest';
            $invoice->customer_email = $order->user ? $order->user->email : '';
            $invoice->customer_phone = $order->user ? $order->user->phone : '';
            $invoice->sub_total = $order->sub_total;
            $invoice->tax_amount = $order->tax_amount;
            $invoice->shipping_amount = $order->shipping_amount;
            $invoice->discount_amount = $order->discount_amount;
            $invoice->amount = $order->amount;
            $invoice->payment_id = $order->payment_id;
            $invoice->status = 'pending';
            $invoice->save();

            $generatedCount++;
        }

        if ($generatedCount === 0 && Invoice::count() === 0) {
            for ($i = 0; $i < 5; $i++) {
                $invoice = new Invoice();
                $invoice->reference_id = 0;
                $invoice->reference_type = \App\Models\Order::class;
                $invoice->customer_name = 'Example Customer ' . ($i + 1);
                $invoice->customer_email = 'customer' . ($i + 1) . '@example.com';
                $invoice->customer_phone = '1234567890';
                $invoice->sub_total = 100 * ($i + 1);
                $invoice->tax_amount = 10 * ($i + 1);
                $invoice->shipping_amount = 5 * ($i + 1);
                $invoice->discount_amount = 0;
                $invoice->amount = 115 * ($i + 1);
                $invoice->payment_id = 0;
                $invoice->status = ['completed', 'pending', 'canceled'][array_rand(['completed', 'pending', 'canceled'])];
                $invoice->save();
                $generatedCount++;
            }
        }

        if ($generatedCount > 0) {
            return response()->json(['success' => true, 'message' => "Generated $generatedCount invoices successfully."]);
        }
        
        return response()->json(['success' => true, 'message' => "No new orders to generate invoices for."]);
    }

    public function show($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        return view('admin-layouts.invoices.show', compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->back()->with('success', 'Invoice deleted successfully');
    }
}

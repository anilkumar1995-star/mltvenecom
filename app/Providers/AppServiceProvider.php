<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Share admin navigation and basic dashboard stats with admin views
        View::composer('admin.*', function ($view) {
            $nav = [
                ['title' => 'Dashboard', 'url' => url('/admin')],
                [
                    'title' => 'Ecommerce',
                    'url' => url('/admin/ecommerce'),
                    'children' => [
                        ['title' => 'Report', 'url' => url('/admin/ecommerce/report')],
                        ['title' => 'Orders', 'url' => url('/admin/ecommerce/orders')],
                        ['title' => 'Incomplete orders', 'url' => url('/admin/ecommerce/incomplete')],
                        ['title' => 'Order returns', 'url' => url('/admin/ecommerce/returns')],
                        ['title' => 'Shipments', 'url' => url('/admin/ecommerce/shipments')],
                        ['title' => 'Invoices', 'url' => url('/admin/ecommerce/invoices')],
                        ['title' => 'Products', 'url' => url('/admin/products')],
                        ['title' => 'Product Prices', 'url' => url('/admin/products/prices')],
                        ['title' => 'Product Inventory', 'url' => url('/admin/products/inventory')],
                    ],
                ],
                [
                    'title' => 'Product Specification',
                    'url' => url('/admin/product-spec'),
                    'children' => [
                        ['title' => 'Groups', 'url' => url('/admin/product-spec/groups')],
                        ['title' => 'Attributes', 'url' => url('/admin/product-spec/attributes')],
                        ['title' => 'Tables', 'url' => url('/admin/product-spec/tables')],
                    ],
                ],
                ['title' => 'Pages', 'url' => url('/admin/pages')],
                ['title' => 'Blog', 'url' => url('/admin/blog')],
                ['title' => 'Settings', 'url' => url('/admin/settings')],
            ];

            $stats = [
                'orders' => Schema::hasTable('orders') ? DB::table('orders')->count() : 0,
                'products' => Schema::hasTable('products') ? DB::table('products')->count() : 0,
                'customers' => Schema::hasTable('users') ? User::count() : 0,
                'reviews' => Schema::hasTable('reviews') ? DB::table('reviews')->count() : 0,
            ];

            $view->with('adminNav', $nav)->with('adminStats', $stats);
        });
    }
}

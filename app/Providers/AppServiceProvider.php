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
        // Share footer settings with all views globally
        try {
            $footer_settings = DB::table('footer_settings')->first();
            View::share('footer_settings', $footer_settings);
            
        } catch (\Exception $e) {
            View::share('footer_settings', null);
        }

        Schema::defaultStringLength(191);

        \Illuminate\Database\Eloquent\Relations\Relation::morphMap([
            'Botble\Blog\Models\Post' => \App\Models\Post::class ,
        ]);

        // Share admin navigation and basic dashboard stats with admin views
        View::composer(['admin.*', 'admin-layouts.*', 'frontend.layouts.footer'], function ($view) {
            if (str_contains($view->getName(), 'admin')) {
                $view->with('nav_items', []);
                $view->with('unread_messages_count', 0);
            }
        });
    }
}

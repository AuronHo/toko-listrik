<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::user()) {
                $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
                $view->with('cartItems', $cartItems);
            } else {
                $view->with('cartItems', collect());
            }
        });
    }
}

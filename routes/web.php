<?php

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardProductController;


Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
});

Route::get('/products', function () {
    return view('products', ['title' => 'Products', 'products' => Product::filter(request(['search', 'category', 'currency', 'discount',]))->latest()->paginate(3)->withQueryString()]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/checkout', function () {
    return view('checkout', ['title' => 'Checkout']);
})->middleware('auth');
Route::post('/checkout/remove', [CheckoutController::class, 'remove'])->name('checkout.remove')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index', ['title' => 'Dashboard']);
})->middleware('auth');

Route::get('/dashboard/products/checkSlug', [DashboardProductController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});

Route::get('/dashboard/employees', [EmployeeController::class, 'index']);
Route::get('/api/fetch-employees', [EmployeeController::class, 'fetchEmployees']);




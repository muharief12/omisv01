<?php

use App\Http\Controllers\AdminFeeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.product.details');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');

Route::get('posts/', [FrontController::class, 'posts'])->name('posts');
Route::get('posts/{post:slug}', [FrontController::class, 'postDetail'])->name('post_detail');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('carts', CartController::class);
    Route::post('carts/add/{productId}', [CartController::class, 'store'])->name('carts.add');
    Route::post('/carts/{cart}/update-qty', [CartController::class, 'updateQuantity'])->name('carts.updateQty');


    Route::get('orders/', [FrontController::class, 'orders'])->name('orders');
    Route::get('orders/{order:code}', [FrontController::class, 'orderDetail'])->name('order_detail');

    Route::get('my-profile/', [FrontController::class, 'profile'])->name('my_profile');
    Route::post('my-profile/update', [FrontController::class, 'profileUpdate'])->name('my_profile.update');

    Route::resource('product_transactions', ProductTransactionController::class);

    // Route::prefix('admin')->name('admin.')->group(function () {
    //     Route::resource('products', ProductController::class);
    //     Route::resource('categories', CategoryController::class)->middleware('role:owner');
    //     Route::resource('admin_fees', AdminFeeController::class)->middleware('role:owner');
    //     Route::resource('product_transactions', ProductTransactionController::class)->middleware('role:owner');
    // });
});

require __DIR__ . '/auth.php';

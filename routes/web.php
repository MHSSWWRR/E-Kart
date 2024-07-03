<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/about', function () {
    return view('aboutus');
});
Route::get('/dashboar', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/detail/{id}', [ProductController::class, 'detail']);
Route::post('/update_variant/{id}', [ProductController::class, 'updateVariant'])->name('update.variant');

Route::post('/add_to_cart', [ProductController::class, 'add_to_cart']);
Route::get("cartlist", [ProductController::class, 'cartList']);

Route::get("removecart/{id}", [ProductController::class, 'removeCart']);
Route::patch('/update-cart-product/{id}', [ProductController::class, 'updateCartProduct'])->name('update.cart.product');


Route::get('/product/{id}/detail/{product_variant_id?}', [ProductController::class, 'detail'])->name('product.detail');

Route::get('/checkout', [ProductController::class, 'checkout']);
Route::get("orderhistory", [ProductController::class, 'orderhistory']);
Route::post("placeorder", [ProductController::class, 'placeorder']);


//Route::get('seller/registration', [SellerController::class, 'registration'])->middleware(['auth', 'seller']);
Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'dashboard'])->name('SellerDashboard');
    Route::get('seller/addproduct', [SellerController::class, 'addproduct']);
    Route::post('seller/addnewproduct', [SellerController::class, 'addNewProduct']);
    Route::get('seller/addproductvariant', [SellerController::class, 'addproductvariant']);
    Route::post('seller/addNewProductVariant', [SellerController::class, 'addNewProductVariant']);
    Route::get('seller/productdetail/{id}', [SellerController::class, 'detail']);
    Route::patch('/seller/editproduct', [SellerController::class, 'updateProductAndVariant']);
    Route::get('seller/orders', [SellerController::class, 'orders']);
});

Route::get('seller/registration', [SellerController::class, 'registration']);

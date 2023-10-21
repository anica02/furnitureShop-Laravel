<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[\App\Http\Controllers\LoginController::class, "index"] )->name('login-form');
Route::post('/login',[\App\Http\Controllers\LoginController::class, "login"] )->name('login');

Route::get('/register',[\App\Http\Controllers\RegisterController::class, "register"] )->name('register');
Route::post('/register',[\App\Http\Controllers\RegisterController::class, "post"] )->name('register-post');


Route::middleware(['loggedIn'])->group(function () {

    Route::get('/logout',[\App\Http\Controllers\LoginController::class, "logout"] )->name('logout');
});

Route::middleware(['user'])->group(function () {

    Route::get('/home-user', [\App\Http\Controllers\HomeController::class, "index"])->name('home-user');

    Route::get('/products',[\App\Http\Controllers\ProductsController::class, "index"] )->name('products');
    Route::post('/add-to-cart',[\App\Http\Controllers\CartController::class, "add"] )->name('add-to-cart');
    Route::get('/cart',[\App\Http\Controllers\CartController::class, "index"] )->name('cart');

    Route::patch("/cart", [\App\Http\Controllers\CartController::class, "update"]);
    Route::delete("/remove-item", [\App\Http\Controllers\CartController::class, "remove"]);
   Route::get("/remove-all", [\App\Http\Controllers\CartController::class, "removeAll"])->name('remove-all');

    Route::get('/contact',[\App\Http\Controllers\ContactController::class, "index"] )->name('contact');

    Route::get("/orders", [\App\Http\Controllers\OrdersController::class, "index"])->name('orders');
    Route::get('/order-form',[\App\Http\Controllers\OrdersController::class, "orderForm"] )->name('checkout');
    Route::post('/order-form-submit',[\App\Http\Controllers\OrdersController::class, "orderFormSubmit"] )->name('order-form-submit');
    Route::post('/order-pag',[\App\Http\Controllers\OrdersController::class, "paginationOrder"] )->name('order-pag');

    Route::delete('/delete-order',[\App\Http\Controllers\OrdersController::class, "deleteOrder"] )->name('delete-order');
    Route::delete('/delete-order-item',[\App\Http\Controllers\OrdersController::class, "deleteOrderItem"] )->name('delete-order-item');
    Route::post('/show-order-items',[\App\Http\Controllers\OrdersController::class, "showOrderItems"] )->name('show-order-items');
    Route::post('/message',[\App\Http\Controllers\ContactController::class, "message"] )->name('message');

    Route::get('/author',[\App\Http\Controllers\AuthorController::class, "index"] )->name('author');

});

Route::middleware(['admin'])->group(function () {

    Route::get('/home-admin', [\App\Http\Controllers\AdminController::class, "index"])->name('home-admin');

    Route::get('/products-admin',[\App\Http\Controllers\AdminController::class, "products"] )->name('products-admin');
    Route::get('/products-insert-form',[\App\Http\Controllers\ProductsInsertController::class, "show"] )->name('products-form');
    Route::post('/products-insert',[\App\Http\Controllers\ProductsInsertController::class, "insert"] )->name('products-post');

    Route::get('/products-update/{id}',[\App\Http\Controllers\ProductUpdateController::class, "show"] )->name('update-product-form');
    Route::patch('/products-update/{id}',[\App\Http\Controllers\ProductUpdateController::class, "update"] )->name('update-product-patch');
    Route::post('/product-post/{id}',[\App\Http\Controllers\ProductUpdateController::class, "delete"] )->name('product-delete');

    Route::get("/orders-admin", [\App\Http\Controllers\AdminController::class, "orders"])->name('orders-admin');
    Route::delete('/delete-order-admin',[\App\Http\Controllers\AdminController::class, "deleteOrder"] )->name('delete-order-admin');
    Route::delete('/delete-order-item-admin',[\App\Http\Controllers\AdminController::class, "deleteOrderItem"] )->name('delete-order-item-admin');
    Route::post('/show-order-items-admin',[\App\Http\Controllers\AdminController::class, "showOrderItems"] )->name('show-order-items-admin');


    Route::get('/users', [\App\Http\Controllers\AdminController::class, "users"])->name('users');
    Route::delete('/delete-user', [\App\Http\Controllers\AdminController::class, "deleteUser"])->name('delete-user');
    Route::post('/show-user-param', [\App\Http\Controllers\AdminController::class, "showUserParam"])->name('show-user-param');
    Route::patch('/edit-user', [\App\Http\Controllers\AdminController::class, "editUser"])->name('edit-user');

    Route::get('/messages',[\App\Http\Controllers\AdminController::class, "messages"] )->name('show-messages');
    Route::post('/message-pag',[\App\Http\Controllers\AdminController::class, "paginationMsg"] )->name('message-pag');
    Route::delete('/delete-msg',[\App\Http\Controllers\AdminController::class, "deleteMsg"] )->name('delete-msg');

});



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\TestmonialController;
use App\Http\Controllers\frontend\ShoppingCartController;
use App\Http\Controllers\frontend\Auth\CustomerController;
use App\Http\Controllers\frontend\Auth\RegisterController;


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
Route::prefix('')->group(function(){
    Route::get('/',[HomeController::class,'home'])->name('home');
    Route::get('/shop',[HomeController::class,'shopPage'])->name('shop.page');
    Route::get('/single-product/{product_slug}', [HomeController::class, 'productDetails'])->name('productdetail.page');
    //shopping Cart
    Route::get('/shopping-cart',[ShoppingCartController::class, 'cartPage'])->name('cart.page');
    Route::post('/add-to-cart',[ShoppingCartController::class, 'addToCart'])->name('addto-cart');
    Route::get('/remove-to-cart/{cart_id}',[ShoppingCartController::class, 'removeToCart'])->name('removeto-cart');

    /*Authentication routes for Customer*/
 Route::get('/register', [RegisterController::class,'registerPage'])->name('register.page');
 Route::post('/register', [RegisterController::class,'registerStore'])->name('register.store');
 Route::get('/login',[RegisterController::class,'loginPage'])->name('login.page');
 Route::post('/login',[RegisterController::class,'loginStore'])->name('login.store');


 Route::prefix('customer/')->middleware('auth','is_customer')->group(function(){
 Route::get('dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');
 Route::get('logout',[RegisterController::class,'logOut'])->name('customer.logout');

});


Route::get('/dashboard', function () {
    return view('backend.pages.dashboard');
});

// Route::get('/', function () {
//     return view('frontend.layouts.include.pages.home');
// });

//admin login Authentication
Route::prefix('/admin')->group(function(){
Route::get('login',[LoginController::class, 'loginPage'])->name('admin.loginpage');
Route::post('login',[LoginController::class, 'login'])->name('admin.login');
Route::get('logout',[LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth','is_admin'])->group(function(){
    Route::get('dashboard', function () {
        return view('backend.pages.Dashboard');
    })->name('admin.dashboard');
});


Route::resource('category', CategoryController::class);
Route::resource('testmonial', TestmonialController::class);
Route::resource('products', ProductController::class);
Route::resource('coupon',CouponController::class);


});

});




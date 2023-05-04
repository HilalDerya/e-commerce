<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\FrontendAddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductDetailController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/kategori/{category:slug}', [\App\Http\Controllers\Frontend\CategoryController::class, 'index']);

Route::get("/giris", [AuthController::class, 'showSignInForm']);
Route::post("/giris", [AuthController::class, 'signIn']);

Route::get("/uye-ol", [AuthController::class, 'showSignUpForm']);
Route::post("/uye-ol", [AuthController::class, 'signUp']);

Route::get("/cikis", [AuthController::class, 'logout']);

Route::group(["middleware" => "auth"], function () {
    Route::get("/sepetim", [CartController::class, 'index']);
    Route::get("/hesabim", [AccountController::class, 'index']);
    Route::get("/detay/{product}", [ProductDetailController::class, 'index']);
    Route::get("/sepetim/ekle/{product}", [CartController::class, 'add']);
    Route::get("/sepetim/sil/{cartDetails}", [CartController::class, 'remove']);
    Route::get("/sepetim/increase/{cartDetails}", [CartController::class, 'increase']);
    Route::get("/sepetim/decrease/{cartDetails}", [CartController::class, 'decrease']);
    Route::get("/satin-al", [CheckoutController::class, 'showCheckoutForm']);
    Route::post("/satin-al", [CheckoutController::class, 'checkout']);
    //Route::get("/hesabim/edit", 'AccountController@index');
    //Route::post('/hesabim', [AccountController::class, 'updatePassword'])->name('update-password');
    Route::resource("/hesabim/{user}/adreslerim", FrontendAddressController::class, ['except' => ['store','destroy']]);
    Route::delete("/hesabim/{user}/adreslerim/{address}", [FrontendAddressController::class, 'destroy'])->name('delete-address');
    Route::post("/hesabim/adres-degistir", [FrontendAddressController::class, 'store'])->name('adres-degistir');
    Route::get("/hesabim", [AccountController::class, 'index']);
    //Route::post("/change-password", [AccountController::class,'updatePassword']);
    Route::post("/hesabim", [AccountController::class, 'updatePassword'])->name('update-password');
    //Route::get('/hesabim', [AccountController::class, 'changePassword'])->name('change-password');
});

Route::middleware('admin')->group(function() {
    Route::resource("/users", UserController::class);
    Route::resource("/users/{user}/addresses", AddressController::class, ['except' => ['create', 'store']]);
    Route::get("users/{user}/change-address", [AddressController::class, 'create']);
    Route::post("/users/change-address", [AddressController::class, 'store'])->name('change-address');
    Route::resource("/categories", CategoryController::class);
    Route::resource("/products", ProductController::class);
    Route::resource("/products/{product}/images", ProductImageController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

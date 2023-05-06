<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginPage;
use App\Http\Controllers\ProductPage;
use App\Http\Controllers\ReportPenjualan;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/login', [LoginPage::class, 'login'])->name('login');
Route::post( '/login', [LoginPage::class, 'actionlogin'])->name('actionlogin');
Route::get('/logout', [LoginPage::class, 'actionlogout'])->name('logout');

Route::get('/', [ProductPage::class, 'index'])->name('product');
Route::get('/checkout', [ProductPage::class, 'checkout'])->name('product_checkout');
Route::post('/checkout', [ProductPage::class, 'addToCart'])->name('product_cart');
Route::post('/confirm', [ProductPage::class, 'confirm'])->name('product_confirm')->middleware('customer');
Route::get('/product/{code?}', [ProductPage::class, 'detail'])->name('product_detail');

Route::get('/report', [ReportPenjualan::class, 'index'])->name('report')->middleware('report');

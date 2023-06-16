<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;

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

Auth::routes();

Route::get('migrate_db', function () {
	/* php artisan migrate */
    \Artisan::call('migrate');
    dd("Done");

});
Route::get('seed_db', function () {
	/* php artisan migrate */
    \Artisan::call('db:seed');
    dd("Done");

});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->middleware('is_admin')->name('admin.home');
Route::get('admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->middleware('is_admin')->name('admin.users');
Route::get('admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->middleware('is_admin')->name('admin.user.create');
Route::post('admin/users/save', [App\Http\Controllers\Admin\UserController::class, 'save'])->middleware('is_admin')->name('admin.user.save');
Route::get('admin/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->middleware('is_admin')->name('admin.user.edit');
Route::get('admin/users/tree', [App\Http\Controllers\Admin\UserController::class, 'getTreeHTML'])->middleware('is_admin')->name('admin.user.tree');
Route::get('admin/users/referral', [App\Http\Controllers\Admin\UserController::class, 'getReferralHTML'])->middleware('is_admin')->name('admin.user.referral');
Route::get('admin/users/earnings', [App\Http\Controllers\Admin\UserController::class, 'getEarningsHTML'])->middleware('is_admin')->name('admin.user.earnings');
Route::get('admin/users/withdraw', [App\Http\Controllers\Admin\UserController::class, 'getWithdrawHTML'])->middleware('is_admin')->name('admin.user.withdraw');
Route::get('admin/users/marketing', [App\Http\Controllers\Admin\UserController::class, 'getMarketingHTML'])->middleware('is_admin')->name('admin.user.marketing');
Route::post('admin/users/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->middleware('is_admin')->name('admin.user.update');
Route::delete('admin/users/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->middleware('is_admin')->name('admin.user.destroy');
Route::post('admin/users/changeStatus', [App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->middleware('is_admin')->name('admin.user.changeStatus');
Route::post('getFieldDataHTML', [App\Http\Controllers\Admin\UserController::class, 'getFieldDataHTML'])->middleware('is_admin')->name('admin.user.getFieldDataHTML');

Route::group(['prefix'=>'admin'],function(){

    Route::resource('products', 'Admin\ProductController',['names' => 'admin.products'])->middleware('is_admin');
    Route::resource('orders', 'Admin\OrderController',['names' => 'admin.orders'])->middleware('is_admin');
    Route::post('product/category/store', [App\Http\Controllers\Admin\ProductController::class, 'categorystore'])->middleware('is_admin')->name('admin.products.category.store');
    Route::get('profile/edit', [App\Http\Controllers\Admin\UserController::class, 'editProfile'])->middleware('is_admin')->name('admin.profile.edit');
    
});
Route::group(['prefix'=>'user'],function(){
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('orders', [App\Http\Controllers\UserController::class, 'orders'])->name('user.orders.index');
    Route::get('orders/create', [App\Http\Controllers\UserController::class, 'createOrder'])->name('user.orders.create');
    Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('user/users/save', [App\Http\Controllers\UserController::class, 'save'])->name('user.save');
    Route::get('profile/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::get('referral', [App\Http\Controllers\UserController::class, 'getReferralHTML'])->name('user.referral');
    Route::get('earnings', [App\Http\Controllers\UserController::class, 'getEarningsHTML'])->name('user.earnings');
    Route::get('withdraw', [App\Http\Controllers\UserController::class, 'getWithdrawHTML'])->name('user.withdraw');
    Route::get('marketing', [App\Http\Controllers\UserController::class, 'getMarketingHTML'])->name('user.marketing');
    Route::get('tree', [App\Http\Controllers\UserController::class, 'getTreeHTML'])->name('user.tree');
    
});
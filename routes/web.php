<?php

use App\Http\Controllers\dashboard\homeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\ClientController;
use App\Http\Controllers\dashboard\OrderrController;
use App\Http\Controllers\dashboard\client\OrderController;

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 


        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

          
            Route::get('/',[homeController::class,'index'])->name('home');

            // users routes
            Route::resource('users',UserController::class)->except(['show']);
            
            
            // categories routes
            Route::resource('categories',CategoryController::class)->except(['show']);

            // products routes
            Route::resource('products',ProductController::class)->except(['show']);


            // orders routes
            Route::resource('orders',OrderrController::class)->except(['show']);
            Route::get('orders/{order}/products',[OrderrController::class,'products'])->name('orders.products');



            // clients routes
            Route::resource('clients',ClientController::class)->except(['show']);
            Route::resource('clients.orders',OrderController::class)->except(['show']);


        });
        
      
    });


Auth::routes(['register'=>false]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

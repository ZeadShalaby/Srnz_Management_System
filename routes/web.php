<?php

use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\postsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Middleware\CheckCustomerRole;
use App\Http\Controllers\OrdersSiteController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\InterestedsController;
    
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
    
    Route::get('/', function () {
        return redirect('/logout');
    });
    
    //Login
    Route::get('/login', [UsersController::class, 'loginIndex']);
    Route::post('/login/checklogin', [UsersController::class, 'checklogin']);
    Route::get('/login/checklogin',function (){redirect(route('logout'));});
    Route::get('/logout', [UsersController::class, 'logout']);
    
    //Auth Middleware
    Route::middleware(CheckAuth::class)->group(function () {

        //autocompleteSearch
        Route::get('/autocomplete-search-orders', [OrdersController::class, 'autocompleteSearch']);
        Route::get('/autocomplete-search-orders-restore', [OrdersController::class, 'autocompleteSearch_restore']);

        // controller with resource
        Route::resource('/orders', OrdersController::class);

        //search
        Route::POST('/search-orders', [OrdersController::class, 'search_orders'])->name('orders.search');
        Route::POST('/search-orders_restore', [OrdersController::class, 'search_orders_restore'])->name('orders.search.restore');

        //home-page 
        Route::get('/Home_Page', [UsersController::class, 'homepage'])->name('homepage');
        });

    //Admin Middleware
    Route::middleware(CheckAdminRole::class)->group(function () {
        // controller with rescource
        Route::resource('/departments', DepartmentsController::class);
        Route::resource('/users', UsersController::class);
        //restore departments
        Route::get('/departments-restore', [DepartmentsController::class, 'restore_index'])->name('departments.restore.index');
        Route::get('/departments/restore/do', [DepartmentsController::class, 'restore'])->name('departments.restore');
        //restore orders
        Route::get('/orders-restore', [OrdersController::class, 'restore_index'])->name('orders.restore.index');
        Route::get('/orders/restore/do', [OrdersController::class, 'restore'])->name('orders.restore');
        //autocompleteSearch
        Route::get('/autocomplete-search-departments', [DepartmentsController::class, 'autocompleteSearch']);
        //search
        Route::POST('/search-departments', [DepartmentsController::class, 'search_departments'])->name('departments.search');
    
        });
    
    //Customer Middleware
    Route::middleware(CheckCustomerRole::class)->group(function () {
        // controller with rescource
        Route::resource('/ordersite', OrdersSiteController::class);
        Route::resource('/interesteds', InterestedsController::class);
        //favourite 
        Route::POST('/orders-favoruite', [OrdersSiteController::class, 'favoruite'])->name('ordersite.favourite');
        //restore orders
        Route::get('/orders-restore-site', [OrdersSiteController::class, 'restore_index_site'])->name('orders.restore.site.index');
        Route::get('/orders/restore/site/do', [OrdersSiteController::class, 'restore_site'])->name('orders.restore.site');

        });
   
        
    



<?php

use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\postsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SocialController;
use App\Http\Middleware\CheckCustomerRole;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RegisterController;
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
        Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
        // Sinup 
        Route::resource('/registration', RegisterController::class);
        // login with social
        Route::get('/redirect/{service}',[ServiceController::class,'redirect']);
        // callback google
        Route::get('/auth/google/callback',[ServiceController::class,'callback'])->name('/auth/google/callback');
        // callback githup 
        Route::get('/auth/github/callback',[ServiceController::class,'githubcallback'])->name('/auth/github/callback');
       


    //Auth Middleware
    Route::middleware(CheckAuth::class)->group(function () {

        //autocompleteSearch-orders
        Route::get('/autocomplete-search-orders', [OrdersController::class, 'autocompleteSearch']);

        // controller with resource
        Route::resource('/orders', OrdersController::class);

        //search-orders
        Route::POST('/search-orders', [OrdersController::class, 'search_orders'])->name('orders.search');

        //home-page 
        Route::get('/Home_Page', [UsersController::class, 'homepage'])->name('homepage');
        
        });

        
    //Admin Middleware
    Route::middleware(CheckAdminRole::class)->group(function () {
        // controller with rescource
        Route::resource('/departments', DepartmentsController::class);
        Route::resource('/users', UsersController::class);
        //users-Admin
        Route::get('/users-admin', [UsersController::class, 'admin'])->name('users.admin');
        //restore-departments
        Route::get('/departments-restore', [DepartmentsController::class, 'restore_index'])->name('departments.restore.index');
        Route::get('/departments/restore/do', [DepartmentsController::class, 'restore'])->name('departments.restore');
        //restore-orders
        Route::get('/orders-restore', [OrdersController::class, 'restore_index'])->name('orders.restore.index');
        Route::get('/orders/restore/do', [OrdersController::class, 'restore'])->name('orders.restore');
        //autocompleteSearch-departments
        Route::get('/autocomplete-search-departments', [DepartmentsController::class, 'autocompleteSearch']);
        //search-departments
        Route::POST('/search-departments', [DepartmentsController::class, 'search_departments'])->name('departments.search');
        //autocompleteSearch-users
        Route::get('/autocomplete-search-users', [UsersController::class, 'autocompleteSearch']);
        //search-users
        Route::POST('/search-users', [UsersController::class, 'search_users'])->name('users.search');
        
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
        //delete account
        Route::delete('/accounnt/deleted',[UsersController::class,'delete_account'])->name('users.delete');    
        });
   
        
    



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\postsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
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

Route::get('/login', [UsersController::class, 'loginIndex']);
Route::post('/login/checklogin', [UsersController::class, 'checklogin']);
Route::get('/login/checklogin',function (){redirect(route('logout'));});
Route::get('/logout', [UsersController::class, 'logout']);



//Route::middleware(CheckAdminRole::class)->group(function () {
    // controller with rescource
    Route::resource('/orders', OrdersController::class);
    Route::resource('/departments', DepartmentsController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/interesteds', InterestedsController::class);
   // });
    //restore
    Route::get('/departments-restore', [DepartmentsController::class, 'restore_index'])->name('departments.restore.index');
    Route::get('/departments/restore/do', [DepartmentsController::class, 'restore'])->name('departments.restore');
    
    //favourite 
    Route::POST('/orders-favoruite', [OrdersController::class, 'favoruite'])->name('orders.favourite');
    
    //autocompleteSearch
    Route::get('/autocomplete-search-departments', [DepartmentsController::class, 'autocompleteSearch']);
    Route::get('/autocomplete-search-orders', [OrdersController::class, 'autocompleteSearch']);
    
    //search
    Route::POST('/search-orders', [OrdersController::class, 'search_orders'])->name('orders.search');
    Route::POST('/search-departments', [DepartmentsController::class, 'search_departments'])->name('departments.search');
    



/*Route::middleware(CheckAdminRole::class)->group(function () {
    //admin route
Route::resource('/posts', postsController::class);

Route::get('posts/restore/one/{id}', [postsController::class, 'restore'])->name('post.restore');

Route::get('posts/restore_all', [postsController::class, 'restore_all'])->name('post.restore_all');
});*/
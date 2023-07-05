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
    return redirect('/welcome');
});


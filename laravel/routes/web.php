<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;

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

// Anonymous page
Route::View('/', 'public.home');
Route::View('/menu', 'public.menu');
Route::View('/orders', 'public.orders');
Route::View('/billout', 'public.billout');


// Auth page  
Route::View('/login', 'auth.login')->middleware('returnIfAuthenticated');
Route::View('/register', 'auth.register')->middleware('returnIfAuthenticated');
Route::get('/logout', [SystemController::class, 'logout']);


// Admin pages
Route::View('/admin-menu', 'admin.menu')->middleware('returnIfAnonymous');
Route::View('/admin-orders', 'admin.orders')->middleware('returnIfAnonymous');
Route::View('/admin-customers', 'admin.customers')->middleware('returnIfAnonymous');
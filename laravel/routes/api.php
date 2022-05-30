<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SystemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Menu API
Route::get('/menu/list', [MenuItemController::class, 'list']);
Route::post('/menu/add', [MenuItemController::class, 'add']);
Route::post('/menu/upload', [MenuItemController::class, 'upload']);
Route::post('/menu/update', [MenuItemController::class, 'update']);
Route::delete('/menu/delete', [MenuItemController::class, 'delete']);


// Order API
Route::get('/order/list', [OrderController::class, 'list']);
Route::post('/order/place', [OrderController::class, 'place']);
Route::post('/order/billout', [OrderController::class, 'billout']);
Route::get('/order/history', [OrderController::class, 'history']);


// Customer API
Route::get('/customer/list', [CustomerController::class, 'list']);
Route::post('/login', [SystemController::class, 'login']);
Route::post('/register', [SystemController::class, 'register']);





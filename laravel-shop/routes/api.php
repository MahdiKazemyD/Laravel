<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function (){
    Route::post('login', [LoginController::class , 'login']);
    Route::post('register', [RegisterController::class , 'register']);
    Route::post('logout', [LogoutController::class , 'logout']);
});

Route::middleware('auth')->group(function (){
    Route::apiResource('categories' , CategoryController::class );
    Route::apiResource('products' , ProductController::class );
    Route::apiResource('carts', CartController::class);
});

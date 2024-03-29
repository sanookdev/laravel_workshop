<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

// Users
Route::get('/users',[UserController::class,'index']);
Route::get('/users/create',[UserController::class,'create']);
Route::post('/users/store',[UserController::class,'store']);
Route::get('/users/{id}/edit',[UserController::class,'edit']);
Route::put('/users/{id}/update',[UserController::class,'update']);
Route::delete('/users/{id}/delete',[UserController::class,'destroy']);
Route::get('/products',function(){
    echo "Products";
});
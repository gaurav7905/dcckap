<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationController;

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


Route::get('/',[InformationController::class,'index']);
Route::post('/registration',[InformationController::class,'store']);
Route::get('/show',[InformationController::class,'show']);
Route::post('/delete',[InformationController::class,'destroy']);
Route::get('/edit',[InformationController::class,'edit']);

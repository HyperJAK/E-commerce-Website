<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('getProd/{id}',[ProductController::class,'getProd']);
Route::get('getAllProd',[ProductController::class,'getAllProd']);
Route::get('getProdName/{name}',[ProductController::class,'getProdName']);
Route::get('getProdCategory/{category}',[ProductController::class,'getProdCategory']);
Route::get('getProdStore/{store}',[ProductController::class,'getProdStore']);
Route::get('getProdImages/{id}',[ProductController::class,'getProdImages']);
Route::post('AddProd',[ProductController::class,'AddProd']);


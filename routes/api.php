<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('AddProd',[ProductController::class,'AddProd']);


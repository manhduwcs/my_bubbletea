<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/menu',[MenuController::class,'show_menu']);

Route::get('/menu/category/{main_category}',[MenuController::class,'show_category_list']);

Route::get('/menu/product/{main_name}',[MenuController::class,'show_product_item']);

Route::get('/home',[HomeController::class,'show_home']);


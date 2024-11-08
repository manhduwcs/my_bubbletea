<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::get('/home',[HomeController::class,'show_home'])->name('home');

Route::get('/menu',[MenuController::class,'show_menu']);

Route::get('/menu/category/{main_category}',[MenuController::class,'show_category_list']);

Route::get('/menu/product/{main_name}',[MenuController::class,'show_product_item']);

Route::get('/menu/filter/{condition}',[MenuController::class,'show_product_item_with_filter']);

Route::post('/order',[OrderController::class,'handle_order']);

Route::get('/order/form/confirm',[OrderController::class,'show_confirm_order'])->name('show_confirm_order');
Route::post('/order/confirm',[OrderController::class,'confirm_order']);

Route::get('/order/invoice',[OrderController::class,'show_order_invoice'])->name('order_invoice');

Route::get('login',[UserController::class,'show_login'])->name('login');


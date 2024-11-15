<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Mockery\VerificationDirector;

Route::get('/home',[HomeController::class,'show_home'])->name('home');

Route::get('/menu',[MenuController::class,'show_menu']);

Route::get('/menu/category/{main_category}',[MenuController::class,'show_category_list']);

Route::get('/menu/product/{main_name}',[MenuController::class,'show_product_item']);

Route::get('/menu/filter/{condition}',[MenuController::class,'show_product_item_with_filter']);

Route::post('/order',[OrderController::class,'handle_order']);

Route::get('/order/form/confirm',[OrderController::class,'show_confirm_order'])->name('show_confirm_order');
Route::post('/order/confirm',[OrderController::class,'confirm_order']);

Route::get('/order/invoice',[OrderController::class,'show_order_invoice'])->name('order_invoice');

Route::get('/login',[UserController::class,'show_login'])->name('login');
Route::get('/register',[UserController::class,'show_register'])->name('register');

Route::post('/login',[UserController::class,'confirm_login'])->name('confirm_login');
Route::post('/register',[UserController::class,'check_register'])->name('check_register');

Route::get('/register/verify',[VerificationController::class,'show_register_verify'])->name('show_register_verify');
Route::get('/user/edit/verify',[VerificationController::class,'show_user_edit_verify'])->name('show_user_edit_verify');
Route::post('/register/verify',[VerificationController::class,'confirm_register'])->name('confirm_register');
Route::put('/user/edit/verify',[VerificationController::class,'confirm_user_edit'])->name('confirm_user_edit');
Route::get('/user/forgetpass/verify',[VerificationController::class,'show_forgetpass_verify'])->name('show_forgetpass_verify');
Route::post('/user/newpass',[VerificationController::class,'show_newpass'])->name('show_newpass');
Route::get('/user/make/newpass',[VerificationController::class,'make_newpass'])->name('make_newpass');
Route::put('/user/newpass/confirm',[VerificationController::class,'confirm_newpass'])->name('confirm_newpass');

Route::get('/user',[UserController::class,'show_current_user'])->name('show_current_user');
Route::get('/user/edit',[UserController::class,'show_edit_user'])->name('show_edit_user');
Route::post('/user/edit',[UserController::class,'edit_current_user'])->name('edit_current_user');
Route::post('/logout',[UserController::class,'logout'])->name('logout');

Route::get('/user/changepass',[UserController::class,'show_user_changepass'])->name('show_user_changepass');
Route::put('/user/changepass',[UserController::class,'change_user_pass'])->name('change_user_pass');

Route::get('/user/forgetpass',[UserController::class,'show_user_forgetpass'])->name('show_user_forgetpass');
Route::post('/user/send_forget_mail',[UserController::class,'send_forgetpass_mail'])->name('send_forgetpass_mail');

Route::get('/login/forgetpass',[UserController::class,'show_login_forgetpass'])->name('show_login_forgetpass');
Route::post('/login/send/forgetmail',[UserController::class,'send_loginforget_mail'])->name('send_loginforget_mail');
Route::get('/login/forget/verify',[VerificationController::class,'show_loginforget_verify'])->name('show_loginforget_verify');
Route::post('/login/forget/newpass',[VerificationController::class,'show_loginforget_newpass'])->name('show_loginforget_newpass');
Route::get('/login/make/newpass',[VerificationController::class,'make_loginforget_newpass'])->name('make_loginforget_newpass');
Route::put('/login/confirm/newpass',[VerificationController::class,'confirm_loginforget_newpass'])->name('confirm_loginforget_newpass');
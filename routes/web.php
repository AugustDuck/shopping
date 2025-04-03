<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/menu',[MenuController::class,'index']);

Route::resource('/products', ProductController::class);

Route::get('/permission',[PermissionController::class]);

Route::get('/',[UserController::class,'index']);
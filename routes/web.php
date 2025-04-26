<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\RoleController;

Route::get('/menu',[MenuController::class,'index']);

Route::get('/', [PagesController::class,'index'])->name('home');

Route::get('/user',[UserController::class,'index']);

//route adminstrator
Route::prefix('admin')->group(function () {
    Route::get('/login',[LoginController::class,'showAdminLogin'])
        ->name('admin.auth.login');
    Route::post('/login',[LoginController::class,'handleAdminLogin'])
        ->name('admin.auth.submit');
    Route::post('/logout',[LoginController::class,'handleAdminLogout'])
        ->name('admin.auth.logout');
    Route::get('/dashboard',[AdminController::class,'showDashboard'])
        ->name('admin.auth.dashboard')
        ->middleware(['myauth', 'role:admin']);
    Route::resource('/products', ProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy'
    ])->middleware(['myauth', 'role:admin']);;
    Route::resource('/users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            // 'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            // 'update' => 'admin.users.update',
            // 'destroy' => 'admin.users.destroy',
    ])->middleware(['myauth', 'role:admin']);

    Route::resource('/roles', RoleController::class)->names([
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'edit' => 'admin.roles.edit'
    ])->middleware(['myauth', 'role:admin']);

});

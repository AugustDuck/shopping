<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
// api adminstrator address
Route::middleware(['auth:sanctum','role:admin'])
->prefix('admin')
->name('admin.api.')
->group(function () {
  Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
  Route::get('addresses', [AddressController::class, 'index'])->name('addresses.index');
  Route::get('phones', [PhoneController::class, 'index'])->name('phones.index');

  // user
  Route::post('users', [UserController::class, 'store'])->name('users.store');
  Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
  Route::delete('user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
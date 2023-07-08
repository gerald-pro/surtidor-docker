<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('',[HomeController::class, 'dashboard'])->name('admin.home');
Route::resource('user',UserController::class)->names('modulo_administrativo.empleado');

Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('clientes', ClienteController::class)->names('clientes');;

Route::resource('tanques', TanqueController::class);
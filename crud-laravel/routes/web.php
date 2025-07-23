<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CostumersController;

Route::get('/', [UserController::class, 'dashboard'])->name('welcome');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/login', [UserController::class, 'loginView'])->name('loginView');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/costumers', [CostumersController::class,'costumersView'])->name('costumers');
Route::get('/register', [UserController::class, 'registerView'])->name('registerView');
Route::post('/register', [UserController::class,'register'])->name('register');
Route::put('/costumer/{id}', [CostumersController::class, 'updateCostumer'])->name('costumer.update');
Route::post('/costumer/create', [CostumersController::class, 'createCostumer'])->name('costumer.create');
Route::get('/costumer/create', [CostumersController::class, "createCustumerView"])->name("costumer.create.view");
Route::get('/costumer/{id}', [CostumersController::class, 'costumersEditView'])->name('costumer.edit');
Route::delete("/costumer/{id}", [CostumersController::class, 'destroy'])->name('costumer.destroy');

<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get("/create-usuario", [UsuarioController::class, 'create'])->name('usuarios.create');
Route::get("/show-usuario/{usuario}", [UsuarioController::class, 'show'])->name('usuarios.show');
Route::get("/update-usuario/{usuario}", [UsuarioController::class, 'update'])->name('usuarios.update');
Route::post("/store-usuario", [UsuarioController::class, 'store'])->name('usuarios.store');
Route::delete("/destroy-usuario/{usuario}", [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::get("/edit-usuario/{usuario}", [UsuarioController::class, 'edit'])->name('usuarios.edit');

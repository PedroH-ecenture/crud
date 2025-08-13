<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Auth\Events\Login;
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

Route::get("/", [LoginController::class, 'index'])->name('login');
route::post("/login", [LoginController::class, 'loginProccess'])->name('login.proccess');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


route::group(['middleware' => 'auth'], function () {
    Route::get("/usuario-index", [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get("/create-usuario", [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::get("/show-usuario/{usuario}", [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get("/update-usuario/{usuario}", [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::post("/store-usuario", [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::delete("/destroy-usuario/{usuario}", [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::get("/edit-usuario/{usuario}", [UsuarioController::class, 'edit'])->name('usuarios.edit');
});

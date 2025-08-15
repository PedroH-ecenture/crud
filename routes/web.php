<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get("/", [LoginController::class, 'index'])->name('login');
Route::post("/login", [LoginController::class, 'loginProccess'])->name('login.proccess');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {

    // Listar e visualizar usuários (usuarios.ver)
    Route::get("/usuario-index", [UsuarioController::class, 'index'])
        ->middleware('permission:usuarios.ver')
        ->name('usuarios.index');

    Route::get("/show-usuario/{usuario}", [UsuarioController::class, 'show'])
        ->middleware('permission:usuarios.ver')
        ->name('usuarios.show');

    // Criar usuários (usuarios.criar)
    Route::get("/create-usuario", [UsuarioController::class, 'create'])
        ->middleware('permission:usuarios.criar')
        ->name('usuarios.create');

    Route::post("/store-usuario", [UsuarioController::class, 'store'])
        ->middleware('permission:usuarios.criar')
        ->name('usuarios.store');

    // Editar usuários (usuarios.editar)
    Route::get("/edit-usuario/{usuario}", [UsuarioController::class, 'edit'])
        ->middleware('permission:usuarios.editar')
        ->name('usuarios.edit');

    Route::get("/update-usuario/{usuario}", [UsuarioController::class, 'update'])
        ->middleware('permission:usuarios.editar')
        ->name('usuarios.update');

    // Deletar usuários (usuarios.deletar)
    Route::delete("/destroy-usuario/{usuario}", [UsuarioController::class, 'destroy'])
        ->middleware('permission:usuarios.deletar')
        ->name('usuarios.destroy');
});

<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

Route::get("/", [LoginController::class, 'index'])->name('login');
Route::post("/login", [LoginController::class, 'loginProccess'])->name('login.proccess');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {

    // rotas dos roles

    Route::get('/createrole', [RoleController::class, 'createrole'])
        ->middleware('permission:grupos.criar')
        ->name('roles.createrole');
    Route::get('/viewrole', [RoleController::class, 'viewrole'])
        ->middleware('permission:grupos.ver')
        ->name('viewrole');
    Route::post('/roles', [RoleController::class, 'storerole'])
        ->middleware('role:Super-admin')
        ->name('roles.storerole');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->middleware('permission:grupos.editar')
        ->name('roles.editroles');
    Route::get('/roles/{role}', [RoleController::class, 'update'])
        ->name('roles.updateroles');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->middleware('permission:grupos.deletar')
        ->name('roles.destroy');
    Route::get('/roles/create-delete-only', [RoleController::class, 'criarDeleteOnlyRole']);


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

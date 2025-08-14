<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name' => 'usuarios.ver']);
        Permission::create(['name' => 'usuarios.criar']);
        Permission::create(['name' => 'usuarios.editar']);
        Permission::create(['name' => 'usuarios.deletar']);

        Permission::create(['name' => 'grupos.ver']);
        Permission::create(['name' => 'grupos.criar']);
        Permission::create(['name' => 'grupos.editar']);
        Permission::create(['name' => 'grupos.deletar']);

        $superAdmin = Role::create(['name' => 'SUPER-ADMIN']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'usuarios.ver',
            'usuarios.criar',
            'usuarios.editar',
            'usuarios.deletar',
            'grupos.ver',
            'grupos.criar',
            'grupos.editar',
            'grupos.deletar'
        ]);

        $editor = Role::create(['name' => 'Editor']);
        $editor->givePermissionTo([
            'usuarios.ver',
            'usuarios.criar',
            'usuarios.editar'
        ]);

        $visualizador = Role::create(['name' => 'Visualizador']);
        $visualizador->givePermissionTo(['usuarios.ver']);
    }
}

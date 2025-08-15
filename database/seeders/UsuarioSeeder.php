<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        // --- Criação das permissões ---
        $perms = [
            'usuarios.ver',
            'usuarios.criar',
            'usuarios.editar',
            'usuarios.deletar',
            'grupos.ver',
            'grupos.criar',
            'grupos.editar',
            'grupos.deletar'
        ];

        foreach ($perms as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // --- Criação das roles ---
        $superAdmin = Role::firstOrCreate(['name' => 'Super-admin']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions([
            'usuarios.ver',
            'usuarios.criar',
            'usuarios.editar',
            'usuarios.deletar',
            'grupos.ver',
            'grupos.criar',
            'grupos.editar',
            'grupos.deletar'
        ]);

        $editor = Role::firstOrCreate(['name' => 'Editor']);
        $editor->syncPermissions([
            'usuarios.ver',
            'usuarios.criar',
            'usuarios.editar'
        ]);

        $visualizador = Role::firstOrCreate(['name' => 'Visualizador']);
        $visualizador->syncPermissions(['usuarios.ver']);

        // --- Criação automática dos usuários ---
        $usuarios = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
                'password' => 'superad1',
                'role' => $superAdmin
            ],
            [
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => 'admin1',
                'role' => $admin
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@email.com',
                'password' => 'editor1',
                'role' => $editor
            ],
            [
                'name' => 'Visualizador',
                'email' => 'visual@email.com',
                'password' => 'visual1',
                'role' => $visualizador
            ],
        ];

        foreach ($usuarios as $u) {
            $user = Usuario::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make($u['password'])
                ]
            );

            $user->syncRoles([$u['role']]);
        }
    }
}

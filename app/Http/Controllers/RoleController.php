<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function viewrole()
    {
        $roles = Role::all();
        return view('roles.viewrole', compact('roles')); // <-- aqui mudou
    }

    public function createrole()
    {
        $permissions = Permission::all(); // pega todas as permissões
        return view('roles.createrole', compact('permissions')); // passa para o Blade
    }

    public function storerole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);

        // Cria a role
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        // Pega as permissões selecionadas ou cria um array vazio
        $permissions = $request->permissions ?? [];

        // Garante que a permissão 'usuarios.ver' esteja sempre presente
        if (!in_array('usuarios.ver', $permissions)) {
            $permissions[] = 'usuarios.ver';
        }

        // Sincroniza todas as permissões (selecionadas + 'usuarios.ver')
        $role->syncPermissions($permissions);

        return redirect()->route('viewrole')->with('success', 'Role criada com sucesso!');
    }


    public function edit(Role $role)
    {
        return view('roles.editroles', compact('role'));
    }

    // Salva alterações da role
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
        ]);

        // Pega as permissões enviadas do formulário
        $permissions = $request->permissions ?? [];

        // Garante que 'usuarios.ver' sempre esteja presente
        if (!in_array('usuarios.ver', $permissions)) {
            $permissions[] = 'usuarios.ver';
        }

        // Sincroniza todas as permissões
        $role->syncPermissions($permissions);

        return redirect()->route('viewrole')->with('success', 'Role atualizada com sucesso!');
    }


    public function destroy(Role $role)
    {
        // Proteção: não deletar Super-admin
        if ($role->name === 'Super-admin') {
            return redirect()->route('viewrole')->with('error', 'Não é possível deletar a role Super-admin!');
        }

        $role->delete();

        return redirect()->route('viewrole')->with('success', 'Role deletada com sucesso!');
    }
}

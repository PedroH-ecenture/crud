<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Usuario::query();

        if ($request->filled('role_filter')) {
            $query->role($request->role_filter); // Método do Spatie para filtrar por role
        }

        $usuarios = $query->orderByDesc('id')->get();

        return view('usuarios.index', compact('usuarios'));
    }


    public function show(Usuario $usuario)
    {
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(UsuarioRequest $request)
    {
        $request->validated();

        // Cria usuário usando Hash::make para garantir hash correto
        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Atribuindo a role selecionada
        $role = Role::find($request->role);
        $usuario->assignRole($role);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(Usuario $usuario)
    {
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $request->validated();

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        // Atualiza a senha apenas se preenchida
        if ($request->filled('password')) {
            $usuario->password = $request->password; // SEM Hash::make
        }

        $usuario->save();

        // Atualiza a role
        $role = Role::find($request->role);
        $usuario->syncRoles([$role]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário deletado com sucesso!');
    }

    public function list()
    {
        return view('usuarios.list');
    }
}

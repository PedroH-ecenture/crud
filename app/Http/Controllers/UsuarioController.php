<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderByDesc('id')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
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

        // Criptografando a senha
        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

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

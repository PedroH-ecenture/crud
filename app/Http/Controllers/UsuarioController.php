<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;

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
        return view('usuarios.create');
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        // Logic to update the user
        $request->validated();
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    public function store(UsuarioRequest $request)
    {
        // Logic to store the user
        $request->validated();
        Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
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

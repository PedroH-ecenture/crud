<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuarios.index');
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function update()
    {
        return view('usuarios.update');
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

    public function delete()
    {
        return view('usuarios.delete');
    }

    public function list()
    {
        return view('usuarios.list');
    }
}

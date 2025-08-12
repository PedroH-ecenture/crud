<?php

namespace App\Http\Controllers;

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

    public function store()
    {
        return view('usuarios.store');
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

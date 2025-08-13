<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginProccess(LoginRequest $request)
    {
        $request->validated();

        // Busca manual do usuário pelo email e senha em texto puro
        $usuario = Usuario::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if (!$usuario) {
            return back()->withInput()->with('error', 'Usuário ou senha inválidos.');
        }

        // Loga manualmente o usuário
        Auth::login($usuario);

        return redirect()->route('usuarios.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

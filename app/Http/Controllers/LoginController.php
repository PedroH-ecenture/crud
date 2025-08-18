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
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('usuarios.index');
        }

        return back()->withInput()->with('error', 'Usuário ou senha inválidos.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function authenticated(Request $request, $user)
    {
        // Se o usuário tem a role Delete-only
        if ($user->hasRole('Delete-only')) {
            return redirect()->route('viewrole'); // vai direto pra viewrole
        }

        // Caso contrário, redireciona normalmente
        return redirect()->intended($this->redirectPath());
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (session('admin_logueado')) {
            return redirect()->route('admin.dashboard.index');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'    => 'required|string',
            'contrasena' => 'required|string',
        ]);

        $usuarioCorrecto    = env('ADMIN_USUARIO', 'admin');
        $contrasenaCorrecto = env('ADMIN_PASSWORD', 'admin123');

        if ($request->usuario === $usuarioCorrecto && $request->contrasena === $contrasenaCorrecto) {
            session(['admin_logueado' => true]);
            return redirect()->route('admin.dashboard.index');
        }

        return back()->withErrors(['credenciales' => 'Usuario o contraseña incorrectos.']);
    }

    public function logout(Request $request)
    {
        session()->forget('admin_logueado');
        return redirect()->route('admin.login');
    }
}

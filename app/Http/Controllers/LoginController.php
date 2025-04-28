<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required', // Cambiado de 'username' a 'name'
            'password' => 'required',
        ]);

        $user = User::where('name', $request->name)->first(); // Cambiado de 'username' a 'name'

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Inicia sesión
            $request->session()->regenerate(); // Regenera la sesión
            return redirect()->route('categorias')->with('success', 'Inicio de sesión exitoso.');
        }

        // Manejar error de credenciales no válidas
        return back()->withErrors([
            'login' => 'Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }

    public function createAdminUser()
    {
        User::create([
            'name' => 'admin_cafesur',
            'email' => 'admin@cafesur.com',
            'password' => bcrypt('cafesur123*'), // Asegúrate de usar bcrypt aquí
        ]);
    }
}

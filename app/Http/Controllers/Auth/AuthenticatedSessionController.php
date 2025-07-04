<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Importa la clase LoginRequest para validación de login
use App\Providers\RouteServiceProvider; // Importa el proveedor de rutas (no usado aquí)
use Illuminate\Http\RedirectResponse; // Importa la clase para respuestas de redirección
use Illuminate\Http\Request; // Importa la clase Request para manejar solicitudes HTTP
use Illuminate\Support\Facades\Auth; // Importa el facade Auth para autenticación
use Illuminate\Support\Facades\Route; // Importa el facade Route para manejo de rutas
use Inertia\Inertia; // Importa Inertia para renderizar vistas
use Inertia\Response; // Importa la clase Response de Inertia

class AuthenticatedSessionController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Llama al método authenticate() de LoginRequest para validar credenciales

        $request->session()->regenerate(); // Regenera el ID de sesión para evitar ataques de fijación de sesión

        return redirect()->route('welcome.index');
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Cierra la sesión del usuario autenticado usando el guard 'web'

        $request->session()->invalidate(); // Invalida la sesión actual

        $request->session()->regenerateToken(); // Regenera el token CSRF para la nueva sesión

        return redirect()->route('welcome.index');
    }
}
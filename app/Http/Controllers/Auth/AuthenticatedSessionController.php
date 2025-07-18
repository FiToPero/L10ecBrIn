<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

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
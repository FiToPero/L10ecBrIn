<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request; // Para manejar las solicitudes HTTP
use Inertia\Middleware; // Middleware base de Inertia.js
use Illuminate\Support\Facades\Auth; // Para manejar la autenticación

// Definimos la clase HandleInertiaRequests que extiende el Middleware de Inertia
class HandleInertiaRequests extends Middleware
{
    /**
     * La plantilla raíz que se carga en la primera visita a la página.
     *
     * @var string
     */
    protected $rootView = 'app'; // Define la vista principal que Inertia usará como contenedor base.

    /**
     * Determina la versión actual de los assets (CSS, JS, etc.).
     * Esto se utiliza para invalidar el caché del navegador cuando los assets cambian.
     */
    public function version(Request $request): string|null
    {
        // Llama al método `version` del Middleware base de Inertia.
        // Por defecto, esto puede devolver un hash basado en los archivos de assets.
        return parent::version($request);
    }

    /**
     * Define las propiedades (props) que se comparten por defecto con todas las vistas de Inertia.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            // Incluye las props compartidas por defecto desde el Middleware base de Inertia.
            ...parent::share($request),

            // Agrega una propiedad 'auth' que contiene información del usuario autenticado.
            'auth' => [
                'user' => function() {
                    // Verifica si hay un usuario autenticado.
                    if (Auth::check()) {
                        // Obtiene el usuario autenticado.
                        $user = Auth::user();

                        // Convierte los atributos del usuario en un array.
                        $userArray = $user->toArray();  //(array)$user;

                        // Agrega el rol del usuario al array.
                        $userArray['role'] = $user->role->name;

                        // Agrega los permisos del usuario al array, obteniéndolos como una lista de nombres.
                        $userArray['permissions'] = $user->role->permissions->pluck('name');

                        // Devuelve el array con la información del usuario.
                        return $userArray;
                    }
                }
            ],

            // Agrega una propiedad 'flash' para manejar mensajes flash desde la sesión.
            'flash' => [
                // Obtiene el mensaje flash almacenado en la sesión, si existe.
                'message' => fn () => $request->session()->get('message'),
                'color' => fn () => $request->session()->get('color'),
            ]
        ];
    }
}



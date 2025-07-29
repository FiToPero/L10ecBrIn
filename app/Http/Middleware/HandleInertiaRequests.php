<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware; 
use Illuminate\Support\Facades\Auth; 

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
                        
                        /** @var \App\Models\User $user */
                        $user = Auth::user();  // Obtiene el usuario autenticado.

                        // Convierte los atributos del usuario en un array.
                        $userArray = $user->toArray();  //(array)$user;

                        // Agrega el rol del usuario al array.
                        $userArray['role']['id'] = $user->role->id;
                        $userArray['role']['name'] = $user->role->name;

                        // Agrega los permisos del usuario al array, obteniéndolos como una lista de nombres.
                        $userArray['permissions'] = $user->role->permissions->pluck('name');

                        return $userArray;
                    }
                }
            ],

            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'color' => fn () => $request->session()->get('color'),
            ]
        ];
    }
}



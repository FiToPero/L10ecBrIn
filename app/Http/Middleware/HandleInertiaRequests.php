<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => function(){
                    if (Auth::check()) {
                        $user = Auth::user();
                        $userArray = $user->getAttributes();
            
                        $userArray['role'] = $user->role->name;
                        $userArray['permissions'] = $user->role->permissions->pluck('name');
            
                        return $userArray;
                    }
                }
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ]
        ];

        

        // if (Auth::check()) {
        //     $user = Auth::user();
        //     $userArray = $user->getAttributes();

        //     $userArray['role'] = $user->role->name;
        //     $userArray['permissions'] = $user->role->permissions->pluck('name');

        //     return [
        //         'user' => $userArray,
        //     ];
        // }
        
        

            // 'auth' => [
            //     'user' => fn () => $request->user()
            //         ? [
            //             'user' => $request->user(),
            //             'role' => $request->user()->role->name,
            //             'permissions' => $request->user()->role->permissions->pluck('name'),
            //         ]
            //         : null,
            // ],


            // 'auth' => [
            //      'user' => $request->user(),
            // ],











    }
}

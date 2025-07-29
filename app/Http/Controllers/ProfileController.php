<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Role;
use App\Models\User;
use Exception;

class ProfileController extends Controller
{
    public function edit(Request $request): Response
    {
        $roles = Role::all();
        $user = $request->user();

        return Inertia::render('Profile/Edit', [
            'user' => $user,
            'roles' => $roles,
            'status' => session('status'),
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'password_destroy' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('welcome.index')->with(['message' => 'User Deleted.', 'color' => 'red']);
        } catch (Exception $e) {
            return back()->with(['message' => 'User deletion failed.', 'color' => 'red']);  
        }
    }
}

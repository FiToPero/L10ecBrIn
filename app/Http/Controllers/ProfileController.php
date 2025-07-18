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

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->destroy();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('product.index')->with(['message' => 'User deleted.', 'color' => 'red']);
    }
}

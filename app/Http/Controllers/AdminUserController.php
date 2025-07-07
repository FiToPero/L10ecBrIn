<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\UserRequest;
use stdClass;
use App\Actions\UpdateUser;
use App\Actions\CreateUser;


class AdminUserController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('view', User::class); 

        $usersTrashed = new stdClass();
        $roles = Role::all();
        $filters = $request->all('user', 'userTrashed');

        $users = User::with('role')
            ->when($filters['user'] ?? null, function($query, $search){$query->where('username', 'LIKE', "%". $search ."%");})
            ->paginate(10, ['*'], 'userPage');  

        $usersTrashed = User::onlyTrashed()
            ->when($filters['userTrashed'] ?? null, function($query, $search){$query->where('username', 'LIKE', "%". $search ."%");})
            ->paginate(5, ['*'], 'trashedPage')
            ->appends(['userPage' => $users->currentPage()]);

        $users->appends(['trashedPage' => $usersTrashed->currentPage()]);

        return Inertia::render('Admin-User', compact('users', 'usersTrashed', 'roles'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::all();
        return Inertia::render('Forms/UserForms/Create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        try {
            CreateUser::run($request);
            
            return redirect()->route('adminUser.index')->with(['message' => 'User created successfully.', 'color' => 'green']);
        } catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with(['message' => 'User created failed.', 'color' => 'red']);
        }
    }

    public function edit($id)
    {
        $this->authorize('update', User::class);

        $user = User::with('role')->findOrFail($id);
        $roles = Role::all();

        return Inertia::render('Forms/UserForms/Edit', compact('user', 'roles'));
     
    }

    public function update(UserRequest $request)
    { 
        $this->authorize('update', User::class);
        try {
            UpdateUser::run($request);
            
            return redirect()->route('adminUser.index')->with(['message' => 'User updated successfully.', 'color' => 'cyan']);
        }catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with(['message' => 'User updated failed.', 'color' => 'red']);
        }
    }

        public function destroy(string $id)
    {
        $this->authorize('delete', User::class);
        try {
            User::destroy($id);

            return redirect()->route('adminUser.index')->with(['message' => 'User Deleted succcess.', 'color' => 'red']);
        } catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with(['message' => 'User Deleted failed.', 'color' => 'red']);
        }
    }

    public function restore(string $id)
    {
        $this->authorize('restore', User::class);
       try {
            User::withTrashed()->find($id)->restore();

            return redirect()->route('adminUser.index')->with(['message' => 'User Restored succcess.', 'color' => 'gray']);    
        } catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with(['message' => 'User Restored failed.', 'color' => 'red']);
        }
    }

    public function forceDestroy(string $id)
    {
        $this->authorize('forceDelete', User::class);
        try {
            User::withTrashed()->find($id)->forceDelete();

            return redirect()->route('adminUser.index')->with(['message' => 'User Deleted permanently succcess.', 'color' => 'red']);
        } catch (\Exception $e) {
            return redirect()->route('adminUser.index')->with(['message' => 'User Deleted permanently failed.', 'color' => 'red']);
        }
    }
}

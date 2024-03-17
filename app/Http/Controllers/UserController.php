<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userRepository;

    protected $roleRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->roleRepository = app(RoleRepositoryInterface::class);
    }

    public function index()
    {
        Gate::authorize('viewAny', User::class);

        $users = $this->userRepository->getAllUsers();

        return view('users.index')->with([
            'users' => $users,
        ]);
    }

    public function edit($id)
    {
        $user = $this->userRepository->getUser($id);

        Gate::authorize('update', $user);

        $roles = $this->roleRepository->getAllRoles();

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = $this->userRepository->getUser($id);

        Gate::authorize('update', $user);

        $data = $request->validate([
            'roles' => 'sometimes:array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        $user->roles()->sync($data['roles'] ?? []);

        return redirect()->route('users');
    }
}

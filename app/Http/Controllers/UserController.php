<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\RoleRepositoryInterface;

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
        $users = $this->userRepository->getAllUsers();

        return view('users.index')->with([
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        $user = $this->userRepository->getUser($id);
        $roles = $this->roleRepository->getAllRoles();

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id) {

        $user = $this->userRepository->getUser($id);

        $data = $request->validate([
            'roles' => 'sometimes:array',
            'roles.*' => 'exists:roles,id',
        ]);    

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        $user->roles()->sync( $data['roles'] ?? [] );

        return redirect()->route('users');
    }
}

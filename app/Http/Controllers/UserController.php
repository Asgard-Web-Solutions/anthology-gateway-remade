<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all();

        return view('users.index')->with([
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id) {

        $user = User::find($id);

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

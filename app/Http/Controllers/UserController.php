<?php

namespace App\Http\Controllers;

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

        return view('users.edit')->with([
            'user' => $user
        ]);
    }

    public function update(Request $request, $id) {

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('users');
    }
}

<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;

trait CreateAdminAndAuthenticate
{
    public function CreateAdminAndAuthenticate($attributes = []): User
    {
        $user = User::factory()->create($attributes);
        $admin = Role::where('Name', '=', 'Admin')->first();
        $user->roles()->sync([$admin->id]);

        $this->actingAs($user);

        return $user;
    }
}

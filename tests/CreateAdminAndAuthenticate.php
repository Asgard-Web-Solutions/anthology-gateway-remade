<?php

namespace Tests;

use App\Models\User;

trait CreateAdminAndAuthenticate
{
    public function CreateAdminAndAuthenticate($attributes = []): User
    {
        $user = User::factory()->create($attributes);

        $this->actingAs($user);

        return $user;
    }
}

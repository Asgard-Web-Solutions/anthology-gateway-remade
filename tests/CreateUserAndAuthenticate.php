<?php

namespace Tests;

use App\Models\User;

trait CreateUserAndAuthenticate
{
    protected function CreateUserAndAuthenticate($attributes = [])
    {
        $user = User::factory()->create($attributes);
        $this->actingAs($user);
        return $user;
    }
}

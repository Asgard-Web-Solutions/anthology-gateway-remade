<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use App\Models\User;

trait CreateUser
{
    public function CreateUser(): User
    {
        $user = User::factory()->create($attributes);

        return $user;
    }
}

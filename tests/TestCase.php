<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use CreateUserAndAuthenticate;
    use RefreshDatabase;

    public function createUser(): User
    {
        $user = User::factory()->create();

        return $user;
    }
}

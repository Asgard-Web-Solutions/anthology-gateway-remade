<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreateUserAndAuthenticate;

abstract class TestCase extends BaseTestCase
{
    use CreateUserAndAuthenticate;
    use CreatesApplication;
    use RefreshDatabase;

    public function createUser(): User
    {
        $user = User::factory()->create();

        return $user;
    }
}

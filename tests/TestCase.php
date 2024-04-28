<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreateAdminAndAuthenticate;
    use CreatesApplication;
    use CreateUser;
    use CreateAuthor;
    use CreateUserAndAuthenticate;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function createUser(): User
    {
        $user = User::factory()->create();

        return $user;
    }
}

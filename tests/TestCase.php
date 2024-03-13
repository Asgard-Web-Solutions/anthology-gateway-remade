<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use SebastianBergmann\Type\VoidType;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use CreateUserAndAuthenticate;
    use CreateAdminAndAuthenticate;
    use RefreshDatabase;
    use CreateUser;

    public function setUp(): Void
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

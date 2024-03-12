<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_users_list_page_loads() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get(route('users'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    public function test_users_are_displayed_on_users_page() {
        $user = $this->createUser();
        $this->createUserAndAuthenticate();

        $response = $this->get(route('users'));

        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }
}

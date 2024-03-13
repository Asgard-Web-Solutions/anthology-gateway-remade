<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;

use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_users_list_page_loads() {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('users'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('users.index');
    }

    public function test_users_are_displayed_on_users_page() {
        $user = $this->createUser();
        $this->createAdminAndAuthenticate();

        $response = $this->get(route('users'));

        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    public function test_user_edit_page_loads() {
        $user = $this->createUser();
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('users.edit', $user->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('users.edit');
    }

    public function test_user_edit_page_displays_correct_user() {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();

        $response = $this->get(route('users.edit', $user->id));

        $response->assertSee('Edit User ' . $user->email);
    }

    public function test_user_update_updates_the_database() {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();
        $data = $this->getUserUpdateData();

        $response = $this->put(route('users.update', $user->id), $data);

        $this->assertDatabaseHas('users', $data);
    }

    public function test_user_update_redirects_to_users() {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();
        $data = $this->getUserUpdateData();

        $response = $this->put(route('users.update', $user->id), $data);

        $response->assertRedirectToRoute('users');
    }


    private function getUserUpdateData() {
        $data['name'] = 'Admiral Akbar';
        $data['email'] = 'Itsatrap@moncalamari.com';

        return $data;
    }
}

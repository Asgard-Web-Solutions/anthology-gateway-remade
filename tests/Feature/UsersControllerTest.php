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

    public function test_users_are_displayed_on_users_page() {
        $user = $this->createUser();
        $this->createAdminAndAuthenticate();

        $response = $this->get(route('users'));

        $response->assertSee($user->name);
        $response->assertSee($user->email);
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

    /** ROLES */
    public function test_roles_show_on_user_edit_page() {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();

        $response = $this->get(route('users.edit', $user->id));

        $response->assertSee('Admin');
        $response->assertSee('Moderator');
        $response->assertSee('Help Desk');
    }

    public function test_roles_save_on_user_update() {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();
        $data = $this->getUserUpdateData();
        $data['roles'] = ["1"];

        $response = $this->put(route('users.update', $user->id), $data);

        $verify_data['user_id'] = $user->id;
        $verify_data['role_id'] = 1;
        $this->assertDatabaseHas('role_user', $verify_data);
    }

    // Authorization
    public function test_normal_users_cant_access_users_page() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get(route('users'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @dataProvider protectedRoutesProvider */
    public function test_validateAdminsCanAccessProtectedRoutes($routeName, $passIdIn, $method, $view) {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();

        $useRoute = ($passIdIn) ? route($routeName, $user->id) : route($routeName);
        $userData = $this->getUserUpdateData();

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                $response = $this->put($useRoute, $userData);
                break;
            default:
        }

        $status_codes = [Response::HTTP_OK, Response::HTTP_FOUND];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), "The status code was not an expected status code.");
        if ($view) {
            $response->assertViewIs($view);
        }
    }

    /** @dataProvider protectedRoutesProvider */
    public function test_validate_admins_cannot_access_protected_routes($routeName, $passIdIn, $method, $view) {
        $this->CreateUserAndAuthenticate();
        $user = $this->createUser();

        $useRoute = ($passIdIn) ? route($routeName, $user->id) : route($routeName);
        $userData = $this->getUserUpdateData();

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                $response = $this->put($useRoute, $userData);
                break;
            default:
        }

        $status_codes = [Response::HTTP_NOT_FOUND, Response::HTTP_UNAUTHORIZED];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), "The status code was not an expected status code.");
    }


    private function getUserUpdateData() {
        $data['name'] = 'Admiral Akbar';
        $data['email'] = 'Itsatrap@moncalamari.com';

        return $data;
    }

    public static function protectedRoutesProvider() {
        // Route name, requires user id, method, view
        return [
            ['users', false, 'get', 'users.index'],
            ['users.edit', true, 'get', 'users.edit'],
            ['users.update', true, 'put', '']
        ];
    }
}

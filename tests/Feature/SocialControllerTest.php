<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SocialControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @dataProvider protectedRoutesProvider */
    public function test_validateAdminsCanAccessProtectedRoutes($routeName, $passIdIn, $method, $view) {
        $this->CreateAdminAndAuthenticate();
        $user = $this->createUser();

        $useRoute = ($passIdIn) ? route($routeName, $user->id) : route($routeName);
        // $userData = $this->getUserUpdateData();

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                // $response = $this->put($useRoute, $userData);
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
    public function test_validate_users_cannot_access_protected_routes($routeName, $passIdIn, $method, $view) {
        $this->CreateUserAndAuthenticate();
        $user = $this->createUser();

        $useRoute = ($passIdIn) ? route($routeName, $user->id) : route($routeName);

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                // $response = $this->put($useRoute, $userData);
                break;
            default:
        }

        $status_codes = [Response::HTTP_NOT_FOUND, Response::HTTP_UNAUTHORIZED];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), "The status code was not an expected status code.");
    }

    public static function protectedRoutesProvider() {
        // Route name, requires user id, method, view
        return [
            ['socials', false, 'get', 'social.index'],
        ];
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\Social;
use Livewire\Livewire;

class SocialControllerTest extends TestCase
{

    //** Data Providers */

    public static function protectedRoutesProvider() {
        // Route name, requires user id, method, view
        return [
            ['socials', false, 'get', null],
        ];
    }

    //** Data Provider Test Classes */

    /** @dataProvider protectedRoutesProvider */
    public function test_validate_admins_can_access_protected_routes($routeName, $passIdIn, $method, $view) {
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

    //** Regular Tests */
    public function test_social_media_data_shows_up_on_socials_page() {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('socials'));

        $socials = Social::all();

        $response->assertSee($socials[0]->name);
    }

    public function test_socials_index_shows_edit_link() {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('socials'));

        $socials = Social::all();

        $response->assertSee(route('socials.edit', $socials[0]->id));
    }

    public function test_socials_index_is_a_livewire_component() {
        $this->CreateAdminAndAuthenticate();

        Livewire::test('SocialIndex')
            ->assertStatus(Response::HTTP_OK)
            ->assertSee('Manage Social Media Services');

    }
}

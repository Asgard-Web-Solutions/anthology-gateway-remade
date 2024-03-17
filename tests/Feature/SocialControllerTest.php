<?php

namespace Tests\Feature;

use App\Models\Social;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SocialControllerTest extends TestCase
{
    //** Data Providers */

    public static function protectedRoutesProvider()
    {
        // Route name, requires id, method, view
        return [
            ['socials', false, 'get', null],
            ['socials.edit', true, 'get', 'socials.edit'],
            ['socials.store', true, 'post', null],
        ];
    }

    //** Data Provider Test Classes */

    /** @dataProvider protectedRoutesProvider */
    public function test_validate_admins_can_access_protected_routes($routeName, $passIdIn, $method, $view)
    {
        $this->CreateAdminAndAuthenticate();
        $social = $this->createSocial();

        $useRoute = ($passIdIn) ? route($routeName, $social->id) : route($routeName);
        $data = $this->loadSocialData();

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                // $response = $this->put($useRoute, $userData);
                break;
            case 'post':
                $response = $this->post($useRoute, $data);
                break;
            default:
        }

        $status_codes = [Response::HTTP_OK, Response::HTTP_FOUND];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), 'The status code was not an expected status code.');
        if ($view) {
            $response->assertViewIs($view);
        }
    }

    /** @dataProvider protectedRoutesProvider */
    public function test_validate_users_cannot_access_protected_routes($routeName, $passIdIn, $method, $view)
    {
        $this->CreateUserAndAuthenticate();
        $social = $this->createSocial();

        $useRoute = ($passIdIn) ? route($routeName, $social->id) : route($routeName);
        $data = $this->loadSocialData();

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                // $response = $this->put($useRoute, $userData);
                break;
            case 'post':
                $response = $this->post($useRoute, $data);
                break;    
            default:
        }

        $status_codes = [Response::HTTP_NOT_FOUND, Response::HTTP_UNAUTHORIZED];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), 'The status code was not an expected status code.');
    }

    //** Helper Functions */
    private function createSocial(): Social
    {
        return Social::factory()->create();
    }

    private function loadSocialData(): array
    {
        $data['name'] = 'Test Social';
        $data['image'] = 'fa-light fa-plus-square';
        $data['base_url'] = 'https://x.com';

        return $data;
    }

    //** Regular Tests */
    public function test_social_media_data_shows_up_on_socials_page()
    {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('socials'));

        $socials = Social::all();

        $response->assertSee($socials[0]->name);
    }

    public function test_socials_index_shows_edit_link()
    {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('socials'));

        $socials = Social::all();

        $response->assertSee(route('socials.edit', $socials[0]->id));
    }

    public function test_socials_index_is_a_livewire_component()
    {
        $this->CreateAdminAndAuthenticate();

        Livewire::test('SocialIndex')
            ->assertStatus(Response::HTTP_OK)
            ->assertSee('Manage Social Media Services');
    }

    public function test_socials_index_has_new_form()
    {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('socials'));

        $response->assertSee(route('socials.store'));
    }

    public function test_socials_store_adds_to_db()
    {
        $this->CreateAdminAndAuthenticate();
        $data = $this->loadSocialData();

        $this->post(route('socials.store'), $data);

        $this->assertDatabaseHas('socials', $data);
    }
}

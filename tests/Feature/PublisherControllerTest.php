<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PublisherControllerTest extends TestCase
{

    //** Data Providers */

    public static function userAccessibleRoutesProvider()
    {
        // Route name, requires id, method, view
        return [
            ['dashboard', false, 'get', 'dashboard'],
            ['publisher.create', false, 'get', 'publisher.create-info'],
            ['publisher.create-detail', false, 'get', 'publisher.create'],
        ];
    }

    //** Data Provider Test Classes */

    /** @dataProvider userAccessibleRoutesProvider */
    public function test_validate_users_can_access_accessible_routes($routeName, $passIdIn, $method, $view)
    {
        $this->CreateUserAndAuthenticate();

        $useRoute = route($routeName);

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                // $response = $this->put($useRoute, $userData);
                break;
            case 'post':
                // $response = $this->post($useRoute, $data);
                break;
            default:
        }

        $status_codes = [Response::HTTP_OK];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), 'The status code was not an expected status code.');
        if ($view) {
            $response->assertViewIs($view);
        }
    }

    /** @dataProvider userAccessibleRoutesProvider */
    public function test_guest_users_cannot_access_user_accessible_routes($routeName, $passIdIn, $method, $view)
    {
        $useRoute = route($routeName);

        switch ($method) {
            case 'get':
                $response = $this->get($useRoute);
                break;
            case 'put':
                // $response = $this->put($useRoute, $userData);
                break;
            case 'post':
                // $response = $this->post($useRoute, $data);
                break;
            default:
        }
        
        // The Response::HTTP_FOUND is a 302 / Redirect status code
        $status_codes = [Response::HTTP_NOT_FOUND, Response::HTTP_UNAUTHORIZED, Response::HTTP_FORBIDDEN, Response::HTTP_FOUND];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), 'The status code was not an expected status code.');
    }


    //** Normal test methods */

    public function test_create_publisher_link_shows_on_dashboard() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee(route('publisher.create'));
    }

    public function test_create_publisher_form_saves_data() {
        $this->CreateUserAndAuthenticate();

        $data['name'] = 'Test Pubby';
        $data['description'] = 'We have an awesome publishing company that nobody has ever heard of.';
        $data['logo_url'] = 'https://example.com/somepic.jpg';

        $response = $this->post(route('publisher.store'), $data);

        $this->assertDatabaseHas('publishers', $data);
    }

    // Publisher page loads data

    // User that creates the publisher is stored as the creator

    // Publisher section in dashboard is populated

    // User is added to the teams table

    // Team members show up in the publisher page

    // User can edit the publisher info

    // Social media sites can be added to publisher profile
}
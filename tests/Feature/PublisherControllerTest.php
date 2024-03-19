<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\Publisher;
use App\Models\Social;

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
            ['publisher.edit', true, 'get', 'publisher.edit'],
            ['publisher.update', true, 'post', null],
            ['publisher.socials', true, 'get', 'publisher.socials'],
        ];
    }

    //** Data Provider Test Classes */

    /** @dataProvider userAccessibleRoutesProvider */
    public function test_validate_users_can_access_accessible_routes($routeName, $passIdIn, $method, $view)
    {
        $user = $this->CreateUserAndAuthenticate();
        $publisher = $this->createPublisher($user);
        $useRoute = ($passIdIn) ? route($routeName, $publisher->id) : route($routeName);
        $data = $this->loadPublisherFormData();

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

        if ($method == 'post') {
            $status_codes = [Response::HTTP_FOUND];
        } else {
            $status_codes = [Response::HTTP_OK];
        }

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), 'The status code was not an expected status code.');
        if ($view) {
            $response->assertViewIs($view);
        }
    }

    /** @dataProvider userAccessibleRoutesProvider */
    public function test_guests_cannot_access_user_accessible_routes($routeName, $passIdIn, $method, $view)
    {
        $user = $this->createUser();
        $publisher = $this->createPublisher($user);
        $useRoute = ($passIdIn) ? route($routeName, $publisher->id) : route($routeName);
        $data = $this->loadPublisherFormData();

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
        
        // The Response::HTTP_FOUND is a 302 / Redirect status code
        $status_codes = [Response::HTTP_NOT_FOUND, Response::HTTP_UNAUTHORIZED, Response::HTTP_FORBIDDEN, Response::HTTP_FOUND];

        $this->assertTrue(in_array($response->getStatusCode(), $status_codes), 'The status code was not an expected status code.');
    }

    //** Helper functions */
    public function createPublisher($user = null) {
        if ($user) {
            $publisher = Publisher::factory()->creator($user->id)->create();
            $user->publishers()->attach($publisher->id, ['role' => 'Owner']);
        } else {
            $publisher = Publisher::factory()->create();
        }

        return $publisher;
    }

    public function loadPublisherFormData() {
        $data['name'] = 'Test Pubby';
        $data['description'] = 'We have an awesome publishing company that nobody has ever heard of.';
        $data['logo_url'] = 'https://example.com/somepic.jpg';

        return $data;
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
        $data = $this->loadPublisherFormData();

        $response = $this->post(route('publisher.store'), $data);

        $this->assertDatabaseHas('publishers', $data);
    }

    // Publisher page loads data
    public function test_publisher_view_page_loads_data() {
        $user = $this->CreateUserAndAuthenticate();
        $publisher = $this->createPublisher($user);

        $response = $this->get(route('publisher.view', $publisher->id));

        $response->assertSee($publisher->name);
    }

    public function test_publisher_view_page_shows_config_button() {
        $user = $this->CreateUserAndAuthenticate();
        $publisher = $this->createPublisher($user);

        $response = $this->get(route('publisher.view', $publisher->id));

        $response->assertSee(route('publisher.edit', $publisher->id));
    }

    public function test_publisher_view_does_not_show_for_other_users() {
        $this->CreateUserAndAuthenticate();
        $user = $this->createUser();
        $publisher = $this->createPublisher($user);

        $response = $this->get(route('publisher.view', $publisher->id));

        $response->assertDontSee(route('publisher.edit', $publisher->id));
    }

    // User that creates the publisher is stored as the creator
    public function test_create_publisher_form_adds_user_as_creator_data() {
        $user = $this->CreateUserAndAuthenticate();
        $data = $this->loadPublisherFormData();

        $response = $this->post(route('publisher.store'), $data);

        $data['creator'] = $user->id;
        $this->assertDatabaseHas('publishers', $data);
    }

    // Publisher section in dashboard is populated
    public function test_publisher_info_shows_on_dashboard() {
        $user = $this->CreateUserAndAuthenticate();
        $publisher = $this->createPublisher($user);

        $response = $this->get(route('dashboard'));

        $response->assertSee($publisher->name);
    }

    // User is added to the teams table
    public function test_user_is_added_to_teams_table() {
        $user = $this->CreateUserAndAuthenticate();
        $data = $this->loadPublisherFormData();

        $response = $this->post(route('publisher.store'), $data);

        $publisher = Publisher::where('creator', '=', $user->id)->first();
        $teamData['user_id'] = $user->id;
        $teamData['publisher_id'] = $publisher->id;
        $teamData['role'] = 'Owner';

        $this->assertDatabaseHas('publisher_user', $teamData);
    }

    // Team members show up in the publisher page
    public function test_team_members_show_on_the_publisher_page() {
        $this->CreateUserAndAuthenticate();
        $user = $this->createUser();
        $publisher = $this->createPublisher($user);

        $response = $this->get(route('publisher.view', $publisher->id));

        $response->assertSee($user->name);
    }

    // User can edit the publisher info
    public function test_publisher_info_is_updated_via_form() {
        $user = $this->CreateUserAndAuthenticate();
        $publisher = $this->createPublisher($user);
        $data = $this->loadPublisherFormData();
        $data['name'] = 'Some new name';

        $response = $this->post(route('publisher.update', $publisher->id), $data);

        $this->assertDatabaseHas('publishers', $data);
    }

    // Social media sites can be added to publisher profile
    public function test_publisher_socials_page_loads_social_media_and_publisher_data() {
        $user = $this->CreateUserAndAuthenticate();
        $publisher = $this->createPublisher($user);
        
        $response = $this->get(route('publisher.socials', $publisher->id));      
        
        $socials = Social::all();
        $response->assertSee($publisher->name);
        $response->assertSee($socials[0]->name);
    }

    // Publisher link shows in side menu if user is part of a publisher
}
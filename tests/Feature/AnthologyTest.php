<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Anthology;
use Tests\TestCase;

class AnthologyTest extends TestCase
{
    // These are form responses that should give an error
    public static function dataProviderAnthologyCreateFormData() {
        return [
            ['name', ''],
            ['description', ''],
            ['open_date', ''],
            ['open_date', '1999-12-21'],
        ];
    }

    private function loadDataAnthologyCreateForm() {
        $data['name'] = 'Test Anthology';
        $data['description'] = 'This is a test anthology';
        $data['open_date'] = Carbon::tomorrow();

        return $data;
    }

    public function createAnthology($user = null) {
        $anthology = Anthology::factory()->create();

        if ($user) {
            $anthology->users()->attach($user->id, ['role' => 'Creator']);
        }

        return $anthology;
    }

    // DONE: Put a "create" button in the side menu
    public function test_sidebar_has_an_anthology_create_button() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertSeeInOrder(['Dashboard', route('anthology.create')], 'Profile');
    }

    // DONE: Put a create button on the dashboard
    public function test_dashboard_has_anthology_create_button() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertSeeInOrder(['Your Anthologies', route('anthology.create')]);
    }

    // TODO: Put a "create" button on the publisher view page that connects the anthology to the publisher

    // DONE: Anthology create page which gathers limited details
    public function test_anthology_creation_page_loads() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get(route('anthology.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.create');
    }

    // DONE: Anthology create page saves project do database
    public function test_anthology_create_page_saves_data() {
        $this->CreateUserAndAuthenticate();
        $data = $this->loadDataAnthologyCreateForm();

        $response = $this->post(route('anthology.store'), $data);

        $this->assertDatabaseHas('anthologies', $data);
    }

    /** @dataProvider dataProviderAnthologyCreateFormData */
    public function test_anthology_create_page_validates_data($field, $data) {
        $this->CreateUserAndAuthenticate();
        $data = $this->loadDataAnthologyCreateForm();
        $data[$field] = $data;

        $response = $this->post(route('anthology.store'), $data);

        $response->assertSessionHasErrors($field);
    }

    // DONE: Anthology manage page loads
    public function test_anthology_manage_page_loads() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.manage');
    }

    // TODO: Anthology manage page has different sections

    // TODO: Anthology edit page loads
    public function test_anthology_manage_page_links_to_info_edit() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertSee(route('anthology.edit', ['id' => $anthology->id, 'setting' => 'details']));
    }

    // TODO: Upload pics for Anthology header and book cover to an AWS like bucket

    // TODO: Anthologies can change status to "Launch"

    // TODO: Launched anthologies show up on the dashboard if opening for submissions soon

    // TODO: Launched anthologies show up on the home page

    // DONE: The dashboard shows users own anthologies
    public function test_users_anthology_shows_on_dashboard() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('dashboard'));

        $response->assertSee($anthology->name);
        $response->assertSee(route('anthology.view', $anthology->id));
    }

    // DONE: Users are added to the anthology team after creation
    public function test_users_are_added_to_the_anthology_team() {
        $user = $this->CreateUserAndAuthenticate();
        $data = $this->loadDataAnthologyCreateForm();

        $result = $this->post(route('anthology.store'), $data);

        $verifyData['user_id'] = $user->id;
        $verifyData['anthology_id'] = 1;

        $this->assertDatabaseHas('anthology_user', $verifyData);
    }

    // DONE: Anthology view page loads
    public function test_anthology_view_page_loads() {
        $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology();

        $response = $this->get(route('anthology.view', $anthology->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.view');
        $response->assertSee($anthology->name);
    }
}

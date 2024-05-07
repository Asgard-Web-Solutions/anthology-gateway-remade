<?php

namespace Tests\Feature;

use App\Models\Anthology;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Enums\AnthologyStatus;

class AnthologyControllerTest extends TestCase
{
    // These are form responses that should give an error
    public static function dataProviderAnthologyCreateFormData()
    {
        return [
            ['name', ''],
            ['description', ''],
            ['open_date', ''],
            ['open_date', '1999-12-21'],
        ];
    }

    private function loadDataAnthologyCreateForm()
    {
        $data['name'] = 'Test Anthology';
        $data['description'] = 'This is a test anthology';
        $data['open_date'] = Carbon::tomorrow();

        return $data;
    }

    public function createAnthology($user = null)
    {
        $anthology = Anthology::factory()->create();

        if ($user) {
            $anthology->users()->attach($user->id, ['role' => 'Creator']);
        }

        return $anthology;
    }

    // DONE: Put a "create" button in the side menu
    public function test_sidebar_has_an_anthology_create_button()
    {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertSeeInOrder(['Dashboard', route('anthology.create')], 'Profile');
    }

    // DONE: Put a create button on the dashboard
    public function test_dashboard_has_anthology_create_button()
    {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertSeeInOrder(['Your Anthologies', route('anthology.create')]);
    }

    // DONE: Put a "create" button on the publisher view page that connects the anthology to the publisher

    // DONE: Anthology create page which gathers limited details
    public function test_anthology_creation_page_loads()
    {
        $this->CreateUserAndAuthenticate();

        $response = $this->get(route('anthology.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.create');
    }

    // DONE: Anthology create page saves project do database
    public function test_anthology_create_page_saves_data()
    {
        $this->CreateUserAndAuthenticate();
        $data = $this->loadDataAnthologyCreateForm();

        $response = $this->post(route('anthology.store'), $data);

        $this->assertDatabaseHas('anthologies', $data);
    }

    /** @dataProvider dataProviderAnthologyCreateFormData */
    public function test_anthology_create_page_validates_data($field, $data)
    {
        $this->CreateUserAndAuthenticate();
        $data = $this->loadDataAnthologyCreateForm();
        $data[$field] = $data;

        $response = $this->post(route('anthology.store'), $data);

        $response->assertSessionHasErrors($field);
    }

    // DONE: Anthology manage page loads
    public function test_anthology_manage_page_loads()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.manage');
    }

    // DONE: Anthology manage page has different sections

    // DONE: Anthology edit page loads
    public function test_anthology_manage_page_links_to_info_edit()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertSee(route('anthology.edit', ['id' => $anthology->id, 'setting' => 'basic']));
    }

    public function test_anthology_edit_page_lists_specific_settings()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('anthology.edit', ['id' => $anthology->id, 'setting' => 'basic']));

        $response->assertSee($anthology->name);
        $response->assertSee($anthology->description);
    }

    public function test_anthology_update_saves_data()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $data['name'] = 'Test Updated Name';
        $data['description'] = 'Updated description';

        $response = $this->post(route('anthology.update', $anthology->id), $data);

        $this->assertDatabaseHas('anthologies', $data);
    }

    // DONE: Upload pics for Anthology header and book cover to an AWS like bucket

    // DONE: Anthologies can change status to "Launch"
    public function test_disabled_launch_button_appears_on_management_page()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertSeeInOrder(['cursor-not-allowed', 'Launch']);
    }

    public function test_configuring_final_section_changes_status_to_prelaunch()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->configured_basic_details = 1;
        $anthology->configured_dates = 1;
        $anthology->configured_images = 1;
        $anthology->configured_submission_details = 1;
        $anthology->configured_message_text = 1;
        $anthology->configured_payment_details = 0;
        $anthology->save();

        $data['pay_amount'] = '12.00';
        $data['pay_supplemental'] = 'blah';
        $data['setting'] = 'payments';

        $response = $this->post(route('anthology.update', $anthology->id), $data);

        $verifyData['id'] = $anthology->id;
        $verifyData['configured_payment_details'] = 1;
        $verifyData['status'] = 'prelaunch';
        $this->assertDatabaseHas('anthologies', $verifyData);
    }

    public function test_prelaunch_anthologies_show_launch_button() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Prelaunch;
        $anthology->save();

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertDontSee('cursor-not-allowed');
        $response->assertSee('fa-rocket-launch');
    }

    public function test_launch_page_loads() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Prelaunch;
        $anthology->save();

        $response = $this->get(route('anthology.launch', $anthology->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.launch');
        $response->assertSee($anthology->name);
    }

    public function test_launch_confirm_page_launches_project()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Prelaunch;
        $anthology->save();

        $response = $this->get(route('anthology.launch_confirm', $anthology->id));

        $verifyData['id'] = $anthology->id;
        $verifyData['status'] = AnthologyStatus::Launched;

        $this->assertDatabaseHas('anthologies', $verifyData);
    }

    public function test_launch_confirm_redirects_to_manage_page() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Prelaunch;
        $anthology->save();

        $response = $this->get(route('anthology.launch_confirm', $anthology->id));

        $response->assertRedirect(route('anthology.manage', $anthology->id));
    }

    public function test_launch_button_does_not_show_for_launched_projects() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Launched;
        $anthology->save();

        $response = $this->get(route('anthology.manage', $anthology->id));

        $response->assertDontSee(route('anthology.launch', $anthology->id));
    }

    public function test_launch_page_checks_for_appropriate_status() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Launched;
        $anthology->save();

        $response = $this->get(route('anthology.launch', $anthology->id));

        $response->assertRedirectToRoute('anthology.manage', $anthology->id);
    }

    public function test_launch_confirm_checks_for_appropriate_status() {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);
        $anthology->status = AnthologyStatus::Launched;
        $anthology->save();

        $response = $this->get(route('anthology.launch_confirm', $anthology->id));

        $verifyData['id'] = $anthology->id;
        $verifyData['status'] = AnthologyStatus::Launched;

        $response->assertRedirectToRoute('anthology.manage', $anthology->id);
        $response->assertSessionHas('warning');
        $this->assertDatabaseHas('anthologies', $verifyData);
    }

    // TODO: Launched anthologies show up on the home page

    // DONE: The dashboard shows users own anthologies
    public function test_users_anthology_shows_on_dashboard()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology($user);

        $response = $this->get(route('dashboard'));

        $response->assertSee($anthology->name);
        $response->assertSee(route('anthology.view', $anthology->id));
    }

    // DONE: Users are added to the anthology team after creation
    public function test_users_are_added_to_the_anthology_team()
    {
        $user = $this->CreateUserAndAuthenticate();
        $data = $this->loadDataAnthologyCreateForm();

        $result = $this->post(route('anthology.store'), $data);

        $verifyData['user_id'] = $user->id;
        $verifyData['anthology_id'] = 1;

        $this->assertDatabaseHas('anthology_user', $verifyData);
    }

    // DONE: Anthology view page loads
    public function test_anthology_view_page_loads()
    {
        $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology();

        $response = $this->get(route('anthology.view', $anthology->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.view');
        $response->assertSee($anthology->name);
    }

    // DONE: Create an anthology management page
    public function test_anthology_index_page_loads()
    {
        $this->CreateAdminAndAuthenticate();
        $anthology = $this->createAnthology();

        $response = $this->get(route('anthologies'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.index');
        $response->assertSee($anthology->name);
    }

    // TODO: Write a command to delete all images from s3 for dev environments only 

    // DONE: Create a public page to list all launched anthology projects
    public function test_anthology_list_page_loads()
    {
        $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology();
        $anthology->status = AnthologyStatus::Launched;
        $anthology->save();
        
        $response = $this->get(route('anthology.list'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.list');
        $response->assertSee($anthology->name);
    }

    // DONE: Show a bookmark link on the anthology page for logged in users
    public function test_bookmark_link_shows_on_anthology_view_page()
    {
        $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology();

        $response = $this->get(route('anthology.view', $anthology->id));

        $response->assertSee(route('anthology.bookmark'));
    }

    // DONE: Allow users to bookmark an anthology
    public function test_bookmark_page_loads()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology();

        $response = $this->post(route('anthology.bookmark'), ['anthology_id' => $anthology->id]);

        $data['user_id'] = $user->id;
        $data['anthology_id'] = $anthology->id;

        $response->assertRedirect(route('anthology.view', $anthology->id));
        $this->assertDatabaseHas('user_anthology_bookmarks', $data);
    }

    public function test_bookmarked_anthology_shows_unbookmark_link()
    {
        $user = $this->CreateUserAndAuthenticate();
        $anthology = $this->createAnthology();
        $user->anthologyBookmarks()->attach($anthology->id);

        $response = $this->get(route('anthology.view', $anthology->id));

        $response->assertSee(route('anthology.unbookmark'));
    }

    // TODO: Favorited anthologies show up on the dashboard

    // TODO: Favorited anthology shows link to unbookmark it

    // TODO: Removing a bookmark removes it from the dashboard list
}

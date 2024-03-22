<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    // DONE: Put a "create" button in the side menu
    public function test_sidebar_has_an_anthology_create_button() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertSeeInOrder(['Dashboard', route('anthology.create')], 'Profile');
    }

    // TODO: Put a "create" button on the publisher view page

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

    // TODO: Anthology manage page
    public function anthology_manage_page_loads() {
        $this->CreateUserAndAuthenticate();
    }

    // TODO: Anthology manage page has different sections

    // TODO: Anthology info edit pages

    // TODO: Upload pics for Anthology header and book cover to an AWS like bucket

    // TODO: Anthologies can change status to "Launch"

    // TODO: Launched anthologies show up on the dashboard if opening for submissions soon

    // TODO: Launched anthologies show up on the home page
}

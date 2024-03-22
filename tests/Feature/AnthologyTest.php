<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnthologyTest extends TestCase
{
    // DONE: Put a "create" button in the side menu
    public function test_sidebar_has_an_anthology_create_button() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get('dashboard');

        $response->assertSeeInOrder(['Dashboard', route('anthology.create')], 'Profile');
    }

    // TODO: Put a "create" button on the publisher view page

    // TODO: Anthology create page which gathers limited details
    public function test_anthology_creation_page_loads() {
        $this->CreateUserAndAuthenticate();

        $response = $this->get(route('anthology.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('anthology.create');
    }

    // TODO: Anthology create page saves project do database

    // TODO: Anthology view page

    // TODO: Anthology view page has different sections

    // TODO: Anthology info edit pages

    // TODO: Upload pics for Anthology header and book cover to an AWS like bucket

    // TODO: Anthologies can change status to "Launch"

    // TODO: Launched anthologies show up on the dashboard if opening for submissions soon

    // TODO: Launched anthologies show up on the home page
}

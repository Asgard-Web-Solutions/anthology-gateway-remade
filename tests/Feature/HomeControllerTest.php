<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_settings_page_loads()
    {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('settings'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('home.settings');
    }

    public function test_social_media_config_shows_on_settings_page()
    {
        $this->CreateAdminAndAuthenticate();

        $response = $this->get(route('settings'));

        $response->assertSee(route('socials'));
    }

    // TODO: Create a home page
}

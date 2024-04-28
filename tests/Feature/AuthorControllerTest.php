<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    private function loadAuthorData() {
        $data['name'] = 'Wash';
        $data['biography'] = 'I\'m a pilot! Like a leaf on the wind.';
        $data['email'] = 'canttaketheskyfromme@serenity.com';
        $data['website'] = 'https://serenity.com';
        $data['address_street_1'] = 'Deep Dark Ln';
        $data['address_street_2'] = null;
        $data['address_city'] = 'Persephony';
        $data['address_state'] = 'Another Planet';
        $data['address_country'] = 'Federation';

        return $data;
    }

    public function test_dashboard_links_to_author_create_page() 
    {
        $user = $this->CreateUserAndAuthenticate();

        $response = $this->get(route('dashboard'));

        $response->assertSee(route('author.create'));
    }

    public function test_author_create_page_loads()
    {
        $user = $this->CreateUserAndAuthenticate();

        $response = $this->get(route('author.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('author.create');
    }

    public function test_author_store_page_saves_information()
    {
        $user = $this->CreateUserAndAuthenticate();
        $data = $this->loadAuthorData();

        $response = $this->post(route('author.store'), $data);

        $this->assertDatabaseHas('authors', $data);

        $userData['id'] = $user->id;
        $userData['author_id'] = 1;
        $this->assertDatabaseHas('users', $userData);
    }

    public function test_author_store_page_redirects_to_dashboard()
    {
        $user = $this->CreateUserAndAuthenticate();
        $data = $this->loadAuthorData();

        $response = $this->post(route('author.store'), $data);

        $response->assertRedirect(route('dashboard'));
    }

    public function test_author_shows_on_dashboard_with_edit_link()
    {
        $user = $this->CreateUserAndAuthenticate();
        $author = $this->CreateAuthor($user);

        $response = $this->get(route('dashboard'));

        $response->assertSee(route('author.edit', $author->id));
    }
}

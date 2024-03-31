<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // TODO: Create a search page

    // TODO: Search page searches for anthologies

    // TODO: Search page searches for publishers

    // TODO: Search page shows anthologies by a publisher that was searched for

    // TODO: Search page shows publishers that created an anthology that was searched for
}

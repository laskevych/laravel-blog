<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testAboutPageIsWorkingCorrectly()
    {
        $response = $this->get('/about');
        $response->assertSeeText('About');
    }

    public function testSecretPageIsWorkingForAdmin()
    {
        $user = $this->userAdmin();
        
        $this->assertDatabaseHas('users', [
            'is_admin' => 1
        ]);

        $this->actingAs($user)
            ->get('/secret')
            ->assertSeeText('Secret Page!');
    }

    public function testSecretPageDontWorkingForUser()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->get('/about')
            ->assertDontSeeText('Secret Page!');
    }
}

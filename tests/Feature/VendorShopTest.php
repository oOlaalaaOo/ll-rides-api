<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class VendorShopTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIfNoLoggedInUserShouldNotGetShops()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json'
        ])->json('GET', '/api/vendor/shop/all?page=0');

        $response->assertUnauthorized();
    }

    public function testIfHasLoggedInUserShouldGetShops()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                        ->withHeaders([
                            'Content-Type' => 'application/json'
                        ])
                        ->json('GET', '/api/vendor/shop/all?page=0');

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true
                ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserPost;

class UserPostApiTest extends TestCase
{
    public function test()
    {
        $user = factory(User::class)->create();

        $response = $this->get('/api/user/post');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Get ALL THE USERS WITH PERMISSION
     *
     * @return void
     */
    public function testGetAllUsersWithPermission()
    {
        $user = User::get()->random();

        $response = $this->actingAs($user)->get('/api/users');

        $response->assertStatus(200);
    }


    /**
     * Get ALL THE USERS WITHOUT PERMISSION
     *
     * @return void
     */
    public function testGetAllUsersWithoutPermission()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(500);
    }

    
}

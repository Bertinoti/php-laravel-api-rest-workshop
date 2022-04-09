<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Property;

class PropertyTest extends TestCase
{
    /**
     * Get All THE PROPERTIES
     *
     * @return void
     */
    public function testGetAllProperties()
    {
        $response = $this->get('/api/properties');

        $response->assertStatus(200);
    }


    /**
     * Get Data FROM ONE SINGLE PROPERTY
     *
     * @return void
     */
    public function testSinglePropertyWithPermission() {
        
        $user = User::get()->random();
        $property = Property::get()->random();

        $response = $this->actingAs($user)->get('/api/properties/' . $property->id);

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_api_returns_available_rooms()
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create(['city' => 'Doha']);
        Room::factory()->create([
            'hotel_id' => $hotel->id,
            'max_occupancy' => 2,
            'available_rooms' => 5,
        ]);

        $payload = [
            'city' => 'Doha',
            'checkin_date' => now()->addDay()->format('Y-m-d'),
            'checkout_date' => now()->addDays(5)->format('Y-m-d'),
            'guests' => 2
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/search?' . http_build_query($payload));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'hotel_name' => $hotel->name,
                'city' => 'Doha',
            ]);
    }
}

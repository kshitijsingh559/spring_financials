<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AddPointsTest extends TestCase
{
    public function test_add_points_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/v1/add-points', [
            'user_id' => $user->id,
            'points'  => 1,
            'operator' => 'add'
        ]);

        $response->assertStatus(200);
    }

    public function test_subtract_points_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/v1/add-points', [
            'user_id' => $user->id,
            'points'  => 1,
            'operator' => 'sub'
        ]);

        $response->assertStatus(200);
    }


    public function test_add_points_with_invalid_data(): void
    {
        $response = $this->post('/api/v1/add-points', [
            'points'  => 1,
            'operator' => 'add'
        ]);

        $response->assertStatus(422);
    }
}

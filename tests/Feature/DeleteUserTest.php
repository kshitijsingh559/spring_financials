<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    public function test_delete_user_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/v1/delete-user', [
            'user_id' => $user->id
        ]);

        $response->assertStatus(200);
    }


    public function test_delete_user_with_invalid_data(): void
    {
        $response = $this->post('/api/v1/delete-user', []);

        $response->assertStatus(422);
    }
}

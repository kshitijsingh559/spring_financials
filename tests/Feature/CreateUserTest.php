<?php

namespace Tests\Feature;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    public function test_create_user_with_valid_data(): void
    {
        $response = $this->post('/api/v1/create-user', [
            'name' => 'Kshitij Singh',
            'age'  => 30,
            'address' => 'Sector 22, Noida, India, 201301'
        ]);

        $response->assertStatus(200);
    }


    public function test_create_user_with_invalid_data(): void
    {
        $response = $this->post('/api/v1/create-user', [
            'age'  => 30,
            'address' => 'Sector 22, Noida, India, 201301'
        ]);

        $response->assertStatus(422);
    }
}

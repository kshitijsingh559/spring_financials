<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserGroupByPointsTest extends TestCase
{
    public function test_user_group_by_points_api(): void
    {
        $response = $this->get('/api/v1/users-group-by-points');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeaderBoardTest extends TestCase
{
    public function test_leaderboard_api(): void
    {
        $response = $this->get('/api/v1/leaderboard');

        $response->assertStatus(200);
    }
}

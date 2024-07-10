<?php

namespace App\Services\V1\UserService;

interface UserServiceInterface
{
    public function leaderboard();

    public function usersGroupedByPoints();

    public function createUser($reqData);

    public function addPoints($userId, $points);

    public function resetAllScores();

    public function generateQrCode($user);

    public function declareWinner();
}

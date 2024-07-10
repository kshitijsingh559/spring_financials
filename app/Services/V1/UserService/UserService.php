<?php

namespace App\Services\V1\UserService;

use App\Models\User;
use App\Models\Winner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    public function leaderboard()
    {
        return User::orderBy('points', 'desc')->get();
    }

    public function usersGroupedByPoints()
    {
        $users = $this->leaderboard();
        $groupedArray = [];
        foreach ($users as $user) {
            $groupedArray[$user->points]['name'][] = $user->name;
            $groupedArray[$user->points]['age'][] = $user->age;
        }
        foreach ($groupedArray as $key => $single) {
            $groupedArray[$key]['average_age'] = $this->calculateAverage($single['age']);
            unset($groupedArray[$key]['age']);
        }
        return $groupedArray;
    }

    public function calculateAverage($array) {
        return array_sum($array) / count($array);
    }

    public function createUser($reqData)
    {
        return User::create([
            "name" => $reqData['name'] ?? '',
            "age" => $reqData['age'] ?? 0,
            "points" => 0,
            "address" => $reqData['address'] ?? '',
        ]);
    }

    public function addPoints($userId, $points)
    {
        $user = User::find($userId);
        if (empty($user)) {
            return null;
        }
        $points = $user->points + $points;
        $user->points = $points;
        $user->save();
        return $user;
    }

    public function resetAllScores()
    {
        User::where('points', '!=', 0)->update(["points" => 0]);
        return true;
    }

    public function generateQrCode($user)
    {
        if (!empty($user) && !empty($user->address)) {
            $url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($user->address);
            $contents = file_get_contents($url);
            $name = $user->id . '-' . time() . '.png';
            Storage::put($name, $contents);
            $user->qr_code = $name;
            $user->save();
            return $user;
        }
        return null;
    }

    public function declareWinner()
    {
        $userWithHighestPoints = User::orderBy('points', 'desc')->first();
        if (!empty($userWithHighestPoints)) {
            $checkForOtherWinner = User::where('points', $userWithHighestPoints->points)->where('id', '!=', $userWithHighestPoints->id)->first();
            if (empty($checkForOtherWinner)) {
                Winner::create([
                    "user_id" => $userWithHighestPoints->id,
                    "points"  => $userWithHighestPoints->points
                ]);
            }
        }
    }
}

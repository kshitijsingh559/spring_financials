<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\User\LeaderboardResource;
use App\Http\Resources\User\UserGroupedByPointResource;
use App\Services\V1\UserService\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request)
    {
        $data = $request->safe()->all();
        try {
            $user = $this->userService->createUser($data);
            return LeaderboardResource::make($user)
                ->additional([
                    'status_code' => 200,
                    'success' => true,
                ])->response()->setStatusCode(200);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            $responseData = [
                'status_code' => 500,
                'success' => false,
                'data' => null
            ];
            return (new GeneralResource($responseData))->response()->setStatusCode($responseData['status_code']);
        }


    }

    public function leaderboard(Request $request)
    {
        try {
            $leaderboard = $this->userService->leaderboard();
            return LeaderboardResource::collection($leaderboard)
                ->additional([
                    'status_code' => 200,
                    'success' => true,
                ])->response()->setStatusCode(200);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            $responseData = [
                'status_code' => 500,
                'success' => false,
                'data' => []
            ];
            return (new GeneralResource($responseData))->response()->setStatusCode($responseData['status_code']);
        }
    }

    public function usersGroupedByPoints(Request $request)
    {
        try {
            $usersGroupedByPoints = $this->userService->usersGroupedByPoints();
            return response()->json($usersGroupedByPoints);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            $responseData = [
                'status_code' => 500,
                'success' => false,
                'message' => $ex->getMessage(),
                'data' => []
            ];
            return (new GeneralResource($responseData))->response()->setStatusCode($responseData['status_code']);
        }
    }
}

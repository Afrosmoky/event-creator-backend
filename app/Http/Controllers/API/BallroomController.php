<?php

namespace App\Http\Controllers\API;


use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BallroomController extends Controller
{
    public function getBallroom($ballroomId): \Illuminate\Http\JsonResponse
    {
        $response = Http::withToken(config('services.emka.token'))->get(config('services.emka.api_url')."/$ballroomId/ballroom");
        $ballroom = $response->json();

        return ApiResponseClass::sendResponse($ballroom,'',200);
    }
}

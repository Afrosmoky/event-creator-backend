<?php

namespace App\Http\Controllers\API;

use App\Classes\ApiResponseClass;
use App\Exports\GuestExport;
use App\Helpers\GuestHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GuestNote;

class GuestController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/guest/getlist/{ballroomId}",
     *     summary="Get guest lists from Emka Backend",
     *     description="Emka backend is a layer from application mother.",
     *     tags={"Guests"},
     *     @OA\Parameter(
     *         name="ballroomId",
     *         in="path",
     *         description="ID of the ballroom to retrieve guests for",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example="ballroom-123"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of guests retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="guest_id", type="string", example="550e8400-e29b-41d4-a716-446655440000"),
     *                 @OA\Property(property="element_id", type="string", example="chair-123"),
     *                 @OA\Property(property="ballroom_id", type="string", example="ballroom-123"),
     *                 @OA\Property(property="seated", type="boolean", example=true),
     *                 @OA\Property(property="group", type="string", example="VIP"),
     *                 @OA\Property(property="age_group", type="string", example="children"),
     *                 @OA\Property(property="gender", type="string", example="M"),
     *                 @OA\Property(property="menu", type="string", example="S"),
     *                 @OA\Property(property="parameters", type="object", example={"dietary_preference": "vegetarian"})
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ballroom not found"
     *     )
     * )
     */
    public function getGuests($ballroomId): \Illuminate\Http\JsonResponse
    {
        $response = Http::withToken(config('services.emka.token'))->get(config('services.emka.api_url')."/$ballroomId/guests");

        $guests = collect($response->json())
            ->map(fn ($item) => GuestHelper::mapExternalGuest($item, $ballroomId))
            ->values();

        $guestIds = $guests->pluck('guest_id')->all();

        $notesByGuestId = GuestNote::whereIn('guest_id', $guestIds)
            ->pluck('note', 'guest_id');

        $guests = $guests->map(function (array $guest) use ($notesByGuestId) {
            $guest['note'] = $notesByGuestId[$guest['guest_id']] ?? null;
            return $guest;
        });

        return ApiResponseClass::sendResponse($guests,'',200);
    }

    /**
     * @OA\Get(
     *     path="/api/guest/export/{ballroomId}",
     *     summary="Export lists of guests assigned to table",
     *     tags={"Guests"},
     *     @OA\Parameter(
     *         name="ballroom_id",
     *         in="path",
     *         description="Id that represent specific stage/ballroom. Give string cause assume it might be UUID",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example="ballroom-456"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dwonload excel file contains guest's list",
     *         @OA\JsonContent(
     *             type="file",
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials/token"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ballroom not found"
     *     )
     * )
     */
    public function export($ballroomId): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $response = Http::withToken(config('services.emka.token'))
            ->get(config('services.emka.api_url') . "/$ballroomId/guests");

        $guests = collect($response->json())
            ->map(fn ($item) => GuestHelper::mapExternalGuest($item, $ballroomId))
            ->values();

        $guestIds = $guests->pluck('guest_id')->all();

        $notesByGuestId = GuestNote::whereIn('guest_id', $guestIds)
            ->pluck('note', 'guest_id');

        $guests = $guests->map(function (array $guest) use ($notesByGuestId) {
            $guest['note'] = $notesByGuestId[$guest['guest_id']] ?? null;
            return $guest;
        });

        return Excel::download(
            new GuestExport($ballroomId, $guests),
            'guests.xlsx'
        );
    }
}

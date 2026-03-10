<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BallroomConfig;
use Illuminate\Http\Request;

class BallroomConfigController extends Controller
{
    public function show(string $ballroomId)
    {
        $config = BallroomConfig::where('ballroom_id', $ballroomId)->first();

        if (!$config) {
            return response()->json((object)[]);
        }

        return response()->json($config);
    }

    public function update(Request $request, string $ballroomId)
    {
        $data = $request->validate([
            'canvas_width' => 'nullable|integer|min:0',
            'canvas_height' => 'nullable|integer|min:0',
        ]);

        $config = BallroomConfig::updateOrCreate(
            ['ballroom_id' => $ballroomId],
            $data
        );

        return response()->json($config);
    }
}

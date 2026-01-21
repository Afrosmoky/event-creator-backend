<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GuestNote;

class GuestNoteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'guest_id' => ['required', 'uuid'],
            'note'     => ['nullable', 'string'],
        ]);

        $guestNote = GuestNote::updateOrCreate(
            ['guest_id' => $data['guest_id']],
            ['note' => $data['note']]
        );

        return response()->json(['status' => 'ok', 'data' => $guestNote]);
    }

    public function update(Request $request, string $guest_id)
    {
        $data = $request->validate([
            'note' => ['nullable', 'string'],
        ]);

        $guestNote = GuestNote::updateOrCreate(
            ['guest_id' => $guest_id],
            ['note' => $data['note']]
        );

        return response()->json(['status' => 'ok', 'data' => $guestNote]);
    }
}

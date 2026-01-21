<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestNote extends Model
{
    protected $fillable = [
        'guest_id',
        'note',
    ];

    protected $casts = [
        'guest_id' => 'string',
    ];
}

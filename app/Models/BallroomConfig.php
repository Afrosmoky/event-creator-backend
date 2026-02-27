<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BallroomConfig extends Model
{
    protected $fillable = [
        'ballroom_id',
        'canvas_width',
        'canvas_height',
    ];

    protected $casts = [
        'canvas_width' => 'integer',
        'canvas_height' => 'integer',
    ];
}

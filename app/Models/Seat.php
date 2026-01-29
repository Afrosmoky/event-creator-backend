<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'index',
        'element_id',
        'ballroom_id',
        'label'
    ];

    protected $table = 'seats';

    public function element(): BelongsTo
    {
        return $this->belongsTo(Element::class);
    }
}

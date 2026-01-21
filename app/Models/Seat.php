<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }
}

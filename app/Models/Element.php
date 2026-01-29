<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Element extends Model
{
    use HasFactory;
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'index',
        'focus',
        'icon',
        'ballroom_id',
        'parent_id',
        'color',
        'kind',
        'spacing',
        'status',
        'x',
        'y',
        'jsonb',
        'angle',
        'width',
        'height',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function config(): HasOne
    {
        return $this->HasOne(ElementConfig::class);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}


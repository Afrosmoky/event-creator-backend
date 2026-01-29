<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ElementConfig extends Model
{
    use HasFactory;
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'seats',
        'radius',
        'width',
        'height',
        'size',
        'angle',
        'angle_origin_x',
        'angle_origin_y',
        'element_id',
        'arms_width',
        'bottom_height',
        'top_height',
        'bottom_width',
        'show_unseated',
        'border_color',
        'border_width',
        'name_color',
        'name_font_size',
        'name_bold',
        'name_italic',
        'seat_facing',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function element(): BelongsTo
    {
        return $this->belongsTo(Element::class);
    }
}

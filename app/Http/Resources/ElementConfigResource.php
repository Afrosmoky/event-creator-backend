<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'element_id' =>$this->element_id,
            'seats' => $this->seats,
            'radius' => $this->radius,
            'width' => $this->width,
            'height' => $this->height,
            'size' => $this->size,
            'angle' => $this->angle,
            'angle_origin_x' => $this->angle_origin_x,
            'angle_origin_y' => $this->angle_origin_y,
            'arms_width' => $this->arms_width,
            'bottom_height' => $this->bottom_height,
            'top_height' => $this->top_height,
            'bottom_width' => $this->bottom_width,
            'show_unseated' => $this->show_unseated,
            'border_color'  => $this->border_color,
            'border_width' => $this->border_width,
            'name_color' => $this->name_color,
            'name_font_size' => $this->name_font_size,
            'name_bold' => $this->name_bold,
            'name_italic' => $this->name_italic,
            'seat_facing' => $this->seat_facing,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}

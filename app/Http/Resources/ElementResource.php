<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'type' => $this->type,
            'index' => $this->index,
            'focus' => $this->focus,
            'icon'  => $this->icon,
            'ballroom_id' => $this->ballroom_id,
            'x' => $this->x,
            'y' => $this->y,
            'color' => $this->color,
            'kind' => $this->kind,
            'spacing' => $this->spacing,
            'status' => $this->status,
            'config' => [
                'seats' => $this->config->seats,
                'radius' => $this->config->radius,
                'width' => $this->config->width,
                'height' => $this->config->height,
                'size' => $this->config->size,
                'angle' => $this->config->angle,
                'angle_origin_x' => $this->config->angle_origin_x,
                'angle_origin_y' => $this->config->angle_origin_y,
                'arms_width' => $this->config->arms_width,
                'bottom_height' => $this->config->bottom_height,
                'top_height' => $this->config->top_height,
                'bottom_width' => $this->config->bottom_width,
                'show_unseated' => $this->config->show_unseated,
                'border_color'  => $this->config->border_color,
                'border_width' => $this->config->border_width,
                'name_color' => $this->config->name_color,
                'name_font_size' => $this->config->name_font_size,
                'name_bold' => $this->config->name_bold,
                'name_italic' => $this->config->name_italic,
                'seat_facing' => $this->config->seat_facing,
            ],
            'created_at' => $this->created_at->format("Y-m-d H:i:s"),
            'updated_at' => $this->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}


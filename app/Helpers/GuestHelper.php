<?php

namespace App\Helpers;

final readonly class GuestHelper
{
    public static function mapExternalGuest(array $item, $ballroomId): array
    {
        return [
            'id'          => $item['person']['id'],
            'guest_id'    => $item['person']['id'],
            'name'        => $item['person']['name'] ?? null,
            'surname'     => $item['person']['surname'] ?? null,
            'element_id'  => null,
            'ballroom_id' => $ballroomId,
            'gender'      => $item['person']['gender'] ?? null,
            'age_group'   => $item['person']['age_group'] ?? null,
            'menu'        => $item['person']['menu'],
            'seated'      => false,
            'group'       => $item['person']['group_name'] ?? null,
            'note'        => null,
        ];
    }
}
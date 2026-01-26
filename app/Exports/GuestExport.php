<?php

namespace App\Exports;

use App\Models\Seat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestExport implements FromCollection, WithHeadings
{
    public function __construct(
        private int $ballroomId,
        private \Illuminate\Support\Collection $guests
    ) {}

    public function collection()
    {

        $guestsById = $this->guests->keyBy('guest_id');

        return Seat::query()
            ->where('ballroom_id', $this->ballroomId)
            ->whereNotNull('guest_id')
            ->with('element:id,name')
            ->orderBy('element_id')
            ->orderBy('index')
            ->get()
            ->map(function (Seat $seat) use ($guestsById) {
                $guest = $guestsById->get($seat->guest_id);

                return [
                    'Guest Name'       => $guest['name'] ?? null,
                    'Guest Surname'    => $guest['surname'] ?? null,
                    'Guest Gender'     => $guest['gender'] ?? null,
                    'Guest Age Group'  => $guest['age_group'] ?? null,
                    'Guest Menu'       => $guest['menu'] ?? null,
                    'Guest Group'      => $guest['group'] ?? null,
                    'Guest Note'       => $guest['note'] ?? null,
                    'Table'            => $seat->element->name,
                    'Seat No'          => $seat->index,
                    'Seat Label'       => $seat->label,
                ];
            });
    }

    public function headings(): array
    {
        return [
            "Imię gościa",
            "Nazwisko gościa",
            "Płeć",
            "Grupa wiekowa",
            "Menu",
            "Grupa zakwalifikowania",
            "Notatka",
            "Nazwa stołu",
            "Numer krzesła",
            "Etykieta krzesła",
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Guest;
use App\Models\Seat;
use Maatwebsite\Excel\Concerns\FromCollection;


class GuestExport implements FromCollection
{
    public function __construct(
        private int $ballroomId)
    {}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Seat::query()
            ->where('ballroom_id', $this->ballroomId)
            ->with(['guest:id,name', 'element:id,name'])
            ->orderBy('element_id')
            ->orderBy('index')
            ->get()
            ->map(fn ($seat) => [
                'Guest Name'      => $seat->guest?->name,
                'Guest Surname'      => $seat->guest?->surname,
                'Guest Gender'      => $seat->guest?->gender,
                'Guest Age Group'      => $seat->guest?->age_group,
                'Guest Menu'      => $seat->guest?->menu,
                'Guest Group'      => $seat->guest?->group,
                'Guest Note'      => $seat->guest?->note,
                'Table'      => $seat->element->name,
                'Seat No'    => $seat->index,
                'Seat Label' => $seat->label,

            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Imię gościa", "Nazwisko gościa", "Płeć", "Grupa wiekowa", "Menu", "Grupa zakwalifikowania", "Notatka", "Nazwa stołu", "Numer krzesła", "Etykieta Krzesła"];
    }
}

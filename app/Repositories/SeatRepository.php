<?php

namespace App\Repositories;

use App\Classes\ApiResponseClass;
use App\Interfaces\SeatRepositoryInterface;
use App\Models\Seat;

class SeatRepository implements SeatRepositoryInterface
{
    public function getByElementId($elementId)
    {

        $seats = Seat::select()->where("element_id",$elementId)->get();

        return $seats;
    }

    public function getByBallroomId($ballroomId)
    {

        $seats = Seat::select()->where("ballroom_id",$ballroomId)->get();

        return $seats;
    }

    public function store(array $data)
    {
        return Seat::create($data);
    }

    public function assignGuestToSeat(array $data, $seatId)
    {
        return Seat::whereId($seatId)->update($data);
    }

    public function releaseSeat($seatId)
    {
        Seat::destroy($seatId);
    }

    public function releaseSeatsByElement($elementId)
    {
        Seat::where('element_id', $elementId)->delete();
    }

    public function releaseSeatsByBallroom($ballroomId)
    {
        Seat::where('ballroom_id', $ballroomId)->delete();
    }
}

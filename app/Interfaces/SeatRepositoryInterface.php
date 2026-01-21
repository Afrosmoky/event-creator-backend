<?php

namespace App\Interfaces;

interface SeatRepositoryInterface
{
    public function getByElementId($elementId);
    public function assignGuestToSeat(array $data, $seatId);
    public function releaseSeat($seatId);

    public function releaseSeatsByBallroom($ballroomId);

    public function releaseSeatsByElement($elementId);

    public function getByBallroomId($ballroomId);

    public function store(array $data);
}
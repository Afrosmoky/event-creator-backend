<?php

namespace App\Interfaces;

interface ElementRepositoryInterface
{
    public function index();
    public function getById($id);
    public function getByBallroomId($ballroomId);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
}

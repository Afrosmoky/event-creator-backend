<?php

namespace App\Interfaces;

interface ElementConfigRepositoryInterface
{
    public function index();
    public function getById($id);

    public function getByElementId($elementId);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);

    public function deleteByElementId($elementId);
}

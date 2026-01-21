<?php

namespace App\Repositories;
use App\Models\ElementConfig;
use App\Interfaces\ElementConfigRepositoryInterface;

class ElementConfigRepository implements ElementConfigRepositoryInterface
{
    public function index()
    {
        return ElementConfig::all();
    }
    public function getById($id)
    {
        return ElementConfig::findOrFail($id);
    }
    public function getByElementId($elementId)
    {
        return ElementConfig::where('element_id',$elementId)->first();
    }
    public function store(array $data)
    {
        return ElementConfig::create($data);
    }
    public function update(array $data,$id)
    {
        return ElementConfig::where('element_id', $id)->update($data);
    }
    public function delete($id)
    {
        ElementConfig::destroy($id);
    }

    public function deleteByElementId($elementId)
    {
        return ElementConfig::where('element_id',$elementId)->delete();
    }
}

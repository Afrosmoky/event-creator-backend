<?php

namespace App\Repositories;
use App\Interfaces\ElementRepositoryInterface;
use App\Models\Element;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\Array_;

class ElementRepository implements ElementRepositoryInterface
{
    public function index(): Collection
    {
        $elements = Element::join('element_configs', 'element_configs.element_id', '=', 'elements.id')->get();

        return $elements;
    }
    public function getById($id): Element
    {
        $element = Element::join('element_configs', 'element_configs.element_id', '=', 'elements.id')->findOrFail($id);

        return $element;
    }
    public function getByBallroomId($ballroomId, $type = null)
    {

        if($type) {
            $elements = Element::select()->where("ballroom_id",$ballroomId)->where("type", $type)->get();
        } else {
            $elements = Element::select()->where("ballroom_id",$ballroomId)->get();
        }

        return $elements;
    }

    public function store(array $data)
    {
        return Element::create($data);
    }

    public function update(array $data,$id): int
    {
        return Element::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Element::destroy($id);
    }
}

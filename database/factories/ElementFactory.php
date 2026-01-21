<?php

namespace Database\Factories;

use App\Models\Element;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ElementFactory extends Factory
{
    protected $model = Element::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->word(),
            'ballroom_id' => $this->faker->randomNumber(),
            'parent_id' => $this->faker->randomNumber(),
            'x' => $this->faker->randomNumber(),
            'y' => $this->faker->randomNumber(),
            'color' => $this->faker->word(),
            'kind' => $this->faker->word(),
            'spacing' => $this->faker->randomFloat(),
            'status' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

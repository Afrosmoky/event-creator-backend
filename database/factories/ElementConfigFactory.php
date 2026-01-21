<?php

namespace Database\Factories;

use App\Models\ElementConfig;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ElementConfigFactory extends Factory
{
    protected $model = ElementConfig::class;

    public function definition(): array
    {
        return [
            'element_id' => $this->faker->randomNumber(),
            'type' => $this->faker->word(),
            'seats' => $this->faker->word(),
            'radius' => $this->faker->word(),
            'width' => $this->faker->randomFloat(),
            'height' => $this->faker->randomFloat(),
            'size' => $this->faker->randomFloat(),
            'angle' => $this->faker->randomFloat(),
            'angle_origin_x' => $this->faker->randomFloat(),
            'angle_origin_y' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

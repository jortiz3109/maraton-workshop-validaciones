<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => Str::random(10),
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->randomDigitNotZero(),
            'quantity' => $this->faker->randomDigitNotZero(),
            'description' => Str::substr($this->faker->paragraphs(5, true), 0, 50),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Condition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 1, 999999) * 100,
            'name' => $this->faker->words(random_int(3, 5), true),
            'description' => $this->faker->text(random_int(50, 300)),
            'condition_id' => Condition::inRandomOrder(1)->first()->id
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string,mixed>
     */
    public function definition()
    {
        $name = $this->faker->word() . ' ' . $this->faker->word();
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(random_int(5, 150))
        ];
    }
}

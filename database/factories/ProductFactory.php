<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->colorName();
        return [
            'user_id' => 1,
            'category_id' => Category::all()->random()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $this->faker->numberBetween(100,1000),
            'status' => $this->faker->randomElement(['active','inactive']),
            'company_name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'stock_quantity' => $this->faker->randomNumber(1,50),
        ];
    }
}

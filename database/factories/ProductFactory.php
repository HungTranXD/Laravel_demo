<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->colorName,
            "thumbnail" => $this->faker->imageUrl,
            "price" => random_int(100, 1000),
            "quantity" => random_int(1, 50),
            "description" => $this->faker->paragraph,
            "category_id" => random_int(1, 100)
        ];
    }
}

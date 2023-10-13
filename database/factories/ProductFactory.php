<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'image' => '1686122531.png',
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}

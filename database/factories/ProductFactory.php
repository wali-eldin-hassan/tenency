<?php

namespace Database\Factories;

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
        $name = $this->faker->name;

        return [
            'name' => $name,
            'tenant_id' => 1,
            'slug' => Str::slug($name),
            'color' => $this->faker->colorName,
            'image_path' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
            'description' => $this->faker->text,
            'price' => 45,
            'stock' => 150,
            'category_id' => 1,
        ];
    }
}

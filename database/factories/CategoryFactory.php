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
            'title' => $this->faker->title,
            'image_path' => 'https://tailwindui.com/img/ecommerce-images/Category-page-01-related-Category-01.jpg',
        ];
    }
}

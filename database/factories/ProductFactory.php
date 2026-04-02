<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $names = [
            'Premium Leather Wallet',
            'Wireless Bluetooth Headphones',
            'Smart Watch Series 5',
            'Minimalist Desk Lamp',
            'Ergonomic Office Chair',
            'Portable Power Bank 20000mAh',
            'Mechanical Keyboard RGB',
            'Stainless Steel Water Bottle',
            'Canvas Backpack Pro',
            'Noise Cancelling Earbuds',
            'USB-C Hub 7-in-1',
            'Laptop Stand Aluminum',
            'Wireless Mouse Ergonomic',
            'LED Ring Light 10 inch',
            'Microphone Condenser USB',
            'Webcam HD 1080p',
            'Phone Grip & Stand',
            'Cable Management Kit',
            'Monitor Arm Single',
            'Air Purifier Portable',
        ];

        return [
            'category_id' => Category::factory(),
            'name' => fake()->randomElement($names) . ' ' . fake()->numberBetween(1, 99),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2, 50000, 2500000),
            'stock' => fake()->numberBetween(0, 100),
            'image' => null,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => ['is_active' => false]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => ['stock' => 0]);
    }
}

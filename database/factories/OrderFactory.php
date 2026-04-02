<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'invoice_number' => Order::generateInvoiceNumber(),
            'status' => fake()->randomElement(OrderStatus::cases()),
            'total_amount' => fake()->randomFloat(2, 50000, 5000000),
            'shipping_address' => fake()->address(),
            'payment_method' => fake()->randomElement(['bank_transfer', 'cod', 'ewallet']),
            'notes' => fake()->optional()->sentence(),
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
        ];
    }
}

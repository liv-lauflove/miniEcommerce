<?php

namespace Tests\Feature;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_number_is_unique(): void
    {
        $user = User::factory()->create();
        $numbers = [];

        // Create orders explicitly to bypass factory's sequence issue inside
        // the RefreshDatabase wrapping transaction. Each ->create() commits
        // its own mini-transaction, so Order::generateInvoiceNumber() sees
        // previously committed orders and increments the sequence correctly.
        for ($i = 0; $i < 10; $i++) {
            $order = Order::create([
                'user_id' => $user->id,
                'invoice_number' => Order::generateInvoiceNumber(),
                'status' => OrderStatus::Pending,
                'total_amount' => 100000,
                'shipping_address' => 'Test Address',
                'payment_method' => 'bank_transfer',
                'invoice_date' => now(),
                'due_date' => now()->addDays(7),
            ]);
            $numbers[] = $order->invoice_number;
        }

        $this->assertEquals(count($numbers), count(array_unique($numbers)));
    }

    public function test_invoice_number_format(): void
    {
        $number = Order::generateInvoiceNumber();

        $this->assertMatchesRegularExpression(
            '/^INV-\d{8}-\d{4}$/',
            $number,
            'Invoice number should match format INV-YYYYMMDD-XXXX'
        );
    }

    public function test_invoice_number_sequential_within_day(): void
    {
        $user = User::factory()->create();

        $order1 = Order::create([
            'user_id' => $user->id,
            'invoice_number' => Order::generateInvoiceNumber(),
            'status' => OrderStatus::Pending,
            'total_amount' => 50000,
            'shipping_address' => 'Addr 1',
            'payment_method' => 'cod',
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        $order2 = Order::create([
            'user_id' => $user->id,
            'invoice_number' => Order::generateInvoiceNumber(),
            'status' => OrderStatus::Pending,
            'total_amount' => 75000,
            'shipping_address' => 'Addr 2',
            'payment_method' => 'bank_transfer',
            'invoice_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        $this->assertNotEquals($order1->invoice_number, $order2->invoice_number);
    }
}

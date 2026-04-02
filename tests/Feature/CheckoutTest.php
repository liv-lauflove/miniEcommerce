<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    private User $customer;
    private CartService $cartService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customer = User::factory()->create(['is_admin' => false]);
        $this->cartService = new CartService();
        session()->flush();
    }

    public function test_cart_checkout_creates_order(): void
    {
        $product = Product::factory()->create(['price' => 100000, 'stock' => 10]);
        $this->cartService->add($product, 2);

        $response = $this->actingAs($this->customer)->post('/checkout', [
            'shipping_address' => '123 Test Street, Jakarta',
            'payment_method' => 'bank_transfer',
            'notes' => 'Please deliver in the morning.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'user_id' => $this->customer->id,
            'shipping_address' => '123 Test Street, Jakarta',
            'payment_method' => 'bank_transfer',
            'notes' => 'Please deliver in the morning.',
        ]);
        $this->assertEquals(8, $product->fresh()->stock); // stock decremented by 2
        $this->assertTrue($this->cartService->isEmpty()); // cart cleared
    }

    public function test_checkout_requires_authentication(): void
    {
        $response = $this->post('/checkout', [
            'shipping_address' => '123 Test Street',
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_checkout_requires_shipping_address(): void
    {
        $response = $this->actingAs($this->customer)->post('/checkout', [
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHasErrors('shipping_address');
    }

    public function test_checkout_requires_valid_payment_method(): void
    {
        $response = $this->actingAs($this->customer)->post('/checkout', [
            'shipping_address' => '123 Test Street',
            'payment_method' => 'invalid_method',
        ]);

        $response->assertSessionHasErrors('payment_method');
    }

    public function test_order_item_records_correct_price(): void
    {
        $product = Product::factory()->create(['price' => 150000, 'stock' => 10]);
        $this->cartService->add($product, 3);

        $this->actingAs($this->customer)->post('/checkout', [
            'shipping_address' => '456 Test Ave',
            'payment_method' => 'cod',
        ]);

        $order = $this->customer->orders()->first();
        $orderItem = $order->items()->first();

        $this->assertEquals(150000, $orderItem->unit_price);
        $this->assertEquals(3, $orderItem->quantity);
        $this->assertEquals(450000, $orderItem->subtotal);
    }

    public function test_empty_cart_cannot_checkout(): void
    {
        $response = $this->actingAs($this->customer)->post('/checkout', [
            'shipping_address' => '789 Empty St',
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHas('error');
    }
}

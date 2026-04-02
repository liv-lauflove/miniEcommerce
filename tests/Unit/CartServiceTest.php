<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    private CartService $cartService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cartService = new CartService();
        session()->flush();
    }

    public function test_cart_starts_empty(): void
    {
        $this->assertTrue($this->cartService->isEmpty());
        $this->assertEquals(0, $this->cartService->count());
        $this->assertEquals(0.0, $this->cartService->total());
    }

    public function test_can_add_product_to_cart(): void
    {
        $product = Product::factory()->create(['price' => 100000, 'stock' => 10]);

        $this->cartService->add($product, 2);

        $this->assertFalse($this->cartService->isEmpty());
        $this->assertEquals(2, $this->cartService->count());
        $this->assertEquals(200000.0, $this->cartService->total());
    }

    public function test_adding_same_product_increments_quantity(): void
    {
        $product = Product::factory()->create(['price' => 50000, 'stock' => 10]);

        $this->cartService->add($product, 2);
        $this->cartService->add($product, 3);

        $this->assertEquals(5, $this->cartService->count());
        $this->assertEquals(250000.0, $this->cartService->total());
    }

    public function test_can_update_item_quantity(): void
    {
        $product = Product::factory()->create(['price' => 75000, 'stock' => 10]);

        $this->cartService->add($product, 2);
        $this->cartService->update($product->id, 5);

        $this->assertEquals(5, $this->cartService->count());
        $this->assertEquals(375000.0, $this->cartService->total());
    }

    public function test_updating_quantity_to_zero_removes_item(): void
    {
        $product = Product::factory()->create(['price' => 75000, 'stock' => 10]);

        $this->cartService->add($product, 2);
        $this->cartService->update($product->id, 0);

        $this->assertTrue($this->cartService->isEmpty());
    }

    public function test_can_remove_item_from_cart(): void
    {
        $product = Product::factory()->create(['price' => 75000, 'stock' => 10]);

        $this->cartService->add($product, 2);
        $this->cartService->remove($product->id);

        $this->assertTrue($this->cartService->isEmpty());
    }

    public function test_can_clear_cart(): void
    {
        $product1 = Product::factory()->create(['price' => 50000, 'stock' => 10]);
        $product2 = Product::factory()->create(['price' => 30000, 'stock' => 10]);

        $this->cartService->add($product1, 2);
        $this->cartService->add($product2, 1);
        $this->cartService->clear();

        $this->assertTrue($this->cartService->isEmpty());
    }

    public function test_get_items_returns_collection(): void
    {
        $product = Product::factory()->create(['price' => 100000, 'stock' => 10]);

        $this->cartService->add($product, 2);
        $items = $this->cartService->getItems();

        $this->assertEquals(1, $items->count());
        $this->assertEquals(200000.0, $items->first()['subtotal']);
        $this->assertTrue($items->first()['in_stock']);
    }

    public function test_validate_stock_detects_insufficient_stock(): void
    {
        $product = Product::factory()->create(['price' => 100000, 'stock' => 2]);

        $this->cartService->add($product, 5);
        $errors = $this->cartService->validateStock();

        $this->assertArrayHasKey($product->id, $errors);
        $this->assertStringContainsString('Only 2', $errors[$product->id]);
    }
}

<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    private const CART_KEY = 'cart';

    public static function new(): static
    {
        return new static();
    }

    public function getCart(): array
    {
        return session()->get(self::CART_KEY, []);
    }

    public function add(Product $product, int $quantity = 1): array
    {
        $cart = $this->getCart();
        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        $this->save($cart);
        return $cart[$productId];
    }

    public function update(int $productId, int $quantity): bool
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return false;
        }

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['quantity'] = $quantity;
        }

        $this->save($cart);
        return true;
    }

    public function remove(int $productId): bool
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return false;
        }

        unset($cart[$productId]);
        $this->save($cart);
        return true;
    }

    public function clear(): void
    {
        session()->forget(self::CART_KEY);
    }

    public function getItem(int $productId): ?array
    {
        return $this->getCart()[$productId] ?? null;
    }

    public function count(): int
    {
        return collect($this->getCart())->sum('quantity');
    }

    public function total(): float
    {
        return collect($this->getCart())->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function getFormattedTotal(): string
    {
        return 'Rp ' . number_format($this->total(), 0, ',', '.');
    }

    public function isEmpty(): bool
    {
        return empty($this->getCart());
    }

    public function validateStock(): array
    {
        $errors = [];
        foreach ($this->getCart() as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                $errors[$productId] = 'Product no longer available.';
                continue;
            }
            if ($product->stock < $item['quantity']) {
                $errors[$productId] = "Only {$product->stock} items available for '{$product->name}'.";
            }
        }
        return $errors;
    }

    public function getItems(): Collection
    {
        $cart = $this->getCart();
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        return collect($cart)->map(function ($item) use ($products) {
            $product = $products->get($item['product_id']);
            return array_merge($item, [
                'product' => $product,
                'subtotal' => $item['price'] * $item['quantity'],
                'formatted_subtotal' => 'Rp ' . number_format($item['price'] * $item['quantity'], 0, ',', '.'),
                'in_stock' => $product && $product->stock >= $item['quantity'],
            ]);
        })->values();
    }

    private function save(array $cart): void
    {
        session()->put(self::CART_KEY, $cart);
    }
}

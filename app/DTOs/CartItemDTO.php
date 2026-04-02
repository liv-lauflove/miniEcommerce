<?php

namespace App\DTOs;

readonly class CartItemDTO
{
    public function __construct(
        public int $productId,
        public string $name,
        public float $price,
        public int $quantity,
        public ?string $image = null,
    ) {}

    public function subtotal(): float
    {
        return $this->price * $this->quantity;
    }

    public function formattedSubtotal(): string
    {
        return 'Rp ' . number_format($this->subtotal(), 0, ',', '.');
    }

    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->productId,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image' => $this->image,
            'subtotal' => $this->subtotal(),
            'formatted_subtotal' => $this->formattedSubtotal(),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productId: $data['product_id'],
            name: $data['name'],
            price: (float) $data['price'],
            quantity: (int) $data['quantity'],
            image: $data['image'] ?? null,
        );
    }
}

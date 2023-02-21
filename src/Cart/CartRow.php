<?php

namespace App\Cart;

use App\Entity\Product;

class CartRow
{

    private int $quantity;
    private int $productId;

    public function __construct(Product $product, int $quantity)
    {
        $this->productId = $product->getId();
        $this->quantity = $quantity;
    }

    public function add(int $quantity): void
    {
        $this->quantity += $quantity;
    }

    public function remove(int $quantity): void
    {   
        if ($quantity > $this->quantity) {
            throw new \InvalidArgumentException('quantity to remove too high');
        }

        $this->quantity -= $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
<?php

namespace App\Cart;

use App\Cart\CartRow;
use App\Entity\Product;

class Cart
{

    private array $rows = [];

    public function getRows(): array
    {
        return $this->rows;
    }

    public function getRow(Product $product): CartRow
    {
        if (!isset($this->rows[$product->getId()])) {
            throw new \InvalidArgumentException('The product is not in the cart');
        }

        return $this->rows[$product->getId()];
    }

    public function add(Product $product, int $quantity): void 
    {
        if (isset($this->rows[$product->getId()])) {
            $this->rows[$product->getId()]->add($quantity);
        }

        $this->rows[$product->getId()] = new CartRow($product, $quantity);
    }

    public function remove(Product $product, int $quantity): void 
    {
        if (!isset($this->rows[$product->getId()])) {
            throw new \InvalidArgumentException('The product is not in the cart');
        }

        $this->rows[$product->getId()]->remove($quantity);

        if ($this->rows[$product->getId()]->getQuantity() === 0) {
            unset($this->rows[$product->getId()]);
        }
    }

    public function removeRow(Product $product): void
    {
        if (!isset($this->rows[$product->getId()])) {
            throw new \InvalidArgumentException('The product is not in the cart');
        }

        unset($this->rows[$product->getId()]);
    }

    public function countTotalProducts(): int
    {
        $count = 0;

        foreach($this->rows as $row) {
            $count += $row->getQuantity();
        }

        return $count;
    }

    public function __toString(): string
    {
        return 'cart';
    }
}
<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const KEY = 'cart';

    public function items(): array
    {
        return Session::get(self::KEY, []);
    }

    public function add(int $productId, int $qty, Product $product): void
    {
        $cart = $this->items();
        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'title'      => $product->title,
                'sku'        => $product->sku,
                'price'      => (float) $product->price,
                'image'      => $product->images[0] ?? null,
                'qty'        => $qty,
            ];
        }
        Session::put(self::KEY, $cart);
    }

    public function update(int $productId, int $qty): void
    {
        $cart = $this->items();
        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = max(1, $qty);
            Session::put(self::KEY, $cart);
        }
    }

    public function remove(int $productId): void
    {
        $cart = $this->items();
        unset($cart[$productId]);
        Session::put(self::KEY, $cart);
    }

    public function clear(): void
    {
        Session::forget(self::KEY);
    }

    public function total(): float
    {
        return (float) array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $this->items()));
    }

    public function count(): int
    {
        return (int) array_sum(array_column($this->items(), 'qty'));
    }
}

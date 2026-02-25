<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index()
    {
        return view('storefront.cart', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty'        => 'integer|min:1',
        ]);
        $product = Product::findOrFail($request->product_id);
        $this->cart->add($request->product_id, (int) ($request->qty ?? 1), $product);
        return back()->with('success', '"' . $product->title . '" added to cart!');
    }

    public function update(Request $request, int $productId)
    {
        $request->validate(['qty' => 'required|integer|min:1']);
        $this->cart->update($productId, $request->qty);
        return back();
    }

    public function remove(int $productId)
    {
        $this->cart->remove($productId);
        return back()->with('success', 'Item removed from cart.');
    }
}

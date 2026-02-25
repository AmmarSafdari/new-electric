<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function show()
    {
        if ($this->cart->count() === 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
        return view('storefront.checkout', [
            'items'    => $this->cart->items(),
            'total'    => $this->cart->total(),
            'shipping' => 200,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:100',
            'phone'   => ['required', 'regex:/^(\+92|03)\d{9}$/'],
            'city'    => 'required|max:100',
            'address' => 'required|max:300',
            'notes'   => 'nullable|max:500',
        ]);

        $items = $this->cart->items();
        if (empty($items)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = $this->cart->total();
        $shipping = 200;
        $total    = $subtotal + $shipping;

        $orderId = null;
        DB::transaction(function () use ($request, $items, $subtotal, $shipping, $total, &$orderId) {
            $order = Order::create([
                'name'           => $request->name,
                'phone'          => $request->phone,
                'city'           => $request->city,
                'address'        => $request->address,
                'notes'          => $request->notes,
                'subtotal'       => $subtotal,
                'shipping_fee'   => $shipping,
                'total'          => $total,
                'status'         => 'pending',
                'payment_method' => 'cod',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'title'      => $item['title'],
                    'sku'        => $item['sku'],
                    'unit_price' => $item['price'],
                    'qty'        => $item['qty'],
                    'line_total' => $item['price'] * $item['qty'],
                ]);
                Product::where('id', $item['product_id'])->decrement('stock_qty', $item['qty']);
            }

            $orderId = $order->id;
        });

        $this->cart->clear();
        session(['last_order_id' => $orderId]);
        return redirect()->route('order.success');
    }
}

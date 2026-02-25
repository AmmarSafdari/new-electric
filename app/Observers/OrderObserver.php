<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event — restore stock when cancelled.
     */
    public function updated(Order $order): void
    {
        if ($order->isDirty('status') && $order->status === 'cancelled') {
            foreach ($order->items as $item) {
                \App\Models\Product::where('id', $item->product_id)
                    ->increment('stock_qty', $item->qty);
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}

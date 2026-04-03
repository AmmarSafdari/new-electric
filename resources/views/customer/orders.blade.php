@extends('customer.layout')
@section('title', 'My Orders')
@section('content')

<div class="mb-8">
    <p class="text-amber-400 font-bold text-sm uppercase tracking-widest mb-1">Account</p>
    <h1 class="text-3xl font-black text-white">My Orders</h1>
    <p class="text-gray-400 mt-1 text-sm">{{ $orders->total() }} order{{ $orders->total() !== 1 ? 's' : '' }} placed</p>
</div>

@if($orders->isEmpty())
<div class="bg-gray-900 border border-gray-800 rounded-2xl flex flex-col items-center justify-center py-20 text-center px-6">
    <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center mb-4">
        <svg class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
    </div>
    <p class="text-gray-400 font-semibold">No orders found</p>
    <a href="{{ route('home') }}" class="mt-4 px-5 py-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black text-sm rounded-xl transition-colors">Start Shopping ⚡</a>
</div>
@else

<div class="space-y-4">
    @foreach($orders as $order)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden hover:border-gray-700 transition-colors">
        {{-- Order header --}}
        <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-4 border-b border-gray-800">
            <div class="flex items-center gap-4">
                <div>
                    <div class="font-black text-white text-sm">Order #{{ $order->id }}</div>
                    <div class="text-gray-500 text-xs">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="font-black text-amber-400">PKR {{ number_format($order->total) }}</span>
                @php
                $colors = ['pending'=>'bg-yellow-500/10 text-yellow-400','processing'=>'bg-blue-500/10 text-blue-400','shipped'=>'bg-indigo-500/10 text-indigo-400','delivered'=>'bg-green-500/10 text-green-400','cancelled'=>'bg-red-500/10 text-red-400'];
                $color = $colors[$order->status] ?? 'bg-gray-500/10 text-gray-400';
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $color }}">{{ ucfirst($order->status) }}</span>
            </div>
        </div>

        {{-- Order items --}}
        <div class="px-6 py-4 space-y-2">
            @foreach($order->items as $item)
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center gap-2 text-gray-300">
                    <span class="w-5 h-5 bg-gray-800 rounded-md flex items-center justify-center text-xs font-bold text-gray-400">{{ $item->qty }}</span>
                    <span>{{ $item->title }}</span>
                    <span class="text-gray-600 text-xs">{{ $item->sku }}</span>
                </div>
                <span class="font-semibold text-gray-300">PKR {{ number_format($item->line_total) }}</span>
            </div>
            @endforeach
        </div>

        {{-- Order footer --}}
        <div class="flex flex-wrap items-center justify-between gap-3 px-6 py-3 bg-gray-800/30 border-t border-gray-800 text-xs text-gray-500">
            <div class="flex items-center gap-4">
                <span>📦 {{ $order->city }}</span>
                <span>💳 {{ ucfirst($order->payment_method) }}</span>
                @if($order->shipping_fee)
                <span>🚚 PKR {{ number_format($order->shipping_fee) }} shipping</span>
                @endif
            </div>
            <div class="text-gray-600">
                Subtotal: PKR {{ number_format($order->subtotal) }}
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $orders->links() }}
</div>
@endif

@endsection

@extends('layouts.app')
@section('title', 'Cart')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-4xl font-black text-gray-900">Your Cart</h1>
        @if(!empty($items))
        <p class="text-gray-500 mt-1">{{ array_sum(array_column($items, 'qty')) }} items</p>
        @endif
    </div>

    @if(empty($items))
        <div class="text-center py-24">
            <div class="w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-400 mb-8">Looks like you haven't added anything yet.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-amber-400 hover:text-gray-900 text-white font-bold px-8 py-3.5 rounded-2xl transition-all duration-200">
                Start Shopping
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Cart items --}}
            <div class="flex-1 space-y-3">
                @foreach($items as $id => $item)
                <div class="bg-white border border-gray-100 rounded-2xl p-4 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                    {{-- Product image --}}
                    <div class="w-20 h-20 rounded-xl bg-gray-50 flex items-center justify-center overflow-hidden shrink-0 border border-gray-100">
                        @if($item['image'])
                            <img src="{{ Storage::url($item['image']) }}" class="w-full h-full object-cover" loading="lazy">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-800 text-sm line-clamp-1">{{ $item['title'] }}</p>
                        <p class="text-xs text-gray-400 font-mono mt-0.5">{{ $item['sku'] }}</p>
                        <p class="font-black text-gray-900 mt-2 text-base">PKR {{ number_format($item['price'] * $item['qty']) }}</p>
                    </div>

                    {{-- Qty controls --}}
                    <form method="POST" action="{{ route('cart.update', $id) }}" x-data="{ qty: {{ $item['qty'] }} }">
                        @csrf @method('PATCH')
                        <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                            <button type="button" @click="if(qty > 1){ qty--; $el.closest('form').submit(); }"
                                class="px-3 py-2 text-gray-500 hover:bg-gray-50 transition-colors font-bold">−</button>
                            <input type="number" name="qty" x-model="qty" min="1" readonly
                                   class="w-10 text-center text-sm font-bold border-0 focus:ring-0 py-2">
                            <button type="button" @click="qty++; $el.closest('form').submit()"
                                class="px-3 py-2 text-gray-500 hover:bg-gray-50 transition-colors font-bold">+</button>
                        </div>
                    </form>

                    {{-- Remove --}}
                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-gray-300 hover:text-red-400 transition-colors rounded-lg hover:bg-red-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            {{-- Order summary --}}
            <div class="w-full lg:w-80 shrink-0">
                <div class="bg-gray-950 rounded-2xl p-6 sticky top-24 text-white">
                    <h2 class="font-black text-lg mb-5">Order Summary</h2>
                    <div class="space-y-3 mb-5">
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Subtotal</span>
                            <span class="font-semibold text-white">PKR {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Shipping</span>
                            <span class="font-semibold text-white">PKR 200</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 pt-4 mb-6">
                        <div class="flex justify-between font-black text-lg">
                            <span>Total</span>
                            <span class="text-amber-400">PKR {{ number_format($total + 200) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}"
                       class="block text-center bg-amber-400 hover:bg-amber-300 text-gray-900 font-black py-4 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-amber-400/25">
                        Proceed to Checkout →
                    </a>
                    <div class="mt-4 flex items-center gap-2 text-gray-600 text-xs justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Cash on Delivery · No online payment needed
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')
@section('title', 'Order Confirmed!')
@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    {{-- Success animation --}}
    <div class="w-24 h-24 bg-green-100 rounded-3xl flex items-center justify-center mx-auto mb-6" x-data x-init="$el.classList.add('animate-fadeup')">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    </div>

    <div class="animate-fadeup">
        <div class="inline-flex items-center gap-2 bg-green-50 text-green-700 text-xs font-bold px-4 py-2 rounded-full border border-green-100 mb-4 uppercase tracking-widest">
            <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
            Order Confirmed
        </div>
        <h1 class="text-4xl font-black text-gray-900 mb-2">Thank you!</h1>
        <p class="text-gray-500 text-lg mb-1">Order <strong class="text-gray-800 font-black">#{{ $order->id }}</strong> has been placed.</p>
        <p class="text-gray-400 text-sm mb-8">We'll call you to confirm. Estimated delivery: <strong class="text-gray-600">2–5 business days</strong>.</p>
    </div>

    {{-- Order details card --}}
    <div class="bg-gray-950 rounded-2xl overflow-hidden text-left mb-8">
        <div class="px-6 py-4 border-b border-gray-800">
            <div class="flex items-center justify-between text-white">
                <span class="font-black text-base">Order Summary</span>
                <span class="text-gray-400 text-sm font-mono">#{{ $order->id }}</span>
            </div>
        </div>
        <div class="px-6 py-4 space-y-3">
            @foreach($order->items as $item)
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">{{ $item->title }} <span class="text-gray-600">× {{ $item->qty }}</span></span>
                <span class="text-white font-semibold">PKR {{ number_format($item->line_total) }}</span>
            </div>
            @endforeach
        </div>
        <div class="px-6 py-4 border-t border-gray-800 space-y-2">
            <div class="flex justify-between text-sm text-gray-500">
                <span>Shipping</span><span>PKR {{ number_format($order->shipping_fee) }}</span>
            </div>
            <div class="flex justify-between font-black text-lg text-white">
                <span>Total</span>
                <span class="text-amber-400">PKR {{ number_format($order->total) }}</span>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-900 border-t border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-green-900/50 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <div class="text-white text-sm font-bold">Pay on Delivery</div>
                    <div class="text-gray-500 text-xs">Pay cash when your order arrives</div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('home') }}"
       class="inline-flex items-center gap-2 bg-gray-900 hover:bg-amber-400 hover:text-gray-900 text-white font-black px-8 py-4 rounded-2xl transition-all duration-200 hover:-translate-y-0.5 shadow-lg">
        Continue Shopping
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
</div>
@endsection

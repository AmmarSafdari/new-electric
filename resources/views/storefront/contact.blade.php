@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Get in Touch</p>
        <h1 class="text-5xl font-black text-gray-900">Contact Us</h1>
    </div>
    <div class="grid md:grid-cols-2 gap-6 mb-10">
        <div class="bg-gray-50 rounded-2xl p-6 flex items-start gap-4">
            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 mb-1">Phone Orders</h3>
                <p class="text-gray-500 text-sm">Call us to place an order or ask any questions about our products.</p>
            </div>
        </div>
        <div class="bg-gray-50 rounded-2xl p-6 flex items-start gap-4">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 mb-1">Cash on Delivery</h3>
                <p class="text-gray-500 text-sm">All orders support COD. Pay when your order arrives at your door.</p>
            </div>
        </div>
    </div>
    <div class="bg-gray-950 rounded-2xl p-8 text-white text-center">
        <h2 class="font-black text-xl mb-2">Ready to Order?</h2>
        <p class="text-gray-400 text-sm mb-6">Browse our products and place your order online. We'll confirm via call.</p>
        <a href="{{ route('home') }}" class="inline-block bg-amber-400 hover:bg-amber-300 text-gray-900 font-black px-6 py-3 rounded-xl transition-all">Browse Products</a>
    </div>
</div>
@endsection

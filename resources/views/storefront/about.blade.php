@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-14">
        <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Our Story</p>
        <h1 class="text-5xl font-black text-gray-900 mb-4">About New Electric</h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto">Pakistan's trusted electrical general store, bringing quality products to homes and businesses nationwide.</p>
    </div>
    <div class="grid md:grid-cols-2 gap-8 mb-14">
        <div class="bg-gray-50 rounded-2xl p-8">
            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </div>
            <h2 class="text-xl font-black text-gray-900 mb-3">What We Sell</h2>
            <p class="text-gray-600 leading-relaxed">Batteries, standing fans, plugs, extension boards, adapters, LED bulbs, emergency lights, electrical wires and general electrical essentials — everything you need for home and office.</p>
        </div>
        <div class="bg-gray-50 rounded-2xl p-8">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h2 class="text-xl font-black text-gray-900 mb-3">Our Brands</h2>
            <p class="text-gray-600 leading-relaxed">We source from reputable brands including Philips, Panasonic, Sogo, SuperAsia, and quality local manufacturers to give you reliable products at fair prices.</p>
        </div>
    </div>
    <div class="bg-gray-950 rounded-2xl p-10 text-center text-white">
        <h2 class="text-2xl font-black mb-3">Ready to Shop?</h2>
        <p class="text-gray-400 mb-6">Browse our categories and order with confidence — Cash on Delivery available across Pakistan.</p>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black px-8 py-3.5 rounded-xl transition-all">
            Shop Now
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</div>
@endsection

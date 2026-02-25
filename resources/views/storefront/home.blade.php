@extends('layouts.app')
@section('title', 'Home')
@section('content')

{{-- HERO: Room Power-Up Animation --}}
<section id="room-animation-hero" class="relative bg-gray-950 overflow-hidden" style="min-height: 92vh;">
    {{-- Animated background gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950"></div>
    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 30% 40%, rgba(251,191,36,0.15) 0%, transparent 50%), radial-gradient(circle at 70% 80%, rgba(251,191,36,0.08) 0%, transparent 50%);"></div>

    {{-- Skip link --}}
    <a href="#products-section"
       class="absolute top-6 right-6 z-20 text-xs text-gray-400 hover:text-amber-400 border border-gray-700 hover:border-amber-500 rounded-lg px-4 py-2 transition-all duration-200 backdrop-blur-sm bg-gray-900/50">
        Skip ↓
    </a>

    {{-- Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center" style="min-height: 92vh;">
        <div class="grid lg:grid-cols-2 gap-12 items-center w-full py-20">
            {{-- Text side --}}
            <div class="animate-fadeup">
                <div class="inline-flex items-center gap-2 bg-amber-400/10 border border-amber-400/20 text-amber-400 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                    <div class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></div>
                    Pakistan's Electrical Store
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[0.95] tracking-tight mb-6">
                    Power Up<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-300">Your World</span>
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed mb-8 max-w-md">
                    Quality electrical products delivered to your door. Batteries, fans, bulbs, wires & more — Cash on delivery across Pakistan.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#products-section"
                       class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black px-8 py-4 rounded-2xl text-base shadow-lg shadow-amber-400/25 hover:shadow-amber-400/40 hover:-translate-y-0.5 transition-all duration-200">
                        Shop Now
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('category', 'standing-fans') }}"
                       class="inline-flex items-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold px-8 py-4 rounded-2xl text-base transition-all duration-200">
                        Browse Fans
                    </a>
                </div>
                {{-- Trust badges --}}
                <div class="flex flex-wrap gap-6 mt-10 pt-8 border-t border-gray-800">
                    <div class="flex items-center gap-2 text-gray-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Cash on Delivery
                    </div>
                    <div class="flex items-center gap-2 text-gray-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        PKR 200 Flat Shipping
                    </div>
                    <div class="flex items-center gap-2 text-gray-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Genuine Products
                    </div>
                </div>
            </div>

            {{-- SVG Room Scene --}}
            <div class="hidden lg:block relative" id="room-animation-hero-svg">
                <div class="relative">
                    <div class="absolute inset-0 bg-amber-400/5 rounded-3xl blur-3xl"></div>
                    <div class="relative bg-gray-900/60 border border-gray-800 rounded-3xl p-8 backdrop-blur-sm">
                        @include('partials.room-svg')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-600 animate-bounce">
        <span class="text-xs tracking-widest uppercase">Scroll</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- CATEGORIES --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-12">
        <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Shop by Category</p>
        <h2 class="text-4xl font-black text-gray-900">Everything Electrical</h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
        @foreach($categories as $category)
        <a href="{{ route('category', $category->slug) }}"
           class="group relative bg-white border border-gray-100 hover:border-amber-300 rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-amber-50 group-hover:bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <div class="font-bold text-gray-800 group-hover:text-amber-700 transition-colors text-sm">{{ $category->name }}</div>
                <div class="text-xs text-gray-400 mt-1">{{ $category->products_count }} products</div>
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- FEATURED PRODUCTS --}}
<section id="products-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
    <div class="flex items-end justify-between mb-10">
        <div>
            <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-1">Hand-picked for you</p>
            <h2 class="text-4xl font-black text-gray-900">Featured Products</h2>
        </div>
        <a href="{{ route('search') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-amber-600 transition-colors">
            View all
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        @foreach($featured as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

{{-- WHY US BANNER --}}
<section class="bg-gray-950 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="w-12 h-12 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">Cash on Delivery</h3>
                <p class="text-gray-500 text-sm">Pay when your order arrives. No upfront payment needed.</p>
            </div>
            <div>
                <div class="w-12 h-12 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">PKR 200 Flat Shipping</h3>
                <p class="text-gray-500 text-sm">One simple rate across all of Pakistan. No surprises.</p>
            </div>
            <div>
                <div class="w-12 h-12 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">Genuine Products</h3>
                <p class="text-gray-500 text-sm">Sourced from trusted brands: Philips, Panasonic, Sogo & more.</p>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script defer src="{{ Vite::asset('resources/js/animation.js') }}"></script>
@endpush

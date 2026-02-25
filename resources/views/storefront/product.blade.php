@extends('layouts.app')
@section('title', $product->title)
@push('meta')
<meta name="description" content="{{ Str::limit(strip_tags($product->description ?? ''), 160) }}">
<meta property="og:title" content="{{ $product->title }} — New Electric">
<meta property="og:description" content="{{ Str::limit(strip_tags($product->description ?? ''), 160) }}">
@if($product->images && count($product->images) > 0)
<meta property="og:image" content="{{ Storage::url($product->images[0]) }}">
@endif
@endpush
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-amber-500 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('category', $product->category->slug) }}" class="hover:text-amber-500 transition-colors">{{ $product->category->name }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700 font-medium">{{ Str::limit($product->title, 50) }}</span>
    </nav>

    <div class="grid md:grid-cols-2 gap-12 mb-16">
        {{-- Image Gallery --}}
        <div x-data="{ active: 0 }">
            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 mb-3 relative">
                @if($product->images && count($product->images) > 0)
                    @foreach($product->images as $i => $img)
                        <img src="{{ Storage::url($img) }}" alt="{{ $product->title }}"
                             class="w-full h-full object-cover transition-all duration-300"
                             :class="{ 'hidden opacity-0': active !== {{ $i }} }"
                             {{ $i > 0 ? 'style=display:none' : '' }}>
                    @endforeach
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-200 gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        <span class="text-sm text-gray-300">No image available</span>
                    </div>
                @endif
                @if($product->is_featured)
                <div class="absolute top-4 left-4 bg-amber-400 text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow">⭐ Featured</div>
                @endif
            </div>
            @if($product->images && count($product->images) > 1)
            <div class="flex gap-2 overflow-x-auto pb-1">
                @foreach($product->images as $i => $img)
                    <button @click="active = {{ $i }}"
                            class="w-16 h-16 rounded-xl overflow-hidden border-2 shrink-0 transition-all"
                            :class="active === {{ $i }} ? 'border-amber-400 shadow-md shadow-amber-200' : 'border-gray-100 hover:border-gray-300'">
                        <img src="{{ Storage::url($img) }}" class="w-full h-full object-cover" loading="lazy">
                    </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="flex flex-col">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">{{ $product->category->name }}</span>
                @if($product->brand)
                <span class="text-gray-300">·</span>
                <span class="text-xs text-gray-400">{{ $product->brand->name }}</span>
                @endif
            </div>
            <h1 class="text-3xl font-black text-gray-900 leading-tight mb-3">{{ $product->title }}</h1>
            <div class="text-xs text-gray-400 mb-5 font-mono bg-gray-50 inline-block px-3 py-1 rounded-lg">SKU: {{ $product->sku }}</div>

            <div class="text-4xl font-black text-gray-900 mb-5">
                PKR {{ number_format($product->price) }}
            </div>

            <div class="flex items-center gap-3 mb-6">
                @if($product->stock_qty > 0)
                    <span class="inline-flex items-center gap-1.5 text-sm text-green-700 bg-green-50 border border-green-100 px-3 py-1.5 rounded-full font-semibold">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                        In Stock ({{ $product->stock_qty }} available)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 text-sm text-red-600 bg-red-50 border border-red-100 px-3 py-1.5 rounded-full font-semibold">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div>
                        Out of Stock
                    </span>
                @endif
                @if($product->warranty)
                <span class="inline-flex items-center gap-1.5 text-sm text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1.5 rounded-full font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    {{ $product->warranty }}
                </span>
                @endif
            </div>

            @if($product->stock_qty > 0)
            <form action="{{ route('cart.add') }}" method="POST" x-data="{ qty: 1 }">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                        <button type="button" @click="qty = Math.max(1, qty - 1)"
                            class="px-4 py-3 text-gray-500 hover:bg-gray-50 transition-colors font-bold text-lg">−</button>
                        <input type="number" name="qty" x-model="qty" min="1" max="{{ $product->stock_qty }}"
                               class="w-14 text-center text-sm font-bold border-0 focus:ring-0 py-3">
                        <button type="button" @click="qty = Math.min({{ $product->stock_qty }}, qty + 1)"
                            class="px-4 py-3 text-gray-500 hover:bg-gray-50 transition-colors font-bold text-lg">+</button>
                    </div>
                    <button type="submit"
                        class="flex-1 bg-gray-900 hover:bg-amber-400 hover:text-gray-900 text-white font-black py-3.5 px-6 rounded-xl transition-all duration-200 text-sm shadow-sm hover:shadow-amber-300/30">
                        Add to Cart
                    </button>
                </div>
            </form>
            @endif

            {{-- COD badge --}}
            <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-100 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <div>
                    <div class="font-bold text-green-800 text-sm">Pay on Delivery</div>
                    <div class="text-green-600 text-xs">PKR 200 shipping · 2–5 days delivery</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div x-data="{ tab: 'description' }" class="mb-16">
        <div class="flex gap-0 border-b border-gray-200 mb-8">
            <button @click="tab = 'description'"
                class="px-6 py-3 text-sm font-bold border-b-2 transition-all -mb-px"
                :class="tab === 'description' ? 'border-amber-400 text-amber-600' : 'border-transparent text-gray-400 hover:text-gray-600'">
                Description
            </button>
            @if($product->specs)
            <button @click="tab = 'specs'"
                class="px-6 py-3 text-sm font-bold border-b-2 transition-all -mb-px"
                :class="tab === 'specs' ? 'border-amber-400 text-amber-600' : 'border-transparent text-gray-400 hover:text-gray-600'">
                Specifications
            </button>
            @endif
        </div>
        <div x-show="tab === 'description'" class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
            @if($product->description)
                {!! $product->description !!}
            @else
                <p class="text-gray-400">No description available.</p>
            @endif
        </div>
        @if($product->specs)
        <div x-show="tab === 'specs'" x-cloak>
            <div class="bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                @foreach($product->specs as $key => $val)
                <div class="flex items-center py-3.5 px-5 border-b border-gray-100 last:border-0">
                    <span class="w-40 text-sm font-semibold text-gray-700 shrink-0">{{ $key }}</span>
                    <span class="text-sm text-gray-600">{{ $val }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Related --}}
    @if($related->isNotEmpty())
    <div>
        <h2 class="text-2xl font-black text-gray-900 mb-6">You May Also Like</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($related as $r)
                @include('partials.product-card', ['product' => $r])
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

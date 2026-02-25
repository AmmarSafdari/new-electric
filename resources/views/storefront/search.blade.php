@extends('layouts.app')
@section('title', $q ? 'Search: ' . $q : 'All Products')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-1">Results</p>
        <h1 class="text-4xl font-black text-gray-900">
            @if($q) &ldquo;{{ $q }}&rdquo; @else All Products @endif
        </h1>
        <p class="text-gray-400 mt-1">{{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }} found</p>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-24">
            <div class="w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">No products found</h2>
            <p class="text-gray-400 mb-8">Try a different search term or browse our categories.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-gray-900 font-bold px-6 py-3 rounded-2xl transition-colors">
                Back to Home
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="mt-10">{{ $products->links() }}</div>
    @endif
</div>
@endsection

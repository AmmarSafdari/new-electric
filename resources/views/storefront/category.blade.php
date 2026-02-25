@extends('layouts.app')
@section('title', $category->name)
@section('meta_description', $category->description ?? 'Shop ' . $category->name . ' at New Electric Pakistan.')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-amber-500 transition-colors">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700 font-semibold">{{ $category->name }}</span>
    </nav>

    <div class="flex flex-col md:flex-row gap-8">
        {{-- Sidebar filter --}}
        <aside class="w-full md:w-56 shrink-0" x-data="{ open: false }">
            <button @click="open = !open"
                class="md:hidden w-full bg-gray-900 text-white rounded-xl px-4 py-3 text-sm font-semibold flex items-center justify-between mb-4">
                <span>Filters</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="md:block" :class="{ 'hidden': !open, 'block': open }">
                <div class="bg-white border border-gray-100 rounded-2xl p-5 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm">Filter by Brand</h3>
                    <form method="GET" action="{{ route('category', $category->slug) }}" id="filter-form">
                        @foreach($brands as $brand)
                        <label class="flex items-center gap-3 text-sm text-gray-600 mb-3 cursor-pointer hover:text-gray-900 group">
                            <div class="w-4 h-4 rounded border border-gray-300 group-hover:border-amber-400 flex items-center justify-center flex-shrink-0 transition-colors {{ in_array($brand->id, (array) request('brand')) ? 'bg-amber-400 border-amber-400' : '' }}">
                                @if(in_array($brand->id, (array) request('brand')))
                                <svg class="h-3 w-3 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @endif
                            </div>
                            <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                {{ in_array($brand->id, (array) request('brand')) ? 'checked' : '' }}
                                onchange="document.getElementById('filter-form').submit()"
                                class="sr-only">
                            {{ $brand->name }}
                        </label>
                        @endforeach
                        @if(request('brand'))
                        <a href="{{ route('category', $category->slug) }}" class="block text-xs text-amber-600 hover:underline mt-2">Clear filters</a>
                        @endif
                    </form>
                </div>
            </div>
        </aside>

        {{-- Products --}}
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-black text-gray-900">{{ $category->name }}</h1>
                    @if($category->description)
                    <p class="text-gray-500 text-sm mt-1">{{ $category->description }}</p>
                    @endif
                </div>
                <span class="text-sm text-gray-400 bg-gray-50 px-3 py-1.5 rounded-lg font-medium">{{ $products->total() }} products</span>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-20 text-gray-400">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <p class="font-semibold">No products found</p>
                    <p class="text-sm mt-1">Try clearing your filters</p>
                </div>
            @else
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-10">{{ $products->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

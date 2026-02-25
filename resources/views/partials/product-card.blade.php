<a href="{{ route('product', $product->slug) }}"
   class="product-card group bg-white border border-gray-100 hover:border-amber-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
    <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden relative">
        @if($product->images && count($product->images) > 0)
            <img src="{{ Storage::url($product->images[0]) }}"
                 alt="{{ $product->title }}"
                 class="product-img w-full h-full object-cover"
                 loading="lazy">
        @else
            <div class="flex flex-col items-center gap-2 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </div>
        @endif
        @if($product->is_featured)
        <div class="absolute top-2 left-2 bg-amber-400 text-gray-900 text-xs font-bold px-2 py-0.5 rounded-full">Featured</div>
        @endif
        @if($product->stock_qty === 0)
        <div class="absolute inset-0 bg-white/60 flex items-center justify-center">
            <span class="bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">Out of Stock</span>
        </div>
        @endif
    </div>
    <div class="p-4 flex flex-col flex-1">
        <div class="text-xs text-amber-600 font-semibold mb-1 uppercase tracking-wide">{{ $product->category->name ?? '' }}</div>
        <h3 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-amber-700 transition-colors line-clamp-2 flex-1 mb-3">{{ $product->title }}</h3>
        <div class="flex items-center justify-between mt-auto">
            <span class="font-black text-gray-900 text-base">PKR {{ number_format($product->price) }}</span>
            @if($product->stock_qty > 0)
            <span class="text-xs text-green-700 bg-green-50 border border-green-100 px-2 py-0.5 rounded-full font-medium">In Stock</span>
            @endif
        </div>
        @if($product->stock_qty > 0)
        <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="qty" value="1">
            <button type="submit" onclick="event.stopPropagation(); event.preventDefault(); this.closest('form').submit();"
                class="w-full bg-gray-900 hover:bg-amber-400 hover:text-gray-900 text-white text-xs font-bold py-2 rounded-xl transition-all duration-200 group-hover:bg-amber-400 group-hover:text-gray-900">
                Add to Cart
            </button>
        </form>
        @endif
    </div>
</a>

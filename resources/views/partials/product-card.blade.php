<div class="product-card group bg-white border border-gray-100 hover:border-amber-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">

    {{-- Image — links to product page --}}
    <a href="{{ route('product', $product->slug) }}" class="block aspect-square bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden relative shrink-0">
        @if($product->images && count($product->images) > 0)
            <img src="{{ Storage::url($product->images[0]) }}"
                 alt="{{ $product->title }}"
                 class="product-img w-full h-full object-cover"
                 loading="lazy">
        @else
            <div class="flex flex-col items-center gap-2 text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </div>
        @endif

        {{-- Badges --}}
        <div class="absolute top-2.5 left-2.5 flex flex-col gap-1.5">
            @if($product->isOnActiveSale())
            <div class="bg-red-500 text-white text-xs font-black px-2.5 py-0.5 rounded-full shadow-sm shadow-red-500/30 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/></svg>
                -{{ $product->discount_percent }}%
            </div>
            @endif
            @if($product->is_featured && !$product->isOnActiveSale())
            <div class="bg-amber-400 text-gray-900 text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">Featured</div>
            @endif
        </div>

        @if($product->stock_qty === 0)
        <div class="absolute inset-0 bg-white/70 backdrop-blur-[1px] flex items-center justify-center">
            <span class="bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full border border-red-200">Out of Stock</span>
        </div>
        @endif
    </a>

    {{-- Info — also links to product page --}}
    <a href="{{ route('product', $product->slug) }}" class="p-4 flex flex-col flex-1">
        <div class="text-xs text-amber-600 font-semibold mb-1 uppercase tracking-wide">{{ $product->category->name ?? '' }}</div>
        <h3 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-amber-700 transition-colors line-clamp-2 flex-1 mb-3">{{ $product->title }}</h3>

        {{-- Pricing --}}
        <div class="flex items-center gap-2 flex-wrap">
            @if($product->isOnActiveSale())
                <span class="font-black text-red-600 text-base">PKR {{ number_format($product->sale_price) }}</span>
                <span class="font-medium text-gray-400 text-sm line-through">PKR {{ number_format($product->price) }}</span>
            @else
                <span class="font-black text-gray-900 text-base">PKR {{ number_format($product->price) }}</span>
                @if($product->stock_qty > 0)
                <span class="ml-auto text-xs text-green-700 bg-green-50 border border-green-100 px-2 py-0.5 rounded-full font-medium">In Stock</span>
                @endif
            @endif
        </div>

        @if($product->isOnActiveSale() && $product->stock_qty > 0)
        <div class="text-xs text-green-700 bg-green-50 border border-green-100 px-2 py-0.5 rounded-full font-medium w-fit mt-1">In Stock</div>
        @endif
    </a>

    {{-- Add to Cart form — OUTSIDE the <a> tag so the form submits properly --}}
    @if($product->stock_qty > 0)
    <div class="px-4 pb-4">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="qty" value="1">
            <button type="submit"
                class="w-full font-bold py-2.5 rounded-xl transition-all duration-200 text-xs
                    {{ $product->isOnActiveSale()
                        ? 'bg-red-500 hover:bg-red-600 text-white shadow-sm shadow-red-500/25'
                        : 'bg-gray-900 hover:bg-amber-400 hover:text-gray-900 text-white' }}">
                @if($product->isOnActiveSale())
                    🔥 Add to Cart — Save {{ $product->discount_percent }}%
                @else
                    Add to Cart
                @endif
            </button>
        </form>
    </div>
    @endif

</div>

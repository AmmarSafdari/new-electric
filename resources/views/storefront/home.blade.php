@extends('layouts.app')
@section('title', 'Home')
@section('content')

{{-- =====================================================================
     HERO — Room Power-Up Animation
     ===================================================================== --}}
<section id="room-animation-hero" class="relative bg-gray-950 overflow-hidden" style="min-height: 92vh;">
    {{-- Base gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950"></div>
    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 30% 40%, rgba(251,191,36,0.15) 0%, transparent 50%), radial-gradient(circle at 70% 80%, rgba(251,191,36,0.08) 0%, transparent 50%);"></div>

    {{-- Background product drawings (bolts + circuit traces) --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:0.08;">
        {{-- Large bolt top-right --}}
        <svg class="absolute -top-4 right-[8%] w-32 h-32 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        {{-- Medium bolt bottom-left --}}
        <svg class="absolute bottom-16 left-[6%] w-20 h-20 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        {{-- Small bolt mid-right --}}
        <svg class="absolute top-[40%] right-[3%] w-12 h-12 text-amber-300" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        {{-- Circuit traces --}}
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 800" preserveAspectRatio="xMidYMid slice">
            <g stroke="#fbbf24" stroke-width="1.5" fill="none" opacity="0.6">
                <path d="M0 200 L120 200 L120 350 L300 350"/>
                <path d="M1440 150 L1300 150 L1300 280 L1100 280"/>
                <path d="M200 0 L200 80 L400 80"/>
                <path d="M1200 800 L1200 700 L1050 700"/>
                <circle cx="120" cy="200" r="5" fill="#fbbf24"/>
                <circle cx="300" cy="350" r="5" fill="#fbbf24"/>
                <circle cx="1300" cy="150" r="5" fill="#fbbf24"/>
                <circle cx="1100" cy="280" r="5" fill="#fbbf24"/>
            </g>
        </svg>
    </div>

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

            {{-- SVG Room Scene (now bold + glowing) --}}
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

{{-- =====================================================================
     FLASH SALE
     ===================================================================== --}}
@if($flashSale->isNotEmpty())
<section id="flash-sale" class="relative overflow-hidden" style="background: linear-gradient(135deg, #0a0a0a 0%, #1a0505 40%, #0f0f0f 100%);">
    {{-- Glow overlay --}}
    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 80% 50% at 50% -10%, rgba(239,68,68,0.25) 0%, transparent 70%);"></div>
    {{-- Stripe texture --}}
    <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #fff 0px, #fff 1px, transparent 1px, transparent 20px);"></div>
    {{-- Background product outlines (flash = fan + extension + bulb silhouettes) --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:0.06;">
        {{-- Giant fan circle left --}}
        <svg class="absolute -left-16 top-1/2 -translate-y-1/2 w-72 h-72 text-red-400" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="50" cy="50" r="46"/>
            <ellipse cx="50" cy="22" rx="8" ry="26" transform="rotate(0 50 50)"/>
            <ellipse cx="50" cy="22" rx="8" ry="26" transform="rotate(120 50 50)"/>
            <ellipse cx="50" cy="22" rx="8" ry="26" transform="rotate(240 50 50)"/>
            <circle cx="50" cy="50" r="6"/>
        </svg>
        {{-- Giant bolt centre-right --}}
        <svg class="absolute right-[10%] bottom-0 w-48 h-48 text-orange-400" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        {{-- Extension cord top-right --}}
        <svg class="absolute top-4 right-[25%] w-36 h-36 text-red-300" viewBox="0 0 100 40" fill="none" stroke="currentColor" stroke-width="3">
            <rect x="2" y="10" width="80" height="20" rx="10"/>
            <circle cx="22" cy="20" r="6"/>
            <circle cx="42" cy="20" r="6"/>
            <circle cx="62" cy="20" r="6"/>
            <path d="M82 20 Q95 20 95 30" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        {{-- Section header + countdown --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-10"
             x-data="{
                 t: '00:00:00',
                 init() {
                     const end = new Date('{{ $flashSaleEnd->toIso8601String() }}');
                     const tick = () => {
                         const d = end - new Date();
                         if (d <= 0) { this.t = 'ENDED'; return; }
                         const h = String(Math.floor(d / 3600000)).padStart(2, '0');
                         const m = String(Math.floor(d % 3600000 / 60000)).padStart(2, '0');
                         const s = String(Math.floor(d % 60000 / 1000)).padStart(2, '0');
                         this.t = h + ':' + m + ':' + s;
                     };
                     tick(); setInterval(tick, 1000);
                 }
             }">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="text-xl sm:text-2xl">🔥</span>
                    <span class="text-red-400 font-bold text-xs uppercase tracking-[0.15em]">Limited Time Offer</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                    Flash <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400">Sale</span>
                </h2>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Grab these deals before they're gone</p>
            </div>
            {{-- Countdown --}}
            <div class="flex items-stretch gap-1.5 sm:gap-2">
                <div class="text-center bg-gray-900/80 border border-red-500/20 rounded-xl sm:rounded-2xl px-3 sm:px-5 py-2.5 sm:py-3 min-w-[3.5rem] sm:min-w-[5.5rem]">
                    <div class="font-mono font-black text-white text-2xl sm:text-3xl leading-none" x-text="t.split(':')[0]">00</div>
                    <div class="text-gray-600 text-[9px] sm:text-[10px] uppercase tracking-widest mt-1">HRS</div>
                </div>
                <div class="flex items-center text-red-500 font-black text-xl sm:text-2xl self-center pb-3 sm:pb-4">:</div>
                <div class="text-center bg-gray-900/80 border border-red-500/20 rounded-xl sm:rounded-2xl px-3 sm:px-5 py-2.5 sm:py-3 min-w-[3.5rem] sm:min-w-[5.5rem]">
                    <div class="font-mono font-black text-white text-2xl sm:text-3xl leading-none" x-text="t.split(':')[1]">00</div>
                    <div class="text-gray-600 text-[9px] sm:text-[10px] uppercase tracking-widest mt-1">MIN</div>
                </div>
                <div class="flex items-center text-red-500 font-black text-xl sm:text-2xl self-center pb-3 sm:pb-4">:</div>
                <div class="text-center bg-gray-900/80 border border-red-500/20 rounded-xl sm:rounded-2xl px-3 sm:px-5 py-2.5 sm:py-3 min-w-[3.5rem] sm:min-w-[5.5rem]">
                    <div class="font-mono font-black text-red-400 text-2xl sm:text-3xl leading-none animate-pulse" x-text="t.split(':')[2]">00</div>
                    <div class="text-gray-600 text-[9px] sm:text-[10px] uppercase tracking-widest mt-1">SEC</div>
                </div>
            </div>
        </div>
        {{-- Products --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($flashSale as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('search') }}"
               class="inline-flex items-center gap-2 border border-red-500/40 text-red-400 hover:bg-red-500/10 font-semibold px-6 py-3 rounded-xl text-sm transition-all duration-200">
                View All Sale Items
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- =====================================================================
     CATEGORIES
     ===================================================================== --}}
<section class="relative overflow-hidden bg-white">
    {{-- Background product drawings (light gray, very faint) --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:0.045;">
        {{-- Huge bulb outline right --}}
        <svg class="absolute -right-24 top-1/2 -translate-y-1/2 w-80 h-80 text-gray-400" viewBox="0 0 100 130" fill="none" stroke="currentColor" stroke-width="2.5">
            <ellipse cx="50" cy="50" rx="35" ry="42"/>
            <path d="M36 88 L64 88"/>
            <rect x="38" y="88" width="24" height="13" rx="4"/>
            <line x1="50" y1="101" x2="50" y2="112"/>
            <rect x="36" y="112" width="28" height="7" rx="3"/>
            <line x1="50" y1="8" x2="50" y2="20"/>
        </svg>
        {{-- Huge battery outline left --}}
        <svg class="absolute -left-20 bottom-8 w-64 h-64 text-gray-400" viewBox="0 0 120 60" fill="none" stroke="currentColor" stroke-width="2.5">
            <rect x="2" y="10" width="100" height="42" rx="8"/>
            <rect x="102" y="22" width="16" height="18" rx="4"/>
            <line x1="18" y1="31" x2="52" y2="31"/>
            <line x1="35" y1="14" x2="35" y2="48"/>
            <line x1="70" y1="31" x2="90" y2="31"/>
        </svg>
        {{-- Fan blades top-centre --}}
        <svg class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-48 text-gray-300" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2.5">
            <circle cx="50" cy="50" r="44"/>
            <ellipse cx="50" cy="18" rx="9" ry="28" transform="rotate(0 50 50)"/>
            <ellipse cx="50" cy="18" rx="9" ry="28" transform="rotate(120 50 50)"/>
            <ellipse cx="50" cy="18" rx="9" ry="28" transform="rotate(240 50 50)"/>
            <circle cx="50" cy="50" r="7"/>
        </svg>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
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
    </div>
</section>

{{-- =====================================================================
     FEATURED PRODUCTS
     ===================================================================== --}}
<section id="products-section" class="relative overflow-hidden bg-gray-50">
    {{-- Background: faint circuit-board grid + product silhouettes --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:0.05;">
        {{-- Wire/cord coil bottom-right --}}
        <svg class="absolute -bottom-8 -right-8 w-72 h-72 text-gray-500" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M50 10 Q80 10 80 40 Q80 70 50 70 Q20 70 20 45 Q20 20 45 20 Q65 20 65 40 Q65 58 50 58 Q36 58 36 45 Q36 32 48 32"/>
            <path d="M50 70 L50 90"/>
            <line x1="40" y1="90" x2="60" y2="90"/>
        </svg>
        {{-- Bolt scatter top-left --}}
        <svg class="absolute top-4 left-4 w-20 h-20 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        <svg class="absolute top-16 left-24 w-10 h-10 text-amber-300" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        {{-- Circuit grid --}}
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 500" preserveAspectRatio="xMidYMid slice">
            <g stroke="#9ca3af" stroke-width="1" fill="none" opacity="0.8" stroke-dasharray="4,8">
                <line x1="0"    y1="100" x2="1440" y2="100"/>
                <line x1="0"    y1="250" x2="1440" y2="250"/>
                <line x1="0"    y1="400" x2="1440" y2="400"/>
                <line x1="200"  y1="0"   x2="200"  y2="500"/>
                <line x1="500"  y1="0"   x2="500"  y2="500"/>
                <line x1="800"  y1="0"   x2="800"  y2="500"/>
                <line x1="1100" y1="0"   x2="1100" y2="500"/>
                <line x1="1400" y1="0"   x2="1400" y2="500"/>
            </g>
        </svg>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
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
    </div>
</section>

{{-- =====================================================================
     WHY US
     ===================================================================== --}}
<section class="relative overflow-hidden bg-gray-950 py-20">
    {{-- Background product drawings (amber tones on dark) --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:0.07;">
        {{-- Bulb left --}}
        <svg class="absolute -left-16 top-1/2 -translate-y-1/2 w-64 h-64 text-amber-400" viewBox="0 0 100 130" fill="none" stroke="currentColor" stroke-width="3">
            <ellipse cx="50" cy="50" rx="35" ry="42"/>
            <path d="M36 88 L64 88" stroke-width="3.5"/>
            <rect x="38" y="88" width="24" height="13" rx="4"/>
            <line x1="50" y1="101" x2="50" y2="112"/>
            <rect x="36" y="112" width="28" height="7" rx="3"/>
            <line x1="50" y1="4" x2="50" y2="16"/>
        </svg>
        {{-- Extension board right --}}
        <svg class="absolute -right-10 top-1/2 -translate-y-1/2 w-56 h-56 text-amber-400" viewBox="0 0 120 50" fill="none" stroke="currentColor" stroke-width="3">
            <rect x="2" y="10" width="100" height="30" rx="12"/>
            <circle cx="28" cy="25" r="8"/>
            <circle cx="54" cy="25" r="8"/>
            <circle cx="80" cy="25" r="8"/>
            <path d="M102 25 Q115 25 115 38" stroke-linecap="round"/>
            <circle cx="108" cy="25" r="5"/>
        </svg>
        {{-- Bolt cluster centre-top --}}
        <svg class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="xMidYMid slice">
            <g fill="#fbbf24" opacity="0.6">
                <path transform="translate(680,20) scale(4)" d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                <path transform="translate(200,280) scale(2.5)" d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                <path transform="translate(1180,60) scale(3)" d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </g>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Why Choose Us</p>
            <h2 class="text-4xl font-black text-white">Built for Pakistan</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="group">
                <div class="w-16 h-16 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-amber-400/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-2">Cash on Delivery</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Pay when your order arrives. No upfront payment needed. We trust you.</p>
            </div>
            <div class="group">
                <div class="w-16 h-16 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-amber-400/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-2">PKR 200 Flat Shipping</h3>
                <p class="text-gray-500 text-sm leading-relaxed">One simple rate across all of Pakistan. No surprises, no hidden charges.</p>
            </div>
            <div class="group">
                <div class="w-16 h-16 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-amber-400/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-2">Genuine Products</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Sourced from trusted brands: Philips, Panasonic, Sogo & more.</p>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script defer src="{{ Vite::asset('resources/js/animation.js') }}"></script>
@endpush

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'New Electric') — Pakistan's Electrical Store</title>
    <meta name="description" content="@yield('meta_description', 'New Electric — quality electrical products. Batteries, fans, bulbs, wires and more. Cash on delivery across Pakistan.')">
    @stack('meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..900;1,14..32,300..900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-blur { backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        [x-cloak] { display: none !important; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
        .animate-fadeup { animation: fadeup 0.5s ease forwards; }
        @keyframes fadeup { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
        .product-card:hover .product-img { transform: scale(1.06); }
        .product-img { transition: transform 0.4s cubic-bezier(0.25,0.46,0.45,0.94); }
        .drawer-overlay { background: rgba(0,0,0,0.55); backdrop-filter: blur(4px); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #fbbf24; border-radius: 3px; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased" x-data="{ mobileOpen: false, searchOpen: false }" @keydown.escape="mobileOpen=false; searchOpen=false">

{{-- HEADER --}}
<header class="sticky top-0 z-50 nav-blur bg-white/90 border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0 group">
                <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center shadow group-hover:shadow-amber-300 group-hover:scale-105 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="font-black text-lg tracking-tight text-gray-900">New<span class="text-amber-500">Electric</span></span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-0.5 text-sm font-medium text-gray-600 flex-1 justify-center">
                @foreach(\App\Models\Category::all() as $cat)
                <a href="{{ route('category', $cat->slug) }}"
                   class="px-3 py-1.5 rounded-lg hover:bg-amber-50 hover:text-amber-700 transition-all duration-150 whitespace-nowrap {{ request()->is('category/'.$cat->slug) ? 'bg-amber-50 text-amber-700 font-semibold' : '' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </nav>

            {{-- Right actions --}}
            <div class="flex items-center gap-1.5">
                <button @click="searchOpen = !searchOpen"
                    class="p-2 rounded-lg text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition-all"
                    :class="{ 'bg-amber-50 text-amber-600': searchOpen }">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                <a href="{{ route('cart') }}" class="relative p-2 rounded-lg text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    @php $cartCount = app(\App\Services\CartService::class)->count(); @endphp
                    @if($cartCount > 0)
                    <span class="absolute -top-0.5 -right-0.5 bg-amber-500 text-white text-xs font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">{{ $cartCount }}</span>
                    @endif
                </a>
                <button @click="mobileOpen = true" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Expandable search bar --}}
    <div x-show="searchOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="border-t border-gray-100 px-4 py-3 bg-white/95">
        <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Search batteries, fans, bulbs, wires..." autofocus
                   class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
            <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-gray-900 font-semibold px-5 py-2.5 rounded-xl text-sm transition-colors shadow-sm">Search</button>
        </form>
    </div>
</header>

{{-- MOBILE DRAWER --}}
<div x-show="mobileOpen" x-cloak class="fixed inset-0 z-50 lg:hidden"
     x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 drawer-overlay" @click="mobileOpen = false"></div>
    <div class="absolute right-0 top-0 h-full w-72 bg-white shadow-2xl flex flex-col"
         x-transition:enter="transition ease-out duration-250"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-gray-950">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 bg-amber-400 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="font-black text-white">New<span class="text-amber-400">Electric</span></span>
            </div>
            <button @click="mobileOpen = false" class="p-1.5 rounded-lg text-gray-400 hover:bg-gray-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="px-4 py-3 border-b border-gray-100">
            <form action="{{ route('search') }}" method="GET">
                <input name="q" placeholder="Search products..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-400">
            </form>
        </div>
        <nav class="flex-1 overflow-y-auto px-3 py-4">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-3">Categories</p>
            @foreach(\App\Models\Category::all() as $cat)
            <a href="{{ route('category', $cat->slug) }}" @click="mobileOpen = false"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors mb-0.5">
                <span class="text-amber-500">⚡</span>{{ $cat->name }}
            </a>
            @endforeach
            <div class="border-t border-gray-100 mt-4 pt-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-3">More</p>
                <a href="{{ route('cart') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition-colors font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Cart ({{ app(\App\Services\CartService::class)->count() }})
                </a>
                <a href="{{ route('about') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors">About Us</a>
                <a href="{{ route('contact') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors">Contact</a>
            </div>
        </nav>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                Cash on Delivery Available
            </div>
        </div>
    </div>
</div>

{{-- Toast notifications --}}
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
     x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
     class="fixed top-20 right-4 z-40 bg-gray-900 text-white text-sm font-medium px-4 py-3 rounded-xl shadow-xl flex items-center gap-2 max-w-xs">
    <svg class="h-4 w-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
     x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
     class="fixed top-20 right-4 z-40 bg-red-600 text-white text-sm font-medium px-4 py-3 rounded-xl shadow-xl max-w-xs">
    {{ session('error') }}
</div>
@endif

<main>@yield('content')</main>

{{-- FOOTER --}}
<footer class="bg-gray-950 text-gray-400 mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <span class="font-black text-white text-lg">New<span class="text-amber-400">Electric</span></span>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed">Pakistan's trusted source for quality electrical products.</p>
                <div class="mt-5 inline-flex items-center gap-2 bg-green-900/40 text-green-400 text-xs font-medium px-3 py-1.5 rounded-full border border-green-800">
                    <div class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></div>
                    Cash on Delivery Available
                </div>
            </div>
            <div>
                <h4 class="font-bold text-white mb-4 text-xs uppercase tracking-widest">Categories</h4>
                <ul class="space-y-2.5">
                    @foreach(\App\Models\Category::all() as $cat)
                    <li><a href="{{ route('category', $cat->slug) }}" class="text-sm hover:text-amber-400 transition-colors">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white mb-4 text-xs uppercase tracking-widest">Company</h4>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('about') }}" class="text-sm hover:text-amber-400 transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm hover:text-amber-400 transition-colors">Contact</a></li>
                    <li><a href="{{ route('shipping') }}" class="text-sm hover:text-amber-400 transition-colors">Shipping Policy</a></li>
                    <li><a href="{{ route('returns') }}" class="text-sm hover:text-amber-400 transition-colors">Returns Policy</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-sm hover:text-amber-400 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white mb-4 text-xs uppercase tracking-widest">Payment & Shipping</h4>
                <div class="bg-gray-900 rounded-xl p-4 border border-gray-800">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-green-900/50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-white text-sm font-semibold">Pay on Delivery</div>
                            <div class="text-gray-500 text-xs">Cash when it arrives</div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-600">PKR 200 flat shipping · 2–5 business days</div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-600">© {{ date('Y') }} New Electric Pakistan. All rights reserved.</p>
            <p class="text-xs text-gray-600">Built with ⚡ for Pakistan</p>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'New Electric') — Pakistan's Electrical Store</title>
    <meta name="description" content="@yield('meta_description', 'New Electric — quality electrical products. Batteries, fans, bulbs, wires and more. Cash on delivery across Pakistan.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..900;1,14..32,300..900&display=swap" rel="stylesheet">

    @php
        $clerkPubKey = env('CLERK_PUBLISHABLE_KEY') ?: env('NEXT_PUBLIC_CLERK_PUBLISHABLE_KEY', '');
        $clerkActive = $clerkPubKey && $clerkPubKey !== 'pk_test_placeholder_add_your_key_here';
    @endphp

    {{-- Clerk JS (loads on every page to detect active sessions) --}}
    @if($clerkActive)
    <script
        async
        crossorigin="anonymous"
        data-clerk-publishable-key="{{ $clerkPubKey }}"
        src="https://cdn.jsdelivr.net/npm/@clerk/clerk-js@latest/dist/clerk.browser.js"
        type="text/javascript"
        id="clerk-script"
    ></script>
    @endif

    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-blur { backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); }
        [x-cloak] { display: none !important; }
        .line-clamp-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        .line-clamp-1 { display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden; }
        .product-card:hover .product-img { transform:scale(1.06); }
        .product-img { transition:transform .4s cubic-bezier(.25,.46,.45,.94); }
        .drawer-overlay { background:rgba(0,0,0,.55); backdrop-filter:blur(4px); }
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-track { background:#f1f5f9; }
        ::-webkit-scrollbar-thumb { background:#fbbf24; border-radius:3px; }

        /* Shimmer fill — Sign Up button */
        @keyframes btn-shimmer {
            0%   { background-position:-200% center; }
            100% { background-position: 200% center; }
        }
        .btn-signup {
            background:linear-gradient(90deg,#f59e0b 0%,#fef08a 40%,#fbbf24 60%,#f59e0b 100%);
            background-size:200% auto;
            transition:background-position .5s ease,transform .2s ease,box-shadow .2s ease;
        }
        .btn-signup:hover {
            background-position:right center;
            transform:translateY(-1px);
            box-shadow:0 4px 18px rgba(251,191,36,.45);
        }

        /* Animated gradient border — Sign In button */
        @keyframes border-flow {
            0%   { background-position:0% 50%; }
            100% { background-position:200% 50%; }
        }
        .btn-signin {
            position:relative;
            transition:color .2s ease, transform .2s ease;
        }
        .btn-signin::before {
            content:'';
            position:absolute;
            inset:0;
            border-radius:.75rem;
            padding:1.5px;
            background:linear-gradient(90deg,#fbbf24,#f59e0b,#78716c,#fbbf24);
            background-size:300% 100%;
            -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
            mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
            -webkit-mask-composite:xor; mask-composite:exclude;
            animation:border-flow 3s linear infinite;
        }
        .btn-signin:hover { transform:translateY(-1px); }

        /* Modal animation */
        @keyframes modal-in {
            from { opacity:0; transform:scale(.93) translateY(14px); }
            to   { opacity:1; transform:scale(1)   translateY(0); }
        }
        .modal-panel { animation:modal-in .22s cubic-bezier(.34,1.56,.64,1) forwards; }

        /* Clerk component dark overrides */
        .clerk-dark .cl-card {
            background:#111827 !important;
            border:1px solid #1f2937 !important;
            border-radius:1.25rem !important;
            box-shadow:0 25px 50px -12px rgba(0,0,0,.7) !important;
        }
        .clerk-dark .cl-headerTitle  { color:#f9fafb !important; }
        .clerk-dark .cl-headerSubtitle,
        .clerk-dark .cl-formFieldLabel,
        .clerk-dark .cl-footerActionText { color:#9ca3af !important; }
        .clerk-dark .cl-formFieldInput {
            background:#0f172a !important;
            border-color:#374151 !important;
            color:#f9fafb !important;
        }
        .clerk-dark .cl-formButtonPrimary {
            background:linear-gradient(135deg,#f59e0b,#d97706) !important;
            color:#111827 !important;
            font-weight:800 !important;
        }
        .clerk-dark .cl-footerActionLink { color:#f59e0b !important; }
        .clerk-dark .cl-dividerLine     { background:#374151 !important; }
        .clerk-dark .cl-socialButtonsBlockButton { border-color:#374151 !important; background:#1f2937 !important; color:#f9fafb !important; }
    </style>
</head>

@php $clerkUser = session('clerk_user'); @endphp

<body class="bg-white text-gray-900 antialiased"
      x-data="{
        mobileOpen: false,
        searchOpen: false,
        authOpen: false,
        userMenuOpen: false,
        clerkReady: false,
        clerkMounted: false,
        openAuth() {
            this.authOpen = true;
            this.$nextTick(() => this.mountClerk());
        },
        async mountClerk() {
            if (this.clerkMounted || !window.Clerk) return;
            await window.Clerk.load();
            const el = document.getElementById('clerk-auth-mount');
            if (!el) return;
            window.Clerk.mountSignIn(el, {
                afterSignInUrl: '/__clerk-bridge',
                afterSignUpUrl: '/__clerk-bridge',
            });
            this.clerkMounted = true;
        }
      }"
      @keydown.escape="mobileOpen=false; searchOpen=false; authOpen=false; userMenuOpen=false">

{{-- ========== HEADER ========== --}}
<header class="sticky top-0 z-50 nav-blur bg-white/92 border-b border-gray-100/80 shadow-sm">

    {{-- Flash Sale Strip --}}
    @php
        $flashSaleEndTime = \App\Models\Product::where('is_on_sale', true)
            ->whereNotNull('sale_ends_at')->where('sale_ends_at', '>', now())->min('sale_ends_at');
    @endphp
    @if($flashSaleEndTime)
    <div x-data="{
            show: true, t: '00:00:00',
            init() {
                const end = new Date('{{ \Carbon\Carbon::parse($flashSaleEndTime)->toIso8601String() }}');
                const tick = () => {
                    const d = end - new Date();
                    if (d <= 0) { this.t = 'ENDED'; return; }
                    const h = String(Math.floor(d/3600000)).padStart(2,'0');
                    const m = String(Math.floor(d%3600000/60000)).padStart(2,'0');
                    const s = String(Math.floor(d%60000/1000)).padStart(2,'0');
                    this.t = h+':'+m+':'+s;
                };
                tick(); setInterval(tick,1000);
            }
        }" x-show="show"
        class="bg-gradient-to-r from-red-600 via-rose-500 to-orange-500 text-white text-xs font-bold py-2 px-4 flex items-center justify-center gap-3 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image:repeating-linear-gradient(45deg,rgba(255,255,255,.1) 0,rgba(255,255,255,.1) 2px,transparent 2px,transparent 10px)"></div>
        <span class="relative flex items-center gap-2"><span class="animate-pulse">⚡</span><span class="hidden sm:inline">FLASH SALE — Up to 25% OFF!</span><span class="sm:hidden">FLASH SALE!</span></span>
        <span class="relative bg-black/25 rounded-lg px-2.5 py-1 font-mono tracking-widest text-sm" x-text="t">00:00:00</span>
        <a href="#flash-sale" class="relative bg-white text-red-600 text-xs font-black px-3 py-1 rounded-full hover:bg-gray-100 transition-colors hidden sm:block whitespace-nowrap">Shop Now →</a>
        <button @click="show=false" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/60 hover:text-white p-1">
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    {{-- Main nav row --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 gap-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0 group">
                <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-amber-300/50 group-hover:scale-105 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="font-black text-lg tracking-tight text-gray-900 leading-none">New<span class="text-amber-500">Electric</span></span>
            </a>

            {{-- Desktop category nav (centred) --}}
            <nav class="hidden lg:flex items-center gap-0.5 text-sm font-medium text-gray-600 flex-1 justify-center">
                @foreach(\App\Models\Category::all() as $cat)
                <a href="{{ route('category', $cat->slug) }}"
                   class="px-3 py-1.5 rounded-lg hover:bg-amber-50 hover:text-amber-700 transition-all duration-150 whitespace-nowrap {{ request()->is('category/'.$cat->slug) ? 'bg-amber-50 text-amber-700 font-semibold' : '' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </nav>

            {{-- Right action cluster --}}
            <div class="flex items-center gap-1 ml-auto lg:ml-0">

                {{-- Search --}}
                <button @click="searchOpen=!searchOpen"
                    class="p-2 rounded-lg text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition-all"
                    :class="{'bg-amber-50 text-amber-600': searchOpen}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>

                {{-- Cart --}}
                <a href="{{ route('cart') }}" class="relative p-2 rounded-lg text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition-all">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    @php $cartCount = app(\App\Services\CartService::class)->count(); @endphp
                    @if($cartCount > 0)
                    <span class="absolute -top-0.5 -right-0.5 bg-amber-500 text-white text-[10px] font-black rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1 leading-none">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- ── AUTH STATE ── --}}
                @if($clerkUser)
                {{-- Signed-in: avatar + dropdown --}}
                <div class="relative hidden sm:block" x-data="{ open: false }" @click.outside="open=false">
                    <button @click="open=!open"
                        class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-gray-100 transition-all group">
                        {{-- Avatar --}}
                        @if($clerkUser['image_url'] ?? false)
                        <img src="{{ $clerkUser['image_url'] }}" class="w-7 h-7 rounded-full object-cover ring-2 ring-amber-400/40" alt="">
                        @else
                        <div class="w-7 h-7 rounded-full bg-amber-400 flex items-center justify-center ring-2 ring-amber-400/40">
                            <span class="text-gray-900 font-black text-xs">{{ strtoupper(substr($clerkUser['name'] ?? 'U', 0, 1)) }}</span>
                        </div>
                        @endif
                        {{-- Name --}}
                        <span class="text-sm font-semibold text-gray-700 max-w-[90px] truncate">{{ explode(' ', $clerkUser['name'] ?? 'Account')[0] }}</span>
                        <svg class="h-3.5 w-3.5 text-gray-400 transition-transform group-hover:text-gray-600" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    {{-- Dropdown --}}
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 top-full mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50 py-1">
                        {{-- User info chip --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="text-sm font-black text-gray-900 truncate">{{ $clerkUser['name'] ?? '' }}</div>
                            <div class="text-xs text-gray-400 truncate">{{ $clerkUser['email'] ?? '' }}</div>
                        </div>
                        <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors font-medium">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors font-medium">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            My Orders
                        </a>
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form method="POST" action="{{ route('auth.sign-out') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors font-medium">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @else
                {{-- Not signed in: Sign In + Sign Up --}}
                <div class="hidden sm:flex items-center gap-2">
                    {{-- Sign In — animated border --}}
                    <button @click="openAuth()"
                        class="btn-signin inline-flex items-center gap-1.5 text-gray-700 hover:text-amber-700 font-bold text-sm px-4 py-2 rounded-xl transition-all duration-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Sign In
                    </button>
                    {{-- Sign Up — shimmer fill --}}
                    <button @click="openAuth()"
                        class="btn-signup inline-flex items-center gap-1.5 text-gray-900 font-black text-sm px-4 py-2 rounded-xl">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Sign Up
                    </button>
                </div>
                @endif

                {{-- Mobile hamburger --}}
                <button @click="mobileOpen=true" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-all ml-1">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>{{-- /right cluster --}}

        </div>
    </div>

    {{-- Expandable search --}}
    <div x-show="searchOpen" x-cloak
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"  x-transition:leave-end="opacity-0 -translate-y-2"
         class="border-t border-gray-100 px-4 py-3 bg-white/97">
        <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Search batteries, fans, bulbs, wires..." autofocus
                   class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all">
            <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-gray-900 font-bold px-5 py-2.5 rounded-xl text-sm transition-colors shadow-sm">Search</button>
        </form>
    </div>

</header>
{{-- ========== /HEADER ========== --}}


{{-- ========== MOBILE DRAWER ========== --}}
<div x-show="mobileOpen" x-cloak class="fixed inset-0 z-50 lg:hidden"
     x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 drawer-overlay" @click="mobileOpen=false"></div>
    <div class="absolute right-0 top-0 h-full w-72 bg-white shadow-2xl flex flex-col"
         x-transition:enter="transition ease-out duration-250" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"  x-transition:leave-start="translate-x-0"  x-transition:leave-end="translate-x-full">

        {{-- Drawer header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-gray-950">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 bg-amber-400 rounded-lg flex items-center justify-center">
                    <svg class="h-4 w-4 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="font-black text-white">New<span class="text-amber-400">Electric</span></span>
            </div>
            <button @click="mobileOpen=false" class="p-1.5 rounded-lg text-gray-400 hover:bg-gray-800 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Drawer search --}}
        <div class="px-4 py-3 border-b border-gray-100">
            <form action="{{ route('search') }}" method="GET">
                <input name="q" placeholder="Search products..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-400">
            </form>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4">
            {{-- User chip in drawer --}}
            @if($clerkUser)
            <div class="flex items-center gap-3 px-3 py-3 mb-3 bg-amber-50 rounded-xl border border-amber-100">
                @if($clerkUser['image_url'] ?? false)
                <img src="{{ $clerkUser['image_url'] }}" class="w-9 h-9 rounded-full object-cover ring-2 ring-amber-400/50" alt="">
                @else
                <div class="w-9 h-9 rounded-full bg-amber-400 flex items-center justify-center shrink-0">
                    <span class="text-gray-900 font-black text-sm">{{ strtoupper(substr($clerkUser['name'] ?? 'U', 0, 1)) }}</span>
                </div>
                @endif
                <div class="min-w-0">
                    <div class="font-bold text-sm text-gray-900 truncate">{{ $clerkUser['name'] ?? '' }}</div>
                    <div class="text-xs text-gray-500 truncate">{{ $clerkUser['email'] ?? '' }}</div>
                </div>
            </div>
            @endif

            {{-- Categories --}}
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-3">Categories</p>
            @foreach(\App\Models\Category::all() as $cat)
            <a href="{{ route('category', $cat->slug) }}" @click="mobileOpen=false"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors mb-0.5">
                <span class="text-amber-500">⚡</span>{{ $cat->name }}
            </a>
            @endforeach

            {{-- Account section --}}
            <div class="border-t border-gray-100 mt-4 pt-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-3">Account</p>
                @if($clerkUser)
                <a href="{{ route('customer.dashboard') }}" @click="mobileOpen=false"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors">
                    <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('customer.orders') }}" @click="mobileOpen=false"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors">
                    <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    My Orders
                </a>
                <form method="POST" action="{{ route('auth.sign-out') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                        Sign Out
                    </button>
                </form>
                @else
                <button @click="mobileOpen=false; openAuth()"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors mb-1">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Sign In / Sign Up
                </button>
                @endif
            </div>

            {{-- Extras --}}
            <div class="border-t border-gray-100 mt-3 pt-3">
                <a href="{{ route('cart') }}" @click="mobileOpen=false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition-colors font-medium">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Cart ({{ app(\App\Services\CartService::class)->count() }})
                </a>
                <a href="{{ route('about') }}"   @click="mobileOpen=false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors">About Us</a>
                <a href="{{ route('contact') }}" @click="mobileOpen=false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors">Contact</a>
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
{{-- ========== /MOBILE DRAWER ========== --}}


{{-- ========== AUTH MODAL (Clerk embedded) ========== --}}
<div x-show="authOpen" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-end="opacity-0">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-gray-950/75 backdrop-blur-sm" @click="authOpen=false; clerkMounted=false; document.getElementById('clerk-auth-mount')?.replaceChildren()"></div>

    {{-- Panel --}}
    <div class="modal-panel relative w-full max-w-sm bg-gray-950 rounded-3xl shadow-2xl border border-gray-800 overflow-hidden">
        {{-- Amber top bar --}}
        <div class="h-1 bg-gradient-to-r from-amber-500 via-yellow-300 to-amber-500"></div>

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 pt-5 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="h-5 w-5 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-black text-white leading-tight">New Electric</h2>
                    <p class="text-xs text-gray-500">Sign in or create your account</p>
                </div>
            </div>
            <button @click="authOpen=false; clerkMounted=false; document.getElementById('clerk-auth-mount')?.replaceChildren()"
                class="p-2 rounded-xl text-gray-500 hover:text-gray-300 hover:bg-gray-800 transition-all">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Clerk mount point --}}
        <div class="px-6 pb-6">
            @if($clerkActive)
            {{-- Clerk will mount here --}}
            <div id="clerk-auth-mount" class="clerk-dark min-h-[340px] flex items-center justify-center">
                <div class="text-gray-600 text-sm">Loading…</div>
            </div>
            @else
            {{-- No key configured — show setup instructions + direct link --}}
            <div class="text-center py-6">
                <div class="w-14 h-14 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="h-7 w-7 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <h3 class="text-white font-black text-lg mb-2">Add Your Clerk Key</h3>
                <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                    To enable sign-in, add your Clerk publishable key to <code class="text-amber-400 text-xs bg-gray-800 px-1.5 py-0.5 rounded">.env</code>:
                </p>
                <div class="bg-gray-900 border border-gray-700 rounded-xl px-4 py-3 text-left mb-5 font-mono text-xs text-amber-300 break-all">
                    CLERK_PUBLISHABLE_KEY=pk_test_<span class="text-gray-500">your_key_here</span>
                </div>
                <p class="text-xs text-gray-500 mb-4">Get your key free at <span class="text-amber-400">dashboard.clerk.com</span> → API Keys</p>
                <a href="{{ route('auth.sign-in') }}"
                   class="inline-flex items-center gap-2 btn-signup text-gray-900 font-black px-6 py-3 rounded-2xl text-sm">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14"/></svg>
                    Open Sign-In Page →
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- ========== /AUTH MODAL ========== --}}


{{-- Toast: success --}}
@if(session('success'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,3500)"
     x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
     class="fixed top-20 right-4 z-40 bg-gray-900 text-white text-sm font-medium px-4 py-3 rounded-xl shadow-xl flex items-center gap-2 max-w-xs">
    <svg class="h-4 w-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif
{{-- Toast: error --}}
@if(session('error'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,3500)"
     x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
     class="fixed top-20 right-4 z-40 bg-red-600 text-white text-sm font-medium px-4 py-3 rounded-xl shadow-xl max-w-xs">
    {{ session('error') }}
</div>
@endif

<main>@yield('content')</main>

{{-- ========== FOOTER ========== --}}
<footer class="bg-gray-950 text-gray-400 mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
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
                    <li><a href="{{ route('about') }}"    class="text-sm hover:text-amber-400 transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}"  class="text-sm hover:text-amber-400 transition-colors">Contact</a></li>
                    <li><a href="{{ route('shipping') }}" class="text-sm hover:text-amber-400 transition-colors">Shipping Policy</a></li>
                    <li><a href="{{ route('returns') }}"  class="text-sm hover:text-amber-400 transition-colors">Returns Policy</a></li>
                    <li><a href="{{ route('privacy') }}"  class="text-sm hover:text-amber-400 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white mb-4 text-xs uppercase tracking-widest">Payment & Shipping</h4>
                <div class="bg-gray-900 rounded-xl p-4 border border-gray-800">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-green-900/50 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
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

{{-- Clerk bridge: auto-bridge session after Clerk sign-in redirects back --}}
@if(!$clerkUser && $clerkActive)
<script>
(async function() {
    const script = document.getElementById('clerk-script');
    if (!script) return;
    await new Promise(resolve => {
        if (window.Clerk) return resolve();
        script.addEventListener('load', async () => {
            await window.Clerk?.load?.();
            resolve();
        });
        setTimeout(resolve, 5000);
    });
    if (!window.Clerk?.user) return;
    const user  = window.Clerk.user;
    const email = user.primaryEmailAddress?.emailAddress ?? '';
    const csrf  = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    await fetch('/auth/clerk-session', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        body: JSON.stringify({ clerk_user_id: user.id, email, name: user.fullName ?? email, image_url: user.imageUrl ?? '' }),
    }).then(r => r.ok && window.location.reload());
})();
</script>
@endif

@stack('scripts')
</body>
</html>

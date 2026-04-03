<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Account') — New Electric</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { background: #030712; }
        @keyframes fade-in { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
        .fade-in { animation: fade-in .35s ease both; }
    </style>
</head>
<body class="h-full text-gray-100" x-data="{ sidebarOpen: false }">

<div class="flex h-full min-h-screen">

    {{-- Sidebar --}}
    <aside class="hidden lg:flex lg:flex-col w-64 bg-gray-900 border-r border-gray-800 shrink-0">
        {{-- Brand --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-6 py-5 border-b border-gray-800">
            <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2L4.5 13.5H11L9 22 19.5 10.5H13L13 2Z"/>
                </svg>
            </div>
            <span class="font-black text-white text-lg tracking-tight">New Electric</span>
        </a>

        {{-- User --}}
        @php $clerk = session('clerk_user'); @endphp
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-800">
            @if($clerk['image_url'] ?? false)
            <img src="{{ $clerk['image_url'] }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-amber-400/30" alt="">
            @else
            <div class="w-10 h-10 rounded-full bg-amber-400/20 ring-2 ring-amber-400/30 flex items-center justify-center">
                <span class="text-amber-400 font-black text-sm">{{ strtoupper(substr($clerk['name'] ?? 'U', 0, 1)) }}</span>
            </div>
            @endif
            <div class="min-w-0">
                <div class="font-bold text-sm text-white truncate">{{ $clerk['name'] ?? 'Customer' }}</div>
                <div class="text-xs text-gray-400 truncate">{{ $clerk['email'] ?? '' }}</div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 py-4 space-y-1">
            <a href="{{ route('customer.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('customer.dashboard') ? 'bg-amber-400/10 text-amber-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                Dashboard
            </a>
            <a href="{{ route('customer.orders') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('customer.orders') ? 'bg-amber-400/10 text-amber-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                My Orders
            </a>
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:bg-gray-800 hover:text-white transition-all">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Shop
            </a>
        </nav>

        {{-- Sign out --}}
        <div class="px-4 pb-6">
            <form method="POST" action="{{ route('auth.sign-out') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:bg-red-900/20 hover:text-red-400 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Mobile header --}}
    <div class="lg:hidden fixed top-0 inset-x-0 z-30 flex items-center justify-between px-4 py-3 bg-gray-900 border-b border-gray-800">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2L4.5 13.5H11L9 22 19.5 10.5H13L13 2Z"/>
                </svg>
            </div>
            <span class="font-black text-white text-base">New Electric</span>
        </a>
        <button @click="sidebarOpen = true" class="text-gray-400 hover:text-white p-2">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    {{-- Mobile sidebar overlay --}}
    <div x-show="sidebarOpen" x-cloak class="lg:hidden fixed inset-0 z-40 flex">
        <div @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>
        <aside class="relative w-64 bg-gray-900 border-r border-gray-800 flex flex-col">
            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-800">
                <span class="font-black text-white">My Account</span>
                <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('customer.dashboard') ? 'bg-amber-400/10 text-amber-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">Dashboard</a>
                <a href="{{ route('customer.orders') }}"   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('customer.orders') ? 'bg-amber-400/10 text-amber-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all">My Orders</a>
                <a href="{{ route('home') }}"              class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:bg-gray-800 hover:text-white transition-all">Shop</a>
            </nav>
            <div class="px-4 pb-6">
                <form method="POST" action="{{ route('auth.sign-out') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2.5 text-sm font-semibold text-gray-500 hover:text-red-400 transition-all">Sign Out</button>
                </form>
            </div>
        </aside>
    </div>

    {{-- Main content --}}
    <main class="flex-1 overflow-auto pt-16 lg:pt-0">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-8 lg:py-10 fade-in">
            @yield('content')
        </div>
    </main>

</div>
</body>
</html>

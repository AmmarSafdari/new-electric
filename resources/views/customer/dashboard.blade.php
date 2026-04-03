@extends('customer.layout')
@section('title', 'Dashboard')
@section('content')

{{-- Greeting --}}
<div class="mb-8">
    <p class="text-amber-400 font-bold text-sm uppercase tracking-widest mb-1">Welcome back</p>
    <h1 class="text-3xl font-black text-white">Hi, {{ explode(' ', $user['name'])[0] }} ⚡</h1>
    <p class="text-gray-400 mt-1 text-sm">Here's a summary of your account activity.</p>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <div class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Total Orders</div>
        <div class="text-4xl font-black text-white">{{ $stats['total'] }}</div>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <div class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Pending</div>
        <div class="text-4xl font-black {{ $stats['pending'] > 0 ? 'text-amber-400' : 'text-white' }}">{{ $stats['pending'] }}</div>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
        <div class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Total Spent</div>
        <div class="text-2xl font-black text-amber-400">PKR {{ number_format($stats['spent']) }}</div>
    </div>
</div>

{{-- Recent Orders --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800">
        <h2 class="font-black text-white text-lg">Recent Orders</h2>
        <a href="{{ route('customer.orders') }}" class="text-amber-400 text-sm font-semibold hover:text-amber-300 transition-colors">View all →</a>
    </div>

    @if($orders->isEmpty())
    <div class="flex flex-col items-center justify-center py-16 text-center px-6">
        <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center mb-4">
            <svg class="h-8 w-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        </div>
        <p class="text-gray-400 font-semibold text-sm">No orders yet</p>
        <p class="text-gray-600 text-xs mt-1">Your orders will appear here after checkout</p>
        <a href="{{ route('home') }}" class="mt-4 px-5 py-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black text-sm rounded-xl transition-colors">
            Start Shopping ⚡
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-800">
                    <th class="text-left px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="text-left px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Items</th>
                    <th class="text-left px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="text-left px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-800/30 transition-colors">
                    <td class="px-6 py-4 font-black text-white">#{{ $order->id }}</td>
                    <td class="px-6 py-4 text-gray-400">{{ $order->items->count() }} item{{ $order->items->count() !== 1 ? 's' : '' }}</td>
                    <td class="px-6 py-4 font-bold text-amber-400">PKR {{ number_format($order->total) }}</td>
                    <td class="px-6 py-4">
                        @php
                        $colors = ['pending'=>'bg-yellow-500/10 text-yellow-400','processing'=>'bg-blue-500/10 text-blue-400','shipped'=>'bg-indigo-500/10 text-indigo-400','delivered'=>'bg-green-500/10 text-green-400','cancelled'=>'bg-red-500/10 text-red-400'];
                        $color = $colors[$order->status] ?? 'bg-gray-500/10 text-gray-400';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $color }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection

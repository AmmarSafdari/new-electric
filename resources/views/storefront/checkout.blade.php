@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-1">Almost there!</p>
        <h1 class="text-4xl font-black text-gray-900">Checkout</h1>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        {{-- Form --}}
        <div class="flex-1">
            <form method="POST" action="{{ route('checkout.store') }}" class="space-y-5">
                @csrf

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-black text-gray-900 mb-5 text-lg">Delivery Information</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Email Address <span class="text-gray-400 font-normal">(optional — to track orders)</span></label>
                            <input type="email" name="customer_email" value="{{ old('customer_email', session('clerk_user.email')) }}"
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200 transition-all {{ $errors->has('customer_email') ? 'border-red-400 bg-red-50' : 'border-gray-200 focus:border-amber-400' }}"
                                placeholder="you@example.com">
                            @error('customer_email')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200 transition-all {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200 focus:border-amber-400' }}"
                                placeholder="Muhammad Ali">
                            @error('name')<p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200 transition-all {{ $errors->has('phone') ? 'border-red-400 bg-red-50' : 'border-gray-200 focus:border-amber-400' }}"
                                placeholder="03001234567">
                            @error('phone')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" value="{{ old('city') }}" required
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200 transition-all {{ $errors->has('city') ? 'border-red-400 bg-red-50' : 'border-gray-200 focus:border-amber-400' }}"
                                placeholder="Karachi">
                            @error('city')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Street Address <span class="text-red-500">*</span></label>
                            <textarea name="address" required rows="2"
                                class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200 transition-all resize-none {{ $errors->has('address') ? 'border-red-400 bg-red-50' : 'border-gray-200 focus:border-amber-400' }}"
                                placeholder="House/Flat No., Street, Area">{{ old('address') }}</textarea>
                            @error('address')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Order Notes <span class="text-gray-400 font-normal">(optional)</span></label>
                            <textarea name="notes" rows="2"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-amber-400 transition-all resize-none"
                                placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <div class="font-black text-green-800">Cash on Delivery (COD)</div>
                            <div class="text-green-600 text-sm">Pay the delivery person when your order arrives. No online payment required.</div>
                        </div>
                        <div class="ml-auto shrink-0">
                            <div class="w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
                                <svg class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gray-900 hover:bg-amber-400 hover:text-gray-900 text-white font-black py-4 rounded-2xl text-base transition-all duration-200 hover:-translate-y-0.5 shadow-lg">
                    Place Order →
                </button>
            </form>
        </div>

        {{-- Order summary --}}
        <div class="w-full lg:w-80 shrink-0">
            <div class="bg-gray-950 rounded-2xl p-6 sticky top-24 text-white">
                <h2 class="font-black text-lg mb-5">Your Order</h2>
                <div class="space-y-3 mb-5">
                    @foreach($items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400 line-clamp-1 flex-1 pr-2">{{ $item['title'] }} <span class="text-gray-600">×{{ $item['qty'] }}</span></span>
                        <span class="shrink-0 font-semibold">PKR {{ number_format($item['price'] * $item['qty']) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-800 pt-4 space-y-3 mb-6">
                    <div class="flex justify-between text-sm text-gray-400">
                        <span>Subtotal</span><span class="text-white font-semibold">PKR {{ number_format($total) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-400">
                        <span>Shipping</span><span class="text-white font-semibold">PKR {{ number_format($shipping) }}</span>
                    </div>
                    <div class="flex justify-between font-black text-lg pt-2 border-t border-gray-800">
                        <span>Total</span><span class="text-amber-400">PKR {{ number_format($total + $shipping) }}</span>
                    </div>
                </div>
                <div class="text-xs text-gray-600 text-center">🔒 Your information is safe and secure</div>
            </div>
        </div>
    </div>
</div>
@endsection

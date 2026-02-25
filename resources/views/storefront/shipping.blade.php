@extends('layouts.app')
@section('title', 'Shipping Policy')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Legal</p>
    <h1 class="text-4xl font-black text-gray-900 mb-8">Shipping Policy</h1>
    <div class="space-y-6 text-gray-600">
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Flat Rate Shipping</h2>
            <p>All orders ship for a flat rate of <strong class="text-gray-900">PKR 200</strong> regardless of order size or location within Pakistan.</p>
        </div>
        <div class="bg-gray-50 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Delivery Time</h2>
            <p>Estimated delivery: <strong class="text-gray-900">2–5 business days</strong> depending on your location. Major cities may receive orders sooner.</p>
        </div>
        <div class="bg-gray-50 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Order Processing</h2>
            <p>Orders are processed within <strong class="text-gray-900">1 business day</strong>. You will receive a confirmation call before dispatch.</p>
        </div>
        <div class="bg-green-50 border border-green-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Cash on Delivery</h2>
            <p>We exclusively accept <strong class="text-gray-900">Cash on Delivery (COD)</strong>. Pay the delivery person when your order arrives. No advance payment required.</p>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Returns Policy')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Legal</p>
    <h1 class="text-4xl font-black text-gray-900 mb-8">Returns Policy</h1>
    <div class="space-y-6 text-gray-600">
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">7-Day Return Window</h2>
            <p>We accept returns within <strong class="text-gray-900">7 days</strong> of delivery for defective or damaged products.</p>
        </div>
        <div class="bg-gray-50 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Return Conditions</h2>
            <ul class="space-y-2">
                <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Item must be unused and in original packaging</li>
                <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Proof of purchase required</li>
                <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Contact us by phone to initiate a return</li>
            </ul>
        </div>
        <div class="bg-gray-50 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Shipping Costs</h2>
            <p>Return shipping costs are the responsibility of the customer unless the item is defective or damaged upon arrival.</p>
        </div>
    </div>
</div>
@endsection

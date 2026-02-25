@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <p class="text-amber-500 font-semibold text-sm uppercase tracking-widest mb-2">Legal</p>
    <h1 class="text-4xl font-black text-gray-900 mb-8">Privacy Policy</h1>
    <div class="space-y-6 text-gray-600">
        <div class="bg-gray-50 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Information We Collect</h2>
            <p>We collect only the information necessary to process your order: your name, phone number, and delivery address. We do not collect payment card information (we accept Cash on Delivery only).</p>
        </div>
        <div class="bg-gray-50 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">How We Use Your Information</h2>
            <p>Your information is used solely to fulfill and communicate about your order. We will contact you by phone to confirm your order before dispatch.</p>
        </div>
        <div class="bg-green-50 border border-green-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-lg mb-2">Data Security</h2>
            <p>We do not sell or share your personal data with third parties. Order information is stored securely and retained only as long as necessary.</p>
        </div>
    </div>
</div>
@endsection

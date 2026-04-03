<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /** POST /auth/clerk-session  — called by Clerk JS after sign-in */
    public function clerkSession(Request $request)
    {
        $request->validate([
            'clerk_user_id' => 'required|string',
            'email'         => 'required|email',
            'name'          => 'nullable|string|max:120',
            'image_url'     => 'nullable|url',
        ]);

        session(['clerk_user' => [
            'id'        => $request->clerk_user_id,
            'email'     => $request->email,
            'name'      => $request->name ?? $request->email,
            'image_url' => $request->image_url,
        ]]);

        return response()->json(['ok' => true]);
    }

    /** GET /dashboard */
    public function dashboard()
    {
        $user   = session('clerk_user');
        $orders = Order::with('items')
            ->where('customer_email', $user['email'])
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total'   => Order::where('customer_email', $user['email'])->count(),
            'pending' => Order::where('customer_email', $user['email'])->where('status', 'pending')->count(),
            'spent'   => Order::where('customer_email', $user['email'])->sum('total'),
        ];

        return view('customer.dashboard', compact('user', 'orders', 'stats'));
    }

    /** GET /dashboard/orders */
    public function orders()
    {
        $user   = session('clerk_user');
        $orders = Order::with('items')
            ->where('customer_email', $user['email'])
            ->latest()
            ->paginate(10);

        return view('customer.orders', compact('user', 'orders'));
    }

    /** POST /auth/sign-out */
    public function signOut()
    {
        session()->forget('clerk_user');
        return redirect()->route('home');
    }
}

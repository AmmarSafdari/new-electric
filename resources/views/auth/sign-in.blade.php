<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — New Electric</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $clerkKey = env('CLERK_PUBLISHABLE_KEY') ?: env('NEXT_PUBLIC_CLERK_PUBLISHABLE_KEY', '');
        $hasKey   = $clerkKey && $clerkKey !== 'pk_test_placeholder_add_your_key_here';
    @endphp

    @if($hasKey)
    <script
        async
        crossorigin="anonymous"
        data-clerk-publishable-key="{{ $clerkKey }}"
        src="https://cdn.jsdelivr.net/npm/@clerk/clerk-js@latest/dist/clerk.browser.js"
        type="text/javascript"
        id="clerk-script"
    ></script>
    @endif

    <style>
        body { background: #030712; font-family: 'Inter', sans-serif; }

        /* Dark Clerk overrides */
        #clerk-mount .cl-rootBox { width: 100%; }
        #clerk-mount .cl-card {
            background: #111827 !important;
            border: 1px solid #1f2937 !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 25px 60px -15px rgba(0,0,0,.8) !important;
        }
        #clerk-mount .cl-headerTitle  { color: #f9fafb !important; font-weight: 900 !important; }
        #clerk-mount .cl-headerSubtitle,
        #clerk-mount .cl-formFieldLabel,
        #clerk-mount .cl-footerActionText  { color: #9ca3af !important; }
        #clerk-mount .cl-formFieldInput {
            background: #0f172a !important; border-color: #374151 !important;
            color: #f9fafb !important; border-radius: .75rem !important;
        }
        #clerk-mount .cl-formFieldInput:focus { border-color: #f59e0b !important; box-shadow: 0 0 0 3px rgba(245,158,11,.15) !important; }
        #clerk-mount .cl-formButtonPrimary {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            color: #111827 !important; font-weight: 900 !important;
            border-radius: .75rem !important;
        }
        #clerk-mount .cl-formButtonPrimary:hover { background: #fbbf24 !important; }
        #clerk-mount .cl-footerActionLink { color: #f59e0b !important; }
        #clerk-mount .cl-footerActionLink:hover { color: #fbbf24 !important; }
        #clerk-mount .cl-dividerLine { background: #374151 !important; }
        #clerk-mount .cl-socialButtonsBlockButton {
            border-color: #374151 !important; background: #1f2937 !important;
            color: #f9fafb !important; border-radius: .75rem !important;
        }
        #clerk-mount .cl-socialButtonsBlockButton:hover { background: #374151 !important; }
        #clerk-mount .cl-identityPreviewEditButton { color: #f59e0b !important; }
        #clerk-mount .cl-formResendCodeLink { color: #f59e0b !important; }

        @keyframes fadeup { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
        .fadeup { animation: fadeup .4s ease both; }
        @keyframes bolt-pulse { 0%,100% { opacity:.04; } 50% { opacity:.08; } }
        .bolt-bg { animation: bolt-pulse 4s ease-in-out infinite; }
    </style>
</head>
<body class="h-full flex items-center justify-center min-h-screen px-4 py-10">

{{-- Ambient background bolts --}}
<div class="fixed inset-0 overflow-hidden pointer-events-none bolt-bg">
    <svg viewBox="0 0 900 650" class="w-full h-full" fill="none">
        <path d="M150 40 L110 230 L175 230 L80 520 L330 185 L240 185 L310 40Z" stroke="#f59e0b" stroke-width="1.5"/>
        <path d="M530 60 L492 225 L552 225 L465 480 L690 200 L610 200 L665 60Z" stroke="#f59e0b" stroke-width="1.5"/>
        <path d="M800 180 L775 290 L810 290 L755 420 L870 270 L830 270 L860 180Z" stroke="#fbbf24" stroke-width="1"/>
    </svg>
</div>

<div class="w-full max-w-md relative z-10 fadeup">

    {{-- Brand logo --}}
    <a href="{{ route('home') }}" class="flex items-center justify-center gap-3 mb-8 group">
        <div class="w-11 h-11 bg-amber-400 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform">
            <svg class="h-6 w-6 text-gray-900" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        </div>
        <span class="text-white font-black text-2xl tracking-tight">New<span class="text-amber-400">Electric</span></span>
    </a>

    @if($hasKey)
    {{-- ── CLERK SIGN-IN COMPONENT ── --}}
    <div id="clerk-mount" class="w-full min-h-[400px] flex items-center justify-center">
        {{-- Loading state --}}
        <div id="clerk-loading" class="flex flex-col items-center gap-3 text-gray-500">
            <svg class="h-7 w-7 animate-spin text-amber-400" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <span class="text-sm">Loading sign-in…</span>
        </div>
    </div>

    <p class="text-center text-xs text-gray-600 mt-5">
        <a href="{{ route('home') }}" class="hover:text-gray-400 transition-colors">← Continue shopping without signing in</a>
    </p>

    @else
    {{-- ── NO KEY CONFIGURED ── --}}
    <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-amber-500 via-yellow-300 to-amber-500"></div>
        <div class="p-8 text-center">
            <div class="w-16 h-16 bg-amber-400/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
            </div>
            <h2 class="text-white font-black text-xl mb-2">Configure Clerk Auth</h2>
            <p class="text-gray-400 text-sm leading-relaxed mb-6">
                Sign-in is powered by <span class="text-amber-400 font-semibold">Clerk</span>. Add your publishable key to enable it:
            </p>

            {{-- Step 1 --}}
            <div class="flex items-start gap-4 bg-gray-800/50 border border-gray-700 rounded-2xl p-4 text-left mb-3">
                <div class="w-7 h-7 bg-amber-400 rounded-full flex items-center justify-center shrink-0 text-gray-900 font-black text-xs mt-0.5">1</div>
                <div>
                    <div class="text-white font-bold text-sm mb-1">Get your free key</div>
                    <div class="text-gray-400 text-xs">Go to <span class="text-amber-400">dashboard.clerk.com</span> → Create app → API Keys → copy <em>Publishable key</em></div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="flex items-start gap-4 bg-gray-800/50 border border-gray-700 rounded-2xl p-4 text-left mb-3">
                <div class="w-7 h-7 bg-amber-400 rounded-full flex items-center justify-center shrink-0 text-gray-900 font-black text-xs mt-0.5">2</div>
                <div>
                    <div class="text-white font-bold text-sm mb-2">Add to <code class="text-amber-400 bg-gray-900 px-1.5 py-0.5 rounded text-xs">.env</code></div>
                    <div class="bg-gray-900 rounded-xl px-4 py-3 font-mono text-xs text-amber-300 text-left break-all">
                        CLERK_PUBLISHABLE_KEY=pk_test_<span class="text-gray-500">your_key_here</span>
                    </div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="flex items-start gap-4 bg-gray-800/50 border border-gray-700 rounded-2xl p-4 text-left mb-6">
                <div class="w-7 h-7 bg-amber-400 rounded-full flex items-center justify-center shrink-0 text-gray-900 font-black text-xs mt-0.5">3</div>
                <div>
                    <div class="text-white font-bold text-sm mb-1">Restart the server</div>
                    <div class="text-gray-400 text-xs font-mono bg-gray-900 rounded-lg px-3 py-2 mt-1">php artisan serve</div>
                </div>
            </div>

            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black px-6 py-3 rounded-2xl text-sm transition-colors">
                ← Back to Shop
            </a>
        </div>
    </div>
    @endif

</div>

@if($hasKey)
<script>
(async function() {
    const script = document.getElementById('clerk-script');
    const mount  = document.getElementById('clerk-mount');
    const loader = document.getElementById('clerk-loading');

    function hideLoader() {
        if (loader) loader.style.display = 'none';
    }

    async function waitForClerk(timeout = 8000) {
        if (window.Clerk) return true;
        return new Promise(resolve => {
            const t = setTimeout(() => resolve(false), timeout);
            script?.addEventListener('load', async () => {
                clearTimeout(t);
                await window.Clerk?.load?.();
                resolve(!!window.Clerk);
            });
        });
    }

    const ready = await waitForClerk();
    if (!ready || !mount) { hideLoader(); return; }

    await window.Clerk.load();

    // Already signed in → bridge and redirect
    if (window.Clerk.user) {
        hideLoader();
        await bridgeSession(window.Clerk.user);
        return;
    }

    hideLoader();
    window.Clerk.mountSignIn(mount, {
        afterSignInUrl:  '/__clerk-bridge',
        afterSignUpUrl:  '/__clerk-bridge',
        signUpUrl:       '/sign-in',
    });
})();

async function bridgeSession(user) {
    const email = user.primaryEmailAddress?.emailAddress ?? '';
    const csrf  = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    const res = await fetch('/auth/clerk-session', {
        method:  'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        body: JSON.stringify({
            clerk_user_id: user.id,
            email,
            name:      user.fullName ?? user.firstName ?? email,
            image_url: user.imageUrl ?? '',
        }),
    });
    if (res.ok) {
        const intended = '{{ session("intended", "/dashboard") }}';
        window.location.href = intended || '/dashboard';
    }
}

// Handle /__clerk-bridge redirect
if (window.location.pathname === '/__clerk-bridge') {
    (async () => {
        await window.Clerk?.load?.();
        if (window.Clerk?.user) await bridgeSession(window.Clerk.user);
        else window.location.href = '/sign-in';
    })();
}
</script>
@endif

</body>
</html>

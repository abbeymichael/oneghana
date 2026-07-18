<div>
    {{-- Auth card centered within layouts.app's <main> slot --}}
    <div class="flex-grow flex items-center justify-center py-xl px-container-margin relative overflow-hidden bg-background">
        {{-- Abstract background decoration --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-10 left-10 w-64 h-64 border-[1.5px] border-on-surface rotate-12"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 border-[1.5px] border-primary -rotate-6"></div>
        </div>

        {{-- Authentication Container --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 max-w-5xl w-full bg-surface border-[1.5px] border-on-surface shadow-none overflow-hidden">

            {{-- Left: Brand Imagery --}}
            <div class="hidden lg:flex flex-col justify-between p-xl bg-secondary-container relative">
                <div>
                    <h1 class="font-display-lg text-display-lg text-on-secondary-container mb-md leading-tight">
                        Verify Your<br><span class="text-primary">Email</span><br>Address.
                    </h1>
                    <p class="font-body-lg text-on-secondary-container max-w-sm">
                        Confirm your email to unlock all features and start managing your listings.
                    </p>
                </div>

                {{-- Benefits list --}}
                <div class="space-y-md my-lg">
                    @php
                        $perks = [
                            ['icon' => 'mark_email_read',  'text' => 'Receive customer enquiries directly'],
                            ['icon' => 'storefront',        'text' => 'Manage your business listings & products'],
                            ['icon' => 'bar_chart',         'text' => 'Access your merchant dashboard with analytics'],
                        ];
                    @endphp
                    @foreach($perks as $p)
                        <div class="flex items-start gap-sm">
                            <span class="material-symbols-outlined text-secondary text-[18px] mt-0.5" style="font-variation-settings: 'FILL' 1;">{{ $p['icon'] }}</span>
                            <p class="font-body-sm text-on-secondary-container">{{ $p['text'] }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Trust badge --}}
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    <span class="font-label-caps text-label-caps text-on-secondary-container">Trusted by 50,000+ Enterprises</span>
                </div>
            </div>

            {{-- Right: Verify Email Panel --}}
            <div class="p-lg md:p-xl flex flex-col justify-center bg-surface relative">
                <div class="mb-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-xs uppercase tracking-tight">Check Your Email</h2>
                    <p class="font-body-sm text-on-surface-variant">
                        We've sent a verification link to
                        <span class="font-semibold text-on-surface">{{ auth()->user()?->email ?? 'your email' }}</span>
                    </p>
                </div>

                {{-- Info card --}}
                <div class="p-sm bg-surface-container border-[1.5px] border-outline-variant flex items-start gap-sm mb-lg">
                    <span class="material-symbols-outlined text-outline text-[18px] mt-0.5" style="font-variation-settings: 'FILL' 1;">info</span>
                    <div>
                        <p class="font-label-caps text-label-caps text-on-surface">DIDN'T RECEIVE THE EMAIL?</p>
                        <p class="font-body-sm text-on-surface-variant mt-xs">Check your spam folder or click the button below to resend.</p>
                    </div>
                </div>

                {{-- Status Message --}}
                @if(session('status'))
                    <div class="mb-md p-sm bg-secondary-container border-l-4 border-secondary flex items-center gap-sm">
                        <span class="material-symbols-outlined text-secondary text-[18px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <p class="font-body-sm text-on-secondary-container font-semibold">{{ session('status') }}</p>
                    </div>
                @endif

                {{-- Resend Form --}}
                <form wire:submit="resend" class="space-y-md">
                    <button type="submit"
                            class="w-full bg-primary text-on-primary py-md font-label-caps text-label-caps uppercase tracking-widest pop-hover active:scale-95 transition-all duration-150 border-[1.5px] border-on-surface flex items-center justify-center gap-sm shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        <span>Resend Verification Email</span>
                        <span class="material-symbols-outlined text-[18px]">refresh</span>
                    </button>
                </form>

                {{-- Logout --}}
                <div class="mt-xl pt-lg border-t-[1.5px] border-outline-variant text-center">
                    <p class="font-body-sm text-on-surface-variant mb-sm">Wrong account?</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="inline-block w-full border-[1.5px] border-on-surface text-on-surface-variant py-md font-label-caps text-label-caps uppercase hover:bg-surface-container transition-all flex items-center justify-center gap-sm">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

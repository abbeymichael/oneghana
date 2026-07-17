<div>
    <div class="min-h-screen bg-[#fcf9f8] flex">
        {{-- Left: Brand Imagery --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-[#b90027] to-[#1c1b1b]">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 25% 25%, #f1c100 1px, transparent 1px), radial-gradient(circle at 75% 75%, #f1c100 1px, transparent 1px); background-size: 40px 40px;"></div>
            <div class="relative flex flex-col justify-center px-16 w-full">
                <div class="mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                        <div class="w-12 h-12 bg-[#f1c100] rounded-lg flex items-center justify-center">
                            <span class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GD</span>
                        </div>
                        <span class="text-3xl font-black text-white font-['Bricolage_Grotesque'] tracking-tight">GhanaDirect</span>
                    </a>
                </div>

                <h1 class="text-5xl font-black text-white font-['Bricolage_Grotesque'] leading-[1.1] tracking-tight mb-6">
                    Verify Your<br>Email Address
                </h1>

                <p class="text-xl text-white/80 font-['Inter'] leading-relaxed mb-8 max-w-md">
                    Please confirm your email to unlock all features and start managing your business listings.
                </p>

                <div class="max-w-md p-6 rounded-xl bg-white/10 backdrop-blur-sm">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#f1c100] text-lg mt-0.5">check_circle</span>
                            <p class="text-sm text-white/80 font-['Inter']">Receive customer enquiries directly</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#f1c100] text-lg mt-0.5">check_circle</span>
                            <p class="text-sm text-white/80 font-['Inter']">Manage your business listings and products</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#f1c100] text-lg mt-0.5">check_circle</span>
                            <p class="text-sm text-white/80 font-['Inter']">Access your merchant dashboard with analytics</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0 h-2"
                     style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);">
                </div>
            </div>
        </div>

        {{-- Right: Verify Email --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <div class="lg:hidden text-center mb-10">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-[#f1c100] rounded-lg flex items-center justify-center">
                            <span class="text-xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GD</span>
                        </div>
                        <span class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GhanaDirect</span>
                    </a>
                </div>

                <div class="bg-white rounded-xl p-8 pop-border-primary text-center">
                    <div class="w-16 h-16 rounded-full bg-[#f1c100]/10 flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-[#f1c100] text-3xl">mark_email_unread</span>
                    </div>

                    <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-2">Check your email</h2>
                    <p class="text-[#6b7280] font-['Inter'] mb-6">
                        We've sent a verification link to
                        <span class="font-semibold text-[#1c1b1b]">{{ auth()->user()?->email ?? 'your email' }}</span>
                    </p>

                    <div class="bg-[#fefce8] border border-[#f1c100]/30 rounded-lg p-4 mb-6 text-left">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#f1c100] text-lg mt-0.5">info</span>
                            <div>
                                <p class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Didn't receive the email?</p>
                                <p class="text-sm text-[#6b7280] font-['Inter'] mt-0.5">Check your spam folder or click the button below to resend.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    @if(session('status'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-[#316948] text-left">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#316948] text-lg">check_circle</span>
                                <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('status') }}</p>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="resend" class="space-y-4">
                        <button type="submit" class="w-full bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-6 rounded-lg hover:bg-[#9a0020] transition-all duration-200 flex items-center justify-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-1 active:translate-y-1 active:shadow-none">
                            <span>Resend Verification Email</span>
                            <span class="material-symbols-outlined text-lg">refresh</span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full text-[#6b7280] font-semibold font-['Inter'] py-3 px-6 rounded-lg border-2 border-[#d1d5db] hover:bg-gray-50 hover:text-[#b90027] transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">logout</span>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

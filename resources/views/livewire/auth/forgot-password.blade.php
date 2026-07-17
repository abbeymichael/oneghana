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
                    Reset Your<br>Password
                </h1>

                <p class="text-xl text-white/80 font-['Inter'] leading-relaxed mb-8 max-w-md">
                    No worries! Enter your email and we'll send you instructions to reset your password.
                </p>

                <div class="max-w-md p-6 rounded-xl bg-white/10 backdrop-blur-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-[#f1c100]/20 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[#f1c100] text-2xl">lock_reset</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-white font-['Inter']">Quick & Secure</h3>
                            <p class="text-sm text-white/70 font-['Inter']">We'll send a reset link to your registered email</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0 h-2"
                     style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);">
                </div>
            </div>
        </div>

        {{-- Right: Forgot Password Form --}}
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

                <div class="bg-white rounded-xl p-8 pop-border-primary">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#b90027]/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#b90027] text-xl">lock_reset</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Forgot password?</h2>
                            <p class="text-sm text-[#6b7280] font-['Inter']">We'll send you a reset link</p>
                        </div>
                    </div>

                    {{-- Status Message --}}
                    @if(session('status'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-[#316948]">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#316948] text-lg">check_circle</span>
                                <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('status') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-[#b90027]">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#b90027] text-lg">error</span>
                                <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="sendResetLink" class="space-y-6">
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">mail</span>
                                </div>
                                <input
                                    wire:model="email"
                                    type="email"
                                    id="email"
                                    placeholder="you@example.com"
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                    required
                                    autocomplete="email"
                                >
                            </div>
                            @error('email') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="w-full bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-6 rounded-lg hover:bg-[#9a0020] transition-all duration-200 flex items-center justify-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-1 active:translate-y-1 active:shadow-none">
                            <span>Send Reset Link</span>
                            <span class="material-symbols-outlined text-lg">send</span>
                        </button>
                    </form>

                    {{-- Back to Login --}}
                    <p class="mt-8 text-center text-sm text-[#6b7280] font-['Inter']">
                        Remember your password?
                        <a href="{{ route('login') }}" class="font-bold text-[#b90027] hover:text-[#9a0020] transition-colors">Back to sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

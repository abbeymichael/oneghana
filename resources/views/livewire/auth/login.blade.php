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
                    Powering the<br>Pulse of<br>Ghana
                </h1>

                <p class="text-xl text-white/80 font-['Inter'] leading-relaxed mb-12 max-w-md">
                    Discover, connect, and grow with Ghana's most comprehensive business directory platform.
                </p>

                {{-- Trust Indicators --}}
                <div class="grid grid-cols-3 gap-8 max-w-md">
                    @php
                        $stats = [
                            ['number' => '50,000+', 'label' => 'Enterprises'],
                            ['number' => '261', 'label' => 'Districts'],
                            ['number' => '16', 'label' => 'Regions'],
                        ];
                    @endphp
                    @foreach($stats as $stat)
                        <div class="text-center">
                            <div class="text-3xl font-black text-[#f1c100] font-['Bricolage_Grotesque']">{{ $stat['number'] }}</div>
                            <div class="text-sm text-white/70 font-['Inter'] mt-1">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Decorative Kente Strip --}}
                <div class="absolute bottom-0 left-0 right-0 h-2"
                     style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);">
                </div>
            </div>
        </div>

        {{-- Right: Login Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                {{-- Mobile Brand --}}
                <div class="lg:hidden text-center mb-10">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                        <div class="w-10 h-10 bg-[#f1c100] rounded-lg flex items-center justify-center">
                            <span class="text-xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GD</span>
                        </div>
                        <span class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GhanaDirect</span>
                    </a>
                </div>

                <div class="bg-white rounded-xl p-8 pop-border-primary">
                    <h2 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-2">Welcome back</h2>
                    <p class="text-[#6b7280] font-['Inter'] mb-8">Sign in to manage your business listings</p>

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-[#b90027]">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#b90027] text-lg">error</span>
                                <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="login" class="space-y-6">
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

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Password</label>
                            <div class="relative" x-data="{ show: false }">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">lock</span>
                                </div>
                                <input
                                    wire:model="password"
                                    :type="show ? 'text' : 'password'"
                                    id="password"
                                    placeholder="Enter your password"
                                    class="w-full pl-11 pr-12 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            @error('password') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Remember Me & Forgot Password --}}
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input
                                    wire:model="remember"
                                    type="checkbox"
                                    class="w-4 h-4 rounded border-2 border-[#d1d5db] text-[#b90027] focus:ring-[#b90027]/20"
                                >
                                <span class="text-sm text-[#6b7280] font-['Inter']">Remember me</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-[#b90027] hover:text-[#9a0020] transition-colors font-['Inter']">Forgot password?</a>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="w-full bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-6 rounded-lg hover:bg-[#9a0020] transition-all duration-200 flex items-center justify-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-1 active:translate-y-1 active:shadow-none">
                            <span>Sign In</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </form>

                    {{-- Social Login Divider --}}
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[#e5e7eb]"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-4 text-sm text-[#9ca3af] font-['Inter']">Or continue with</span>
                        </div>
                    </div>

                    {{-- Social Buttons --}}
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-semibold font-['Inter'] hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-8.5M22 7v10M12 2v20M17 12H3"/></svg>
                            <span>Google</span>
                        </button>
                        <button type="button" class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-semibold font-['Inter'] hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                            <span>OTP</span>
                        </button>
                    </div>

                    {{-- Register Link --}}
                    <p class="mt-8 text-center text-sm text-[#6b7280] font-['Inter']">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-bold text-[#b90027] hover:text-[#9a0020] transition-colors">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

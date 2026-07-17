<div>
    <div class="min-h-screen bg-[#fcf9f8] flex">
        {{-- Left: Brand Imagery --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-[#316948] to-[#1c1b1b]">
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
                    Join the<br>Marketplace<br>of Ghana
                </h1>

                <p class="text-xl text-white/80 font-['Inter'] leading-relaxed mb-12 max-w-md">
                    Create your account and connect with millions of customers across all 16 regions of Ghana.
                </p>

                {{-- Benefits List --}}
                <div class="space-y-5 max-w-md">
                    @php
                        $benefits = [
                            ['icon' => 'store', 'title' => 'List Your Business', 'desc' => 'Free listing with rich media, products, and services'],
                            ['icon' => 'public', 'title' => 'Reach More Customers', 'desc' => 'Get discovered by customers across Ghana'],
                            ['icon' => 'analytics', 'title' => 'Track Performance', 'desc' => 'Dashboard analytics and customer insights'],
                        ];
                    @endphp
                    @foreach($benefits as $b)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-white/15 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[#f1c100] text-xl">{{ $b['icon'] }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-white font-['Inter']">{{ $b['title'] }}</h3>
                                <p class="text-sm text-white/70 font-['Inter']">{{ $b['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Decorative Kente Strip --}}
                <div class="absolute bottom-0 left-0 right-0 h-2"
                     style="background: repeating-linear-gradient(90deg, #316948 0, #316948 20px, #f1c100 20px, #f1c100 40px, #b90027 40px, #b90027 60px, #1c1b1b 60px, #1c1b1b 80px);">
                </div>
            </div>
        </div>

        {{-- Right: Register Form --}}
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
                    <h2 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-2">Create account</h2>
                    <p class="text-[#6b7280] font-['Inter'] mb-8">Join Ghana's fastest growing business network</p>

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-[#b90027]">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#b90027] text-lg">error</span>
                                <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="register" class="space-y-5">
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">person</span>
                                </div>
                                <input
                                    wire:model="name"
                                    type="text"
                                    id="name"
                                    placeholder="Kwame Asante"
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                    required
                                    autocomplete="name"
                                >
                            </div>
                            @error('name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

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
                                    placeholder="Min. 8 characters"
                                    class="w-full pl-11 pr-12 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                    required
                                    autocomplete="new-password"
                                >
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            @error('password') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password Confirmation --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Confirm Password</label>
                            <div class="relative" x-data="{ show2: false }">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">lock</span>
                                </div>
                                <input
                                    wire:model="password_confirmation"
                                    :type="show2 ? 'text' : 'password'"
                                    id="password_confirmation"
                                    placeholder="Re-enter password"
                                    class="w-full pl-11 pr-12 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                    required
                                    autocomplete="new-password"
                                >
                                <button type="button" @click="show2 = !show2" class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl" x-text="show2 ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            @error('password_confirmation') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Terms (display only - not a Livewire prop) --}}
                        <div class="flex items-start gap-2">
                            <input
                                type="checkbox"
                                id="terms"
                                class="mt-0.5 w-4 h-4 rounded border-2 border-[#d1d5db] text-[#b90027] focus:ring-[#b90027]/20"
                                required
                            >
                            <label for="terms" class="text-sm text-[#6b7280] font-['Inter']">
                                I agree to the
                                <a href="#" class="font-semibold text-[#b90027] hover:text-[#9a0020]">Terms of Service</a>
                                and
                                <a href="#" class="font-semibold text-[#b90027] hover:text-[#9a0020]">Privacy Policy</a>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="w-full bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-6 rounded-lg hover:bg-[#9a0020] transition-all duration-200 flex items-center justify-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-1 active:translate-y-1 active:shadow-none">
                            <span>Create Account</span>
                            <span class="material-symbols-outlined text-lg">person_add</span>
                        </button>
                    </form>

                    {{-- Login Link --}}
                    <p class="mt-8 text-center text-sm text-[#6b7280] font-['Inter']">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold text-[#b90027] hover:text-[#9a0020] transition-colors">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

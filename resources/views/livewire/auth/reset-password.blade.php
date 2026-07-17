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
                    Choose a New<br>Password
                </h1>

                <p class="text-xl text-white/80 font-['Inter'] leading-relaxed mb-8 max-w-md">
                    Almost done! Pick a strong, unique password to secure your account.
                </p>

                <div class="max-w-md p-6 rounded-xl bg-white/10 backdrop-blur-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-[#f1c100]/20 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[#f1c100] text-2xl">enhanced_encryption</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-white font-['Inter']">Password Tips</h3>
                            <p class="text-sm text-white/70 font-['Inter']">Use at least 8 characters with a mix of letters, numbers & symbols</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0 h-2"
                     style="background: repeating-linear-gradient(90deg, #316948 0, #316948 20px, #f1c100 20px, #f1c100 40px, #b90027 40px, #b90027 60px, #1c1b1b 60px, #1c1b1b 80px);">
                </div>
            </div>
        </div>

        {{-- Right: Reset Password Form --}}
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
                        <div class="w-10 h-10 rounded-full bg-[#316948]/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#316948] text-xl">enhanced_encryption</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Set new password</h2>
                            <p class="text-sm text-[#6b7280] font-['Inter']">Choose a strong password for your account</p>
                        </div>
                    </div>

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-[#b90027]">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[#b90027] text-lg">error</span>
                                <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="resetPassword" class="space-y-5">
                        {{-- Hidden token --}}
                        <input type="hidden" wire:model="token" value="{{ $token }}">

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
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-gray-50 text-[#6b7280] font-['Inter'] cursor-not-allowed"
                                    readonly
                                    autocomplete="email"
                                >
                            </div>
                            @error('email') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">New Password</label>
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
                            <label for="password_confirmation" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Confirm New Password</label>
                            <div class="relative" x-data="{ show2: false }">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">lock</span>
                                </div>
                                <input
                                    wire:model="password_confirmation"
                                    :type="show2 ? 'text' : 'password'"
                                    id="password_confirmation"
                                    placeholder="Re-enter new password"
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

                        {{-- Submit --}}
                        <button type="submit" class="w-full bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-6 rounded-lg hover:bg-[#9a0020] transition-all duration-200 flex items-center justify-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-1 active:translate-y-1 active:shadow-none">
                            <span>Reset Password</span>
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                        </button>
                    </form>

                    {{-- Back to Login --}}
                    <p class="mt-8 text-center text-sm text-[#6b7280] font-['Inter']">
                        <a href="{{ route('login') }}" class="font-bold text-[#b90027] hover:text-[#9a0020] transition-colors inline-flex items-center gap-1">
                            <span class="material-symbols-outlined text-base">arrow_back</span>
                            Back to sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

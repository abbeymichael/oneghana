<div>
    {{-- Main page wrapper: centers the auth card in the page --}}
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
                        Powering the <br><span class="text-primary">Pulse</span> of Ghana.
                    </h1>
                    <p class="font-body-lg text-on-secondary-container max-w-sm">
                        Access thousands of verified local businesses or grow your own presence across the regions.
                    </p>
                </div>

                {{-- Market Image --}}
                <div class="relative h-56 w-full border-[1.5px] border-on-surface overflow-hidden group my-lg">
                    <div class="w-full h-full bg-surface-container-highest flex items-center justify-center">
                        <div class="text-center px-6">
                            <span class="material-symbols-outlined text-[60px] text-on-secondary-container/40" style="font-variation-settings: 'FILL' 1;">storefront</span>
                            <p class="font-label-caps text-label-caps text-on-secondary-container/60 mt-sm">ACCRA CENTRAL MARKET</p>
                        </div>
                    </div>
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                </div>

                {{-- Trust badge --}}
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    <span class="font-label-caps text-label-caps text-on-secondary-container">Trusted by 50,000+ Enterprises</span>
                </div>
            </div>

            {{-- Right: Login Form --}}
            <div class="p-lg md:p-xl flex flex-col justify-center bg-surface relative">
                <div class="mb-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-xs uppercase tracking-tight">Welcome Back</h2>
                    <p class="font-body-sm text-on-surface-variant">Sign in to manage your listings and bookmarks.</p>
                </div>

                {{-- Error --}}
                @if($errors->any())
                    <div class="mb-md p-sm bg-error-container border-l-4 border-error">
                        <p class="font-body-sm text-error font-semibold">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form wire:submit="login" class="space-y-md">
                    {{-- Email or Phone --}}
                    <div>
                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">EMAIL OR PHONE NUMBER</label>
                        <div class="relative">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">mail</span>
                            <input wire:model="email"
                                   type="text"
                                   autocomplete="username"
                                   required
                                   placeholder="e.g. kwame@direct.com.gh"
                                   class="w-full pl-xl pr-md py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                        </div>
                        @error('email') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex justify-between items-center mb-xs">
                            <label class="font-label-caps text-label-caps text-on-surface-variant">PASSWORD</label>
                            <a href="{{ route('password.request') }}" class="font-label-caps text-label-caps text-primary hover:underline transition-all">Forgot Password?</a>
                        </div>
                        <div class="relative" x-data="{ show: false }">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">lock</span>
                            <input wire:model="password"
                                   :type="show ? 'text' : 'password'"
                                   autocomplete="current-password"
                                   required
                                   placeholder="••••••••"
                                   class="w-full pl-xl pr-xl py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                            <button type="button" @click="show = !show" class="absolute right-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant hover:text-on-surface transition-colors" x-text="show ? 'visibility_off' : 'visibility'">visibility</button>
                        </div>
                        @error('password') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-sm">
                        <input wire:model="remember" id="remember" type="checkbox"
                               class="w-4 h-4 text-primary border-[1.5px] border-on-surface focus:ring-primary">
                        <label for="remember" class="font-body-sm text-on-surface-variant cursor-pointer">Keep me signed in</label>
                    </div>

                    {{-- Sign In CTA --}}
                    <button type="submit"
                            class="w-full bg-primary text-on-primary py-md font-label-caps text-label-caps uppercase tracking-widest pop-hover active:scale-95 transition-all duration-150 border-[1.5px] border-on-surface flex items-center justify-center gap-sm shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        <span>Sign In</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </form>

                {{-- Divider --}}
                <div class="relative my-lg">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-[1.5px] border-outline-variant"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-surface px-md font-label-caps text-label-caps text-outline-variant">OR CONTINUE WITH</span>
                    </div>
                </div>

                {{-- Social Buttons --}}
                <div class="grid grid-cols-2 gap-md">
                    <button type="button" class="flex items-center justify-center gap-sm p-sm border-[1.5px] border-on-surface hover:bg-surface-container transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="font-label-caps text-[10px]">GOOGLE</span>
                    </button>
                    <button type="button" class="flex items-center justify-center gap-sm p-sm border-[1.5px] border-on-surface hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                        <span class="font-label-caps text-[10px]">OTP</span>
                    </button>
                </div>

                {{-- Register Business CTA --}}
                <div class="mt-xl pt-lg border-t-[1.5px] border-outline-variant text-center">
                    <p class="font-body-sm text-on-surface-variant mb-sm">Are you a business owner?</p>
                    <a href="{{ route('business.register') }}"
                       class="inline-block w-full border-[1.5px] border-secondary text-secondary py-md font-label-caps text-label-caps uppercase hover:bg-secondary hover:text-on-secondary transition-all pop-hover shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        Register Business
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

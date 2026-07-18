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
                        Reset Your<br><span class="text-primary">Password</span>.
                    </h1>
                    <p class="font-body-lg text-on-secondary-container max-w-sm">
                        No worries — enter your email and we'll send you a secure reset link.
                    </p>
                </div>

                {{-- Icon panel --}}
                <div class="relative h-56 w-full border-[1.5px] border-on-surface overflow-hidden my-lg bg-surface-container-highest flex items-center justify-center">
                    <div class="text-center px-6">
                        <span class="material-symbols-outlined text-[60px] text-on-secondary-container/40" style="font-variation-settings: 'FILL' 1;">lock_reset</span>
                        <p class="font-label-caps text-label-caps text-on-secondary-container/60 mt-sm">QUICK & SECURE RECOVERY</p>
                    </div>
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                </div>

                {{-- Trust badge --}}
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">security</span>
                    <span class="font-label-caps text-label-caps text-on-secondary-container">Reset link expires in 60 minutes</span>
                </div>
            </div>

            {{-- Right: Forgot Password Form --}}
            <div class="p-lg md:p-xl flex flex-col justify-center bg-surface relative">
                <div class="mb-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-xs uppercase tracking-tight">Forgot Password?</h2>
                    <p class="font-body-sm text-on-surface-variant">We'll send you a reset link to your email.</p>
                </div>

                {{-- Status Message --}}
                @if(session('status'))
                    <div class="mb-md p-sm bg-secondary-container border-l-4 border-secondary flex items-center gap-sm">
                        <span class="material-symbols-outlined text-secondary text-[18px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <p class="font-body-sm text-on-secondary-container font-semibold">{{ session('status') }}</p>
                    </div>
                @endif

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-md p-sm bg-error-container border-l-4 border-error">
                        <p class="font-body-sm text-error font-semibold">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form wire:submit="sendResetLink" class="space-y-md">
                    {{-- Email --}}
                    <div>
                        <label for="email" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">EMAIL ADDRESS</label>
                        <div class="relative">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">mail</span>
                            <input wire:model="email"
                                   type="email"
                                   id="email"
                                   autocomplete="email"
                                   required
                                   placeholder="e.g. kwame@direct.com.gh"
                                   class="w-full pl-xl pr-md py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                        </div>
                        @error('email') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Send Reset Link CTA --}}
                    <button type="submit"
                            class="w-full bg-primary text-on-primary py-md font-label-caps text-label-caps uppercase tracking-widest pop-hover active:scale-95 transition-all duration-150 border-[1.5px] border-on-surface flex items-center justify-center gap-sm shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        <span>Send Reset Link</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>

                {{-- Back to Sign In --}}
                <div class="mt-xl pt-lg border-t-[1.5px] border-outline-variant text-center">
                    <p class="font-body-sm text-on-surface-variant mb-sm">Remember your password?</p>
                    <a href="{{ route('login') }}"
                       class="inline-block w-full border-[1.5px] border-secondary text-secondary py-md font-label-caps text-label-caps uppercase hover:bg-secondary hover:text-on-secondary transition-all pop-hover shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        Back to Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

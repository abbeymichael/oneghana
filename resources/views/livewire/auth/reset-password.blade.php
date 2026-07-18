<div>
    {{-- Auth card centered within layouts.app's <main> slot --}}
    <div class="flex-grow flex items-center justify-center py-xl px-container-margin relative overflow-hidden bg-background">
        {{-- Abstract background decoration --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-10 left-10 w-64 h-64 border-[1.5px] border-on-surface rotate-12"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 border-[1.5px] border-secondary -rotate-6"></div>
        </div>

        {{-- Authentication Container --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 max-w-5xl w-full bg-surface border-[1.5px] border-on-surface shadow-none overflow-hidden">

            {{-- Left: Brand Imagery --}}
            <div class="hidden lg:flex flex-col justify-between p-xl bg-secondary-container relative">
                <div>
                    <h1 class="font-display-lg text-display-lg text-on-secondary-container mb-md leading-tight">
                        Choose a New<br><span class="text-primary">Password</span>.
                    </h1>
                    <p class="font-body-lg text-on-secondary-container max-w-sm">
                        Almost done! Pick a strong, unique password to secure your account.
                    </p>
                </div>

                {{-- Icon panel --}}
                <div class="relative h-56 w-full border-[1.5px] border-on-surface overflow-hidden my-lg bg-surface-container-highest flex items-center justify-center">
                    <div class="text-center px-6">
                        <span class="material-symbols-outlined text-[60px] text-on-secondary-container/40" style="font-variation-settings: 'FILL' 1;">enhanced_encryption</span>
                        <p class="font-label-caps text-label-caps text-on-secondary-container/60 mt-sm">USE 8+ CHARACTERS WITH LETTERS & NUMBERS</p>
                    </div>
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                </div>

                {{-- Trust badge --}}
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    <span class="font-label-caps text-label-caps text-on-secondary-container">Your data is always protected</span>
                </div>
            </div>

            {{-- Right: Reset Password Form --}}
            <div class="p-lg md:p-xl flex flex-col justify-center bg-surface relative">
                <div class="mb-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-xs uppercase tracking-tight">Set New Password</h2>
                    <p class="font-body-sm text-on-surface-variant">Choose a strong password for your account.</p>
                </div>

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-md p-sm bg-error-container border-l-4 border-error">
                        <p class="font-body-sm text-error font-semibold">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form wire:submit="resetPassword" class="space-y-md">
                    {{-- Hidden token --}}
                    <input type="hidden" wire:model="token">

                    {{-- Email (readonly) --}}
                    <div>
                        <label for="email" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">EMAIL ADDRESS</label>
                        <div class="relative">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">mail</span>
                            <input wire:model="email"
                                   type="email"
                                   id="email"
                                   autocomplete="email"
                                   readonly
                                   class="w-full pl-xl pr-md py-md bg-surface-container border-[1.5px] border-on-surface font-body-md text-on-surface-variant cursor-not-allowed focus:outline-none">
                        </div>
                        @error('email') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">NEW PASSWORD</label>
                        <div class="relative" x-data="{ show: false }">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">lock</span>
                            <input wire:model="password"
                                   :type="show ? 'text' : 'password'"
                                   id="password"
                                   autocomplete="new-password"
                                   required
                                   placeholder="Min. 8 characters"
                                   class="w-full pl-xl pr-xl py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                            <button type="button" @click="show = !show"
                                    class="absolute right-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant hover:text-on-surface transition-colors"
                                    x-text="show ? 'visibility_off' : 'visibility'">visibility</button>
                        </div>
                        @error('password') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Confirm New Password --}}
                    <div>
                        <label for="password_confirmation" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">CONFIRM NEW PASSWORD</label>
                        <div class="relative" x-data="{ show2: false }">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">lock</span>
                            <input wire:model="password_confirmation"
                                   :type="show2 ? 'text' : 'password'"
                                   id="password_confirmation"
                                   autocomplete="new-password"
                                   required
                                   placeholder="Re-enter new password"
                                   class="w-full pl-xl pr-xl py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                            <button type="button" @click="show2 = !show2"
                                    class="absolute right-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant hover:text-on-surface transition-colors"
                                    x-text="show2 ? 'visibility_off' : 'visibility'">visibility</button>
                        </div>
                        @error('password_confirmation') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Reset Password CTA --}}
                    <button type="submit"
                            class="w-full bg-primary text-on-primary py-md font-label-caps text-label-caps uppercase tracking-widest pop-hover active:scale-95 transition-all duration-150 border-[1.5px] border-on-surface flex items-center justify-center gap-sm shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        <span>Reset Password</span>
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    </button>
                </form>

                {{-- Back to Sign In --}}
                <div class="mt-xl pt-lg border-t-[1.5px] border-outline-variant text-center">
                    <a href="{{ route('login') }}"
                       class="font-label-caps text-label-caps text-secondary hover:underline inline-flex items-center gap-xs transition-all">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Back to Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

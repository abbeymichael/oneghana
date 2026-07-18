<div>
    {{-- Auth card centered within layouts.app's <main> slot --}}
    <div class="flex-grow flex items-center justify-center py-xl px-container-margin relative overflow-hidden bg-background">
        {{-- Abstract background decoration --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-10 right-10 w-64 h-64 border-[1.5px] border-on-surface -rotate-12"></div>
            <div class="absolute bottom-20 left-10 w-96 h-96 border-[1.5px] border-secondary rotate-6"></div>
        </div>

        {{-- Authentication Container --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 max-w-5xl w-full bg-surface border-[1.5px] border-on-surface shadow-none overflow-hidden">

            {{-- Left: Brand Imagery --}}
            <div class="hidden lg:flex flex-col justify-between p-xl bg-secondary-container relative">
                <div>
                    <h1 class="font-display-lg text-display-lg text-on-secondary-container mb-md leading-tight">
                        Join the<br><span class="text-primary">Marketplace</span><br>of Ghana.
                    </h1>
                    <p class="font-body-lg text-on-secondary-container max-w-sm">
                        List your business and reach customers across all 16 regions.
                    </p>
                </div>

                {{-- Benefits --}}
                <div class="space-y-md my-lg">
                    @php
                        $benefits = [
                            ['icon' => 'storefront',  'title' => 'List Your Business',   'desc' => 'Free listing with rich media, products & services'],
                            ['icon' => 'public',       'title' => 'Reach More Customers', 'desc' => 'Get discovered by shoppers across Ghana'],
                            ['icon' => 'bar_chart',    'title' => 'Track Performance',    'desc' => 'Analytics dashboard & customer insights'],
                        ];
                    @endphp
                    @foreach($benefits as $b)
                        <div class="flex items-start gap-sm">
                            <div class="w-8 h-8 bg-secondary/20 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-secondary text-[18px]" style="font-variation-settings: 'FILL' 1;">{{ $b['icon'] }}</span>
                            </div>
                            <div>
                                <p class="font-label-caps text-label-caps text-on-secondary-container">{{ $b['title'] }}</p>
                                <p class="font-body-sm text-on-secondary-container/70">{{ $b['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Trust badge --}}
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    <span class="font-label-caps text-label-caps text-on-secondary-container">Trusted by 50,000+ Enterprises</span>
                </div>
            </div>

            {{-- Right: Register Form --}}
            <div class="p-lg md:p-xl flex flex-col justify-center bg-surface relative">
                <div class="mb-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-xs uppercase tracking-tight">Create Account</h2>
                    <p class="font-body-sm text-on-surface-variant">Join Ghana's fastest growing business directory.</p>
                </div>

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-md p-sm bg-error-container border-l-4 border-error">
                        <p class="font-body-sm text-error font-semibold">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form wire:submit="register" class="space-y-md">
                    {{-- Full Name --}}
                    <div>
                        <label for="name" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">FULL NAME</label>
                        <div class="relative">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">person</span>
                            <input wire:model="name"
                                   type="text"
                                   id="name"
                                   autocomplete="name"
                                   required
                                   placeholder="e.g. Kwame Asante"
                                   class="w-full pl-xl pr-md py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                        </div>
                        @error('name') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

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

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">PASSWORD</label>
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

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block font-label-caps text-label-caps text-on-surface-variant mb-xs">CONFIRM PASSWORD</label>
                        <div class="relative" x-data="{ show2: false }">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">lock</span>
                            <input wire:model="password_confirmation"
                                   :type="show2 ? 'text' : 'password'"
                                   id="password_confirmation"
                                   autocomplete="new-password"
                                   required
                                   placeholder="Re-enter password"
                                   class="w-full pl-xl pr-xl py-md bg-surface-container-lowest border-[1.5px] border-on-surface font-body-md placeholder:text-outline-variant transition-all focus:border-primary focus:outline-none">
                            <button type="button" @click="show2 = !show2"
                                    class="absolute right-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant hover:text-on-surface transition-colors"
                                    x-text="show2 ? 'visibility_off' : 'visibility'">visibility</button>
                        </div>
                        @error('password_confirmation') <p class="font-body-sm text-error mt-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Terms (HTML only, no wire:model) --}}
                    <div class="flex items-start gap-sm">
                        <input type="checkbox" id="terms" required
                               class="mt-0.5 w-4 h-4 border-[1.5px] border-on-surface text-primary focus:ring-primary">
                        <label for="terms" class="font-body-sm text-on-surface-variant cursor-pointer">
                            I agree to the
                            <a href="#" class="text-primary font-semibold hover:underline">Terms of Service</a>
                            and
                            <a href="#" class="text-primary font-semibold hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    {{-- Create Account CTA --}}
                    <button type="submit"
                            class="w-full bg-primary text-on-primary py-md font-label-caps text-label-caps uppercase tracking-widest pop-hover active:scale-95 transition-all duration-150 border-[1.5px] border-on-surface flex items-center justify-center gap-sm shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        <span>Create Account</span>
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                    </button>
                </form>

                {{-- Sign In link --}}
                <div class="mt-xl pt-lg border-t-[1.5px] border-outline-variant text-center">
                    <p class="font-body-sm text-on-surface-variant mb-sm">Already have an account?</p>
                    <a href="{{ route('login') }}"
                       class="inline-block w-full border-[1.5px] border-secondary text-secondary py-md font-label-caps text-label-caps uppercase hover:bg-secondary hover:text-on-secondary transition-all pop-hover shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

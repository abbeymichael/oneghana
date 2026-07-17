@php use Illuminate\Support\Str; @endphp
<div>
    <div class="min-h-screen bg-[#fcf9f8] py-8 px-4">
        <div class="max-w-5xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-6">
                    <div class="w-10 h-10 bg-[#f1c100] rounded-lg flex items-center justify-center">
                        <span class="text-xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GD</span>
                    </div>
                    <span class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GhanaDirect</span>
                </a>
                <h1 class="text-4xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">List Your Business</h1>
                <p class="text-lg text-[#6b7280] font-['Inter'] mt-2">Join Ghana's fastest growing business directory in just a few steps</p>
            </div>

            {{-- Step Indicator --}}
            <div class="max-w-3xl mx-auto mb-10">
                <div class="grid grid-cols-4 gap-xs border-b-[1.5px] border-[#e5e2e1]">
                    @php
                        $steps = [
                            1 => ['label' => 'Details', 'icon' => 'store'],
                            2 => ['label' => 'Location', 'icon' => 'location_on'],
                            3 => ['label' => 'Contact', 'icon' => 'call'],
                            4 => ['label' => 'Media', 'icon' => 'photo_library'],
                        ];
                    @endphp
                    @foreach($steps as $num => $stepInfo)
                        <div class="flex flex-col items-center py-md {{ $step === $num ? 'border-b-4 border-[#b90027] bg-[#f6f3f2]' : ($step > $num ? 'opacity-70' : 'opacity-50 grayscale') }}">
                            <span class="font-['JetBrains_Mono'] text-xs font-semibold tracking-wide text-[#6b7280]">Step 0{{ $num }}</span>
                            <span class="font-['Bricolage_Grotesque'] text-lg font-bold hidden md:block {{ $step === $num ? 'text-[#b90027]' : 'text-[#1c1b1b]' }}">{{ $stepInfo['label'] }}</span>
                            <span class="material-symbols-outlined md:hidden {{ $step === $num ? 'text-[#b90027]' : '' }}">{{ $stepInfo['icon'] }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Progress Bar --}}
                <div class="mt-4 bg-[#e5e7eb] rounded-full h-2 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-[#b90027] to-[#316948] rounded-full transition-all duration-500 ease-out" style="width: {{ ($step / 4) * 100 }}%"></div>
                </div>
                <p class="text-sm text-[#6b7280] font-['Inter'] mt-2 text-center">Step {{ $step }} of 4 — {{ $steps[$step]['label'] }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Form --}}
                <div class="lg:col-span-2">
                    <form wire:submit="{{ $step < 4 ? 'nextStep' : 'submit' }}">
                        <div class="bg-white rounded-xl p-8 border-[1.5px] border-[#1c1b1b] market-shadow kente-border">
                            {{-- Error Summary --}}
                            @if($errors->any())
                                <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-[#b90027]">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[#b90027] text-lg">error</span>
                                        <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ $errors->first() }}</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Step 1: Details --}}
                            @if($step === 1)
                                <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-6 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[#b90027]" style="font-variation-settings: 'FILL' 1;">store</span>
                                    Business Details
                                </h2>
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Business Name <span class="text-[#b90027]">*</span></label>
                                        <input
                                            type="text"
                                            wire:model="name"
                                            placeholder="e.g., Mama's Catering Services"
                                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                        >
                                        @error('name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Description <span class="text-[#b90027]">*</span></label>
                                        <textarea
                                            wire:model="description"
                                            rows="5"
                                            placeholder="Describe your business, products, and services (at least 20 characters)"
                                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200 resize-none"
                                        ></textarea>
                                        @error('description') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Category <span class="text-[#b90027]">*</span></label>
                                        <select
                                            wire:model="category_id"
                                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                        >
                                            <option value="">Select a category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @foreach($cat->children as $child)
                                                    <option value="{{ $child->id }}">&nbsp;&nbsp;— {{ $child->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('category_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            @endif

                            {{-- Step 2: Location --}}
                            @if($step === 2)
                                <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-6 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[#b90027]" style="font-variation-settings: 'FILL' 1;">location_on</span>
                                    Business Location
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">GhanaPost GPS Address</label>
                                        <div class="relative">
                                            <input
                                                type="text"
                                                wire:model="ghanapost_gps"
                                                placeholder="e.g., GA-123-4567"
                                                class="w-full pr-12 px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] uppercase placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                            >
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                                                <span class="material-symbols-outlined text-[#316948] text-xl">verified</span>
                                            </div>
                                        </div>
                                        <p class="text-xs text-[#6b7280] font-['Inter'] mt-1 italic">Find your unique digital address using the GhanaPost GPS app</p>
                                        @error('ghanapost_gps') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Region <span class="text-[#b90027]">*</span></label>
                                        <select
                                            wire:model.change="region_id"
                                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                        >
                                            <option value="">Select a region</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">District <span class="text-[#b90027]">*</span></label>
                                        <select
                                            wire:model="district_id"
                                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                        >
                                            <option value="">Select a district</option>
                                            @if($selectedRegion)
                                                @foreach($selectedRegion->districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('district_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Street Address / Landmark <span class="text-[#b90027]">*</span></label>
                                        <input
                                            type="text"
                                            wire:model="address_text"
                                            placeholder="e.g., 23 Oxford Street, Osu, Accra"
                                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                        >
                                        @error('address_text') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                {{-- Map Preview Placeholder --}}
                                <div class="mt-5 rounded-lg border-2 border-[#d1d5db] bg-[#fcf9f8] h-48 flex items-center justify-center">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-4xl text-[#9ca3af]" style="font-variation-settings: 'FILL' 1;">location_on</span>
                                        <p class="text-sm text-[#6b7280] font-['Inter'] mt-2">Map preview</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Step 3: Contact --}}
                            @if($step === 3)
                                <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-6 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[#b90027]" style="font-variation-settings: 'FILL' 1;">contact_phone</span>
                                    Contact Information
                                </h2>
                                <div class="space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Phone Number <span class="text-[#b90027]">*</span></label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">call</span>
                                                </div>
                                                <input type="text" wire:model="phone" placeholder="+233 XX XXX XXXX" class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200">
                                            </div>
                                            @error('phone') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">WhatsApp Number</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">chat</span>
                                                </div>
                                                <input type="text" wire:model="whatsapp_number" placeholder="+233 XX XXX XXXX" class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200">
                                            </div>
                                            @error('whatsapp_number') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Business Email</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">mail</span>
                                                </div>
                                                <input type="email" wire:model="email" placeholder="business@example.com" class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200">
                                            </div>
                                            @error('email') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Website</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">language</span>
                                                </div>
                                                <input type="url" wire:model="website" placeholder="https://example.com" class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200">
                                            </div>
                                            @error('website') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    {{-- Mobile Money --}}
                                    <div class="p-5 rounded-lg bg-[#fcf9f8] border border-[#d1d5db]">
                                        <h3 class="font-bold text-[#1c1b1b] font-['Inter'] mb-4 flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[#f1c100] text-xl">payments</span>
                                            Mobile Money Payments
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-xs font-bold text-[#745b00] font-['JetBrains_Mono'] mb-1.5 uppercase tracking-wider">MTN MoMo</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="material-symbols-outlined text-[#f1c100] text-base">sim_card</span>
                                                    </div>
                                                    <input type="text" wire:model="momo_mtn" placeholder="+233 XX XXX XXXX" class="w-full pl-9 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] text-sm placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all">
                                                </div>
                                                @error('momo_mtn') <p class="mt-1 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-[#b90027] font-['JetBrains_Mono'] mb-1.5 uppercase tracking-wider">Telecel Cash</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="material-symbols-outlined text-[#b90027] text-base">sim_card</span>
                                                    </div>
                                                    <input type="text" wire:model="momo_vodafone" placeholder="+233 XX XXX XXXX" class="w-full pl-9 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] text-sm placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all">
                                                </div>
                                                @error('momo_vodafone') <p class="mt-1 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-[#316948] font-['JetBrains_Mono'] mb-1.5 uppercase tracking-wider">AirtelTigo Money</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="material-symbols-outlined text-[#316948] text-base">sim_card</span>
                                                    </div>
                                                    <input type="text" wire:model="momo_airteltigo" placeholder="+233 XX XXX XXXX" class="w-full pl-9 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] text-sm placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all">
                                                </div>
                                                @error('momo_airteltigo') <p class="mt-1 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Step 4: Media --}}
                            @if($step === 4)
                                <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-6 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[#b90027]" style="font-variation-settings: 'FILL' 1;">photo_library</span>
                                    Photos & Media
                                </h2>
                                <div class="space-y-6">
                                    {{-- Logo Upload --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Business Logo</label>
                                        <div class="relative border-2 border-dashed border-[#d1d5db] rounded-lg p-8 text-center hover:border-[#b90027] transition-colors cursor-pointer bg-[#fcf9f8]/50">
                                            <input type="file" wire:model="logo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="material-symbols-outlined text-4xl text-[#9ca3af]">add_a_photo</span>
                                                <p class="text-sm text-[#6b7280] font-['Inter']"><span class="font-semibold text-[#b90027]">Upload logo</span> — PNG, JPG up to 2MB</p>
                                            </div>
                                        </div>
                                        @if($logo)
                                            <div class="mt-3 w-20 h-20 rounded-lg overflow-hidden border-2 border-[#d1d5db]">
                                                <img src="{{ $logo->temporaryUrl() }}" alt="Logo preview" class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                        @error('logo') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Gallery Upload --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Gallery Images (up to 10)</label>
                                        <div class="relative border-2 border-dashed border-[#d1d5db] rounded-lg p-8 text-center hover:border-[#b90027] transition-colors cursor-pointer bg-[#fcf9f8]/50">
                                            <input type="file" wire:model="gallery" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="material-symbols-outlined text-4xl text-[#9ca3af]">add_photo_alternate</span>
                                                <p class="text-sm text-[#6b7280] font-['Inter']"><span class="font-semibold text-[#b90027]">Click to upload photos</span> or drag and drop</p>
                                                <p class="text-xs text-[#9ca3af] font-['Inter']">PNG, JPG up to 5MB each</p>
                                            </div>
                                        </div>
                                        @if($gallery)
                                            <div class="flex gap-2 mt-3 flex-wrap">
                                                @foreach($gallery as $img)
                                                    <div class="relative w-20 h-20 rounded-lg overflow-hidden border-2 border-[#d1d5db]">
                                                        <img src="{{ $img->temporaryUrl() }}" alt="Upload preview" class="w-full h-full object-cover">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @error('gallery.*') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Agreement Notice --}}
                                    <div class="p-4 rounded-lg bg-[#fefce8] border border-[#f1c100]/30">
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-[#f1c100] text-lg mt-0.5" style="font-variation-settings: 'FILL' 1;">info</span>
                                            <div>
                                                <p class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Almost done!</p>
                                                <p class="text-xs text-[#6b7280] font-['Inter'] mt-0.5">By submitting, you agree that your business listing will be published and visible to everyone on GhanaDirect.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Navigation Buttons --}}
                            <div class="flex items-center justify-between mt-8 pt-6 border-t border-[#e5e7eb]">
                                <div>
                                    @if($step > 1)
                                        <button type="button" wire:click="previousStep" class="px-6 py-3 rounded-lg border-2 border-[#d1d5db] text-[#1c1b1b] font-bold font-['Inter'] hover:bg-gray-50 transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-lg">arrow_back</span>
                                            <span>Back</span>
                                        </button>
                                    @endif
                                </div>
                                <div>
                                    <button type="submit" class="{{ $step < 4 ? 'bg-[#b90027]' : 'bg-[#316948]' }} text-white font-bold font-['Inter'] py-3 px-8 rounded-lg hover:opacity-90 transition-all duration-200 flex items-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none">
                                        @if($step < 4)
                                            <span>Continue</span>
                                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                                        @else
                                            <span>Submit Listing</span>
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Sidebar Tips --}}
                <div class="lg:col-span-1">
                    {{-- Map/Location Preview --}}
                    @if($step === 2)
                        <div class="bg-white rounded-xl overflow-hidden border-[1.5px] border-[#1c1b1b] market-shadow mb-6">
                            <div class="h-48 bg-[#e5e2e1] flex items-center justify-center relative">
                                <span class="material-symbols-outlined text-[48px] text-[#b90027]" style="font-variation-settings: 'FILL' 1;">location_on</span>
                                <div class="absolute bottom-0 left-0 right-0 p-3 bg-[#e5e2e1]">
                                    <p class="font-bold text-[#1c1b1b] font-['JetBrains_Mono'] text-xs">LOCATION VERIFICATION</p>
                                    <p class="text-xs text-[#6b7280] font-['Inter']">Accurate location helps customers find you</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Help Tip Box --}}
                    <div class="bg-[#FFF9E6] border border-dashed border-[#916e6d] rounded-xl p-5 relative mb-6">
                        <span class="absolute top-3 right-3 text-xs font-bold text-[#745b00] font-['JetBrains_Mono'] tracking-wider">HELPFUL TIP</span>
                        <div class="mt-4">
                            @if($step === 1)
                                <h4 class="font-bold text-[#745b00] font-['Bricolage_Grotesque'] text-lg mb-2">Writing a great description</h4>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Tell customers what makes your business unique. Include what you sell, your specialities, and your experience.</p>
                            @elseif($step === 2)
                                <h4 class="font-bold text-[#745b00] font-['Bricolage_Grotesque'] text-lg mb-2">Can't find your GPS code?</h4>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Walk to the entrance of your business, open the GhanaPost GPS app, and click the "Generate Address" button.</p>
                            @elseif($step === 3)
                                <h4 class="font-bold text-[#745b00] font-['Bricolage_Grotesque'] text-lg mb-2">Why add Mobile Money?</h4>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Businesses that accept Mobile Money receive 40% more customer enquiries on average.</p>
                            @else
                                <h4 class="font-bold text-[#745b00] font-['Bricolage_Grotesque'] text-lg mb-2">Photo tips</h4>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Businesses with photos receive 60% more profile views. Include your logo and clear images of your products or premises.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Progress Meter --}}
                    <div class="bg-white rounded-xl p-5 border-[1.5px] border-[#1c1b1b] market-shadow">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-bold text-[#1c1b1b] font-['JetBrains_Mono'] text-xs tracking-wider uppercase">Completion</span>
                            <span class="font-bold text-[#b90027] font-['JetBrains_Mono'] text-sm">{{ ($step / 4) * 100 }}%</span>
                        </div>
                        <div class="bg-[#e5e2e1] rounded-full h-2 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-[#b90027] to-[#316948] rounded-full transition-all duration-500" style="width: {{ ($step / 4) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

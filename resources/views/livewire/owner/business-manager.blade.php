<div class="min-h-screen bg-[#fcf9f8]">
    {{-- Kente Header Strip --}}
    <div class="h-1.5 w-full" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Back + Breadcrumb --}}
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#6b7280] font-['Inter'] hover:text-[#b90027] transition-colors group">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                Dashboard
            </a>
            <span class="text-[#d1d5db]">/</span>
            <span class="text-sm text-[#1c1b1b] font-semibold font-['Inter'] truncate">{{ $business->name }}</span>
        </div>

        {{-- Page Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-lg bg-[#316948] flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-xl">edit_square</span>
                </div>
                <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#316948] bg-[#f0fdf4] px-3 py-1 rounded-full border border-[#316948]/20">Edit Storefront</span>
            </div>
            <h1 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">{{ $business->name }}</h1>
            <p class="text-[#6b7280] font-['Inter'] mt-1">Update your business profile to attract more customers across Ghana</p>
        </div>

        {{-- Flash Message --}}
        @if(session()->has('message'))
            <div class="mb-6 p-4 rounded-xl bg-[#f0fdf4] border-[1.5px] border-[#316948] flex items-center gap-3 shadow-[3px_3px_0px_#316948]">
                <span class="material-symbols-outlined text-[#316948] text-xl flex-shrink-0">check_circle</span>
                <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('message') }}</p>
            </div>
        @endif

        {{-- Error Summary --}}
        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-[#fef2f4] border-[1.5px] border-[#b90027] flex items-start gap-3 shadow-[3px_3px_0px_#b90027]">
                <span class="material-symbols-outlined text-[#b90027] text-xl flex-shrink-0 mt-0.5">error</span>
                <div>
                    <p class="text-sm font-bold text-[#b90027] font-['Inter'] mb-1">Please fix the following errors:</p>
                    <ul class="text-sm text-[#b90027] font-['Inter'] space-y-0.5 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form wire:submit="save">
            {{-- ─── SECTION 1: Core Info ─────────────────────────────────────── --}}
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] mb-6 overflow-hidden">
                <div class="bg-[#1c1b1b] px-6 py-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#f1c100] text-xl">info</span>
                    <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">Business Information</h2>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Name + Category --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Business Name <span class="text-[#b90027]">*</span>
                            </label>
                            <input
                                wire:model="name"
                                type="text"
                                placeholder="e.g. Mensah Textiles Ltd."
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                            >
                            @error('name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Category <span class="text-[#b90027]">*</span>
                            </label>
                            <select
                                wire:model="category_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                            >
                                <option value="">Select category...</option>
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

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                            Description <span class="text-[#b90027]">*</span>
                            <span class="ml-2 text-xs font-normal text-[#9ca3af]">Min. 20 characters</span>
                        </label>
                        <textarea
                            wire:model="description"
                            rows="5"
                            placeholder="Describe your business, products, and services. What makes you unique?"
                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200 resize-none"
                        ></textarea>
                        <div class="flex justify-between mt-1.5">
                            @error('description') <p class="text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                            <p class="text-xs text-[#9ca3af] font-['Inter'] ml-auto">{{ strlen($description) }}/10000</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 2: Location ──────────────────────────────────────── --}}
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#316948] mb-6 overflow-hidden">
                <div class="bg-[#316948] px-6 py-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-white text-xl">location_on</span>
                    <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">Location & Address</h2>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Region + District --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Region</label>
                            <select
                                wire:model.change="region_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all duration-200"
                            >
                                <option value="">Select region...</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            @error('region_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">District</label>
                            <select
                                wire:model="district_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all duration-200 {{ !$selectedRegion ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ !$selectedRegion ? 'disabled' : '' }}
                            >
                                <option value="">{{ $selectedRegion ? 'Select district...' : 'Select region first' }}</option>
                                @if($selectedRegion)
                                    @foreach($selectedRegion->districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('district_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Address --}}
                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Street Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-[#9ca3af] text-xl">pin_drop</span>
                            </div>
                            <input
                                wire:model="address_text"
                                type="text"
                                placeholder="e.g. Accra Central Market, Block B-12"
                                class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all duration-200"
                            >
                        </div>
                        @error('address_text') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                    </div>

                    {{-- GhanaPost GPS --}}
                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                            GhanaPost GPS Code
                            <span class="ml-2 text-xs font-normal text-[#9ca3af]">e.g. GA-123-4567</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-[#745b00] text-xl">gps_fixed</span>
                            </div>
                            <input
                                wire:model="ghanapost_gps"
                                type="text"
                                placeholder="GA-000-0000"
                                class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] font-['JetBrains_Mono'] placeholder:text-[#9ca3af] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all duration-200 uppercase"
                            >
                        </div>
                        @error('ghanapost_gps') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        <p class="mt-1.5 text-xs text-[#9ca3af] font-['Inter']">Find your GPS code at <a href="https://ghanapostgps.com" target="_blank" class="text-[#745b00] hover:underline font-semibold">ghanapostgps.com</a></p>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 3: Contact ───────────────────────────────────────── --}}
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] mb-6 overflow-hidden">
                <div class="bg-[#1c1b1b] px-6 py-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#f1c100] text-xl">contacts</span>
                    <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">Contact Details</h2>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Phone --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">call</span>
                                </div>
                                <input
                                    wire:model="phone"
                                    type="tel"
                                    placeholder="+233 XX XXX XXXX"
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                >
                            </div>
                            @error('phone') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                WhatsApp Number
                                <span class="text-xs font-normal text-[#316948] ml-1">— generates wa.me link</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#316948]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <input
                                    wire:model="whatsapp_number"
                                    type="tel"
                                    placeholder="+233 XX XXX XXXX"
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all duration-200"
                                >
                            </div>
                            @error('whatsapp_number') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Business Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">mail</span>
                                </div>
                                <input
                                    wire:model="email"
                                    type="email"
                                    placeholder="info@yourbusiness.com"
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                >
                            </div>
                            @error('email') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Website --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Website</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">language</span>
                                </div>
                                <input
                                    wire:model="website"
                                    type="url"
                                    placeholder="https://yourbusiness.com"
                                    class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                                >
                            </div>
                            @error('website') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 4: Mobile Money ──────────────────────────────────── --}}
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#745b00] mb-6 overflow-hidden">
                <div class="bg-[#745b00] px-6 py-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#f1c100] text-xl">payment</span>
                    <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">Mobile Money Numbers</h2>
                    <span class="ml-auto text-[10px] font-bold font-['JetBrains_Mono'] bg-[#f1c100]/20 text-[#f1c100] px-2 py-0.5 rounded">OPTIONAL</span>
                </div>
                <div class="p-6">
                    <p class="text-sm text-[#6b7280] font-['Inter'] mb-5">Add your MoMo numbers to enable direct payments from customers.</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        {{-- MTN MoMo --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#745b00] font-['Inter'] mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-5 h-5 rounded-full bg-[#f1c100] flex items-center justify-center text-[10px] font-black text-[#1c1b1b]">M</span>
                                    MTN MoMo
                                </span>
                            </label>
                            <input
                                wire:model="momo_mtn"
                                type="tel"
                                placeholder="+233 24 XXX XXXX"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#f1c100]/50 bg-[#fefce8] text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all duration-200"
                            >
                            @error('momo_mtn') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- Vodafone/Telecel --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#b90027] font-['Inter'] mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-5 h-5 rounded-full bg-[#b90027] flex items-center justify-center text-[10px] font-black text-white">V</span>
                                    Vodafone/Telecel Cash
                                </span>
                            </label>
                            <input
                                wire:model="momo_vodafone"
                                type="tel"
                                placeholder="+233 20 XXX XXXX"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#b90027]/20 bg-[#fef2f4] text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                            >
                            @error('momo_vodafone') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        {{-- AirtelTigo --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#316948] font-['Inter'] mb-1.5">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-5 h-5 rounded-full bg-[#316948] flex items-center justify-center text-[10px] font-black text-white">A</span>
                                    AirtelTigo Money
                                </span>
                            </label>
                            <input
                                wire:model="momo_airteltigo"
                                type="tel"
                                placeholder="+233 27 XXX XXXX"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#316948]/20 bg-[#f0fdf4] text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all duration-200"
                            >
                            @error('momo_airteltigo') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── SECTION 5: Logo ─────────────────────────────────────────── --}}
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] mb-8 overflow-hidden">
                <div class="bg-[#1c1b1b] px-6 py-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#f1c100] text-xl">add_photo_alternate</span>
                    <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">Business Logo</h2>
                    <span class="ml-auto text-[10px] font-bold font-['JetBrains_Mono'] bg-white/10 text-[#9ca3af] px-2 py-0.5 rounded">OPTIONAL — MAX 2MB</span>
                </div>
                <div class="p-6">
                    {{-- Current Logo --}}
                    @if($business->getFirstMediaUrl('logo'))
                        <div class="flex items-center gap-5 mb-5 p-4 bg-[#f6f3f2] rounded-xl border border-[#e5e2e1]">
                            <img src="{{ $business->getFirstMediaUrl('logo') }}"
                                 alt="Current logo"
                                 class="w-20 h-20 object-cover rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b]">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-[#1c1b1b] font-['Inter'] mb-1">Current Logo</p>
                                <label class="inline-flex items-center gap-2 cursor-pointer group">
                                    <div class="relative">
                                        <input
                                            wire:model="removeLogo"
                                            type="checkbox"
                                            class="w-4 h-4 rounded border-2 border-[#d1d5db] text-[#b90027] focus:ring-[#b90027]/20"
                                        >
                                    </div>
                                    <span class="text-sm font-semibold text-[#b90027] font-['Inter'] group-hover:underline">Remove current logo</span>
                                </label>
                            </div>
                        </div>
                    @endif

                    {{-- Upload New --}}
                    <div class="relative">
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-2">
                            {{ $business->getFirstMediaUrl('logo') ? 'Upload Replacement' : 'Upload Logo' }}
                        </label>
                        <div class="border-2 border-dashed border-[#d1d5db] rounded-xl p-8 text-center hover:border-[#b90027] transition-colors cursor-pointer bg-[#fcf9f8] group">
                            <input
                                wire:model="logo"
                                type="file"
                                accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            >
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 rounded-xl bg-[#f6f3f2] flex items-center justify-center group-hover:bg-[#fef2f4] transition-colors">
                                    <span class="material-symbols-outlined text-2xl text-[#9ca3af] group-hover:text-[#b90027] transition-colors">upload</span>
                                </div>
                                <p class="text-sm text-[#6b7280] font-['Inter']">
                                    <span class="font-semibold text-[#b90027]">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-[#9ca3af] font-['Inter']">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Preview New Logo --}}
                    @if($logo)
                        <div class="mt-4 flex items-center gap-3 p-3 bg-[#f0fdf4] rounded-lg border border-[#316948]/20">
                            <img src="{{ $logo->temporaryUrl() }}"
                                 alt="New logo preview"
                                 class="w-16 h-16 object-cover rounded-lg border-[1.5px] border-[#316948]">
                            <div>
                                <p class="text-sm font-bold text-[#316948] font-['Inter']">New logo ready to save</p>
                                <p class="text-xs text-[#6b7280] font-['Inter']">Click "Save Changes" to apply</p>
                            </div>
                        </div>
                    @endif
                    @error('logo') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- ─── Save Button ──────────────────────────────────────────────── --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-8">
                <a href="{{ route('dashboard') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] font-semibold font-['Inter'] hover:bg-[#f6f3f2] hover:text-[#1c1b1b] transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                    Cancel
                </a>
                <button
                    type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-8 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none"
                >
                    <span class="material-symbols-outlined text-xl">save</span>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

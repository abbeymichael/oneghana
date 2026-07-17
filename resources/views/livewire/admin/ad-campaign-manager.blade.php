@php use App\Models\AdCampaign; @endphp
<div class="min-h-screen bg-[#fcf9f8]">
    {{-- Kente Header Strip --}}
    <div class="h-1.5 w-full" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Back + Header --}}
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#6b7280] font-['Inter'] hover:text-[#b90027] transition-colors group">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                Dashboard
            </a>
            <span class="text-[#d1d5db]">/</span>
            <span class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Ad Campaigns</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-[#1c1b1b] flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#f1c100] text-xl">campaign</span>
                    </div>
                    <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#1c1b1b] bg-[#f6f3f2] px-3 py-1 rounded-full border border-[#1c1b1b]/20">Admin</span>
                </div>
                <h1 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Ad Campaign Manager</h1>
                <p class="text-[#6b7280] font-['Inter'] mt-1">Direct-sold campaigns with zone assignment and creative management</p>
            </div>
            @if(!$showForm)
                <button wire:click="create"
                        class="inline-flex items-center gap-2 bg-[#1c1b1b] text-white font-bold font-['Inter'] py-3 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#f1c100] hover:shadow-[6px_6px_0px_#b90027] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    New Campaign
                </button>
            @endif
        </div>

        {{-- Flash Messages --}}
        @if(session('message'))
            <div class="mb-6 p-4 rounded-xl bg-[#f0fdf4] border-[1.5px] border-[#316948] flex items-center gap-3 shadow-[3px_3px_0px_#316948]">
                <span class="material-symbols-outlined text-[#316948] text-xl">check_circle</span>
                <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('message') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-[#fef2f4] border-[1.5px] border-[#b90027] flex items-center gap-3 shadow-[3px_3px_0px_#b90027]">
                <span class="material-symbols-outlined text-[#b90027] text-xl">error</span>
                <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ session('error') }}</p>
            </div>
        @endif

        {{-- ─── Form ────────────────────────────────────────────────────── --}}
        @if($showForm)
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#f1c100] mb-6 overflow-hidden">
                <div class="bg-[#1c1b1b] px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#f1c100] text-xl">{{ $editingCampaignId ? 'edit' : 'add_circle' }}</span>
                        <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">{{ $editingCampaignId ? 'Edit Campaign' : 'New Campaign' }}</h2>
                    </div>
                    <button type="button" wire:click="$set('showForm', false)" class="text-white/70 hover:text-white">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form wire:submit="save" class="p-6 space-y-5">
                    @if($errors->any())
                        <div class="p-3 rounded-lg bg-[#fef2f4] border border-[#b90027]/30">
                            <ul class="text-sm text-[#b90027] font-['Inter'] space-y-0.5 list-disc list-inside">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Ad Zone <span class="text-[#b90027]">*</span></label>
                            <select wire:model="ad_zone_id"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all">
                                <option value="">Select zone...</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }} ({{ $zone->key }})</option>
                                @endforeach
                            </select>
                            @error('ad_zone_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Advertiser Name <span class="text-[#b90027]">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-xl">business</span>
                                </div>
                                <input wire:model="advertiser_name" type="text" placeholder="Company / Advertiser name"
                                       class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#1c1b1b] focus:ring-2 focus:ring-[#1c1b1b]/10 outline-none transition-all">
                            </div>
                            @error('advertiser_name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Link URL <span class="text-[#b90027]">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-[#9ca3af] text-xl">link</span>
                            </div>
                            <input wire:model="link_url" type="url" placeholder="https://advertiser-website.com"
                                   class="w-full pl-11 pr-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#1c1b1b] focus:ring-2 focus:ring-[#1c1b1b]/10 outline-none transition-all">
                        </div>
                        @error('link_url') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                    </div>

                    {{-- Creative Upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                            Creative Image <span class="text-xs font-normal text-[#9ca3af]">banner/display ad graphic</span>
                        </label>
                        <div class="relative border-2 border-dashed border-[#745b00]/40 rounded-xl p-6 text-center hover:border-[#745b00] transition-colors cursor-pointer group bg-[#FFF9E6]">
                            <input wire:model="creative" type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            @if($creative)
                                <img src="{{ $creative->temporaryUrl() }}" alt="Creative preview" class="max-h-24 rounded-lg border-[1.5px] border-[#745b00] mx-auto mb-2">
                                <p class="text-xs text-[#745b00] font-semibold font-['Inter']">Creative ready to upload</p>
                            @else
                                <span class="material-symbols-outlined text-3xl text-[#745b00]/50 group-hover:text-[#745b00] transition-colors">image</span>
                                <p class="text-sm text-[#745b00] font-['Inter'] mt-1"><span class="font-semibold">Click</span> or drag to upload creative</p>
                                <p class="text-[10px] font-bold font-['JetBrains_Mono'] text-[#745b00]/60 mt-0.5 uppercase tracking-wider">SPONSORED</p>
                            @endif
                        </div>
                        @error('creative') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                    </div>

                    {{-- Date Range --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Start Date <span class="text-xs font-normal text-[#9ca3af]">Leave empty for immediate</span>
                            </label>
                            <input wire:model="starts_at" type="date"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['JetBrains_Mono'] focus:border-[#1c1b1b] focus:ring-2 focus:ring-[#1c1b1b]/10 outline-none transition-all">
                            @error('starts_at') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                End Date <span class="text-xs font-normal text-[#9ca3af]">Leave empty for ongoing</span>
                            </label>
                            <input wire:model="ends_at" type="date"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['JetBrains_Mono'] focus:border-[#1c1b1b] focus:ring-2 focus:ring-[#1c1b1b]/10 outline-none transition-all">
                            @error('ends_at') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <label class="flex items-center gap-3 p-4 bg-[#f6f3f2] rounded-lg cursor-pointer {{ $is_active ? 'bg-[#f0fdf4] border border-[#316948]/20' : '' }}">
                        <input wire:model="is_active" type="checkbox" id="is_active" class="w-4 h-4 rounded border-2 border-[#d1d5db] text-[#316948] focus:ring-[#316948]/20">
                        <div>
                            <p class="text-sm font-bold font-['Inter'] text-[#1c1b1b]">Active Campaign</p>
                            <p class="text-xs text-[#9ca3af] font-['Inter']">Uncheck to pause this campaign</p>
                        </div>
                    </label>

                    <div class="flex justify-end gap-3 pt-4 border-t border-[#e5e2e1]">
                        <button type="button" wire:click="$set('showForm', false)" class="px-5 py-2.5 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] font-semibold font-['Inter'] hover:bg-[#f6f3f2] transition-colors text-sm">Cancel</button>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-[#1c1b1b] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#f1c100] hover:shadow-[5px_5px_0px_#b90027] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all text-sm">
                            <span class="material-symbols-outlined text-lg">save</span>
                            {{ $editingCampaignId ? 'Update' : 'Create' }} Campaign
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- ─── Campaigns Table ──────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] overflow-hidden">
            <div class="bg-[#1c1b1b] px-6 py-4">
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Zone</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Advertiser</div>
                    <div class="col-span-3 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Date Range</div>
                    <div class="col-span-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-center">Status</div>
                    <div class="col-span-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#f1c100] text-center">Impr.</div>
                    <div class="col-span-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#f1c100] text-center">Clicks</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-right">Actions</div>
                </div>
            </div>

            @forelse($campaigns as $campaign)
                <div class="border-b border-[#e5e2e1] last:border-b-0 hover:bg-[#fcf9f8] transition-colors px-6 py-4 bg-white"
                     wire:key="campaign-{{ $campaign->id }}">
                    <div class="grid grid-cols-12 gap-3 items-center">
                        <div class="col-span-2 min-w-0">
                            <span class="text-xs font-bold font-['JetBrains_Mono'] text-[#745b00] bg-[#FFF9E6] border border-[#745b00]/20 px-2 py-0.5 rounded truncate block">
                                {{ $campaign->zone?->key ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="col-span-2 min-w-0">
                            <p class="text-sm font-bold text-[#1c1b1b] font-['Inter'] truncate">{{ $campaign->advertiser_name }}</p>
                        </div>
                        <div class="col-span-3">
                            <p class="text-xs font-['JetBrains_Mono'] text-[#6b7280]">
                                {{ $campaign->starts_at?->format('d M y') ?? 'Now' }}
                                →
                                {{ $campaign->ends_at?->format('d M y') ?? 'Ongoing' }}
                            </p>
                        </div>
                        <div class="col-span-1 text-center">
                            <button wire:click="toggleActive({{ $campaign->id }})"
                                    class="text-[9px] font-bold font-['JetBrains_Mono'] uppercase px-2 py-1 rounded-full border transition-all {{ $campaign->is_active ? 'bg-[#f0fdf4] text-[#316948] border-[#316948]/30 hover:bg-[#316948] hover:text-white' : 'bg-[#f6f3f2] text-[#6b7280] border-[#d1d5db] hover:bg-[#1c1b1b] hover:text-white' }}">
                                {{ $campaign->is_active ? 'Live' : 'Paused' }}
                            </button>
                        </div>
                        <div class="col-span-1 text-center">
                            <span class="text-sm font-bold font-['JetBrains_Mono'] text-[#1c1b1b]">{{ number_format($campaign->impressions_count) }}</span>
                        </div>
                        <div class="col-span-1 text-center">
                            <span class="text-sm font-bold font-['JetBrains_Mono'] text-[#316948]">{{ number_format($campaign->clicks_count) }}</span>
                        </div>
                        <div class="col-span-2 flex items-center justify-end gap-1">
                            <button wire:click="edit({{ $campaign->id }})" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#1c1b1b] hover:bg-[#f6f3f2] transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            <button wire:click="delete({{ $campaign->id }})" wire:confirm="Delete this campaign?" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#b90027] hover:bg-[#fef2f4] transition-colors" title="Delete">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <span class="material-symbols-outlined text-5xl text-[#9ca3af] mb-3 block">campaign</span>
                    <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">No campaigns yet</p>
                    <p class="text-sm text-[#6b7280] font-['Inter'] mb-6">Create your first direct-sold advertising campaign</p>
                    @if(!$showForm)
                        <button wire:click="create" class="inline-flex items-center gap-2 bg-[#1c1b1b] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#f1c100] hover:shadow-[5px_5px_0px_#b90027] transition-all text-sm">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            New Campaign
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Summary --}}
        @if($campaigns->count() > 0)
            <div class="flex items-center justify-between mt-4 px-1">
                <p class="text-xs text-[#9ca3af] font-['JetBrains_Mono']">{{ $campaigns->where('is_active', true)->count() }} live · {{ $campaigns->where('is_active', false)->count() }} paused</p>
                <p class="text-xs text-[#9ca3af] font-['JetBrains_Mono']">Total: {{ number_format($campaigns->sum('impressions_count')) }} impressions · {{ number_format($campaigns->sum('clicks_count')) }} clicks</p>
            </div>
        @endif

    </div>
</div>

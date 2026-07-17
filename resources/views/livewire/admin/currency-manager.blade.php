@php use App\Models\Currency; @endphp
<div class="min-h-screen bg-[#fcf9f8]">
    {{-- Kente Header Strip --}}
    <div class="h-1.5 w-full" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Back + Header --}}
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#6b7280] font-['Inter'] hover:text-[#b90027] transition-colors group">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                Dashboard
            </a>
            <span class="text-[#d1d5db]">/</span>
            <span class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Currencies</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-[#745b00] flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#f1c100] text-xl">currency_exchange</span>
                    </div>
                    <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#745b00] bg-[#fefce8] px-3 py-1 rounded-full border border-[#745b00]/20">Admin</span>
                </div>
                <h1 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Currency Manager</h1>
                <p class="text-[#6b7280] font-['Inter'] mt-1">Configure currencies supported for product/service pricing</p>
            </div>
            @if(!$showForm)
                <button wire:click="create"
                        class="inline-flex items-center gap-2 bg-[#745b00] text-white font-bold font-['Inter'] py-3 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Add Currency
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
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#745b00] mb-6 overflow-hidden">
                <div class="bg-[#745b00] px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#f1c100] text-xl">{{ $editingCurrencyId ? 'edit' : 'add_circle' }}</span>
                        <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">{{ $editingCurrencyId ? 'Edit Currency' : 'New Currency' }}</h2>
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

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Code <span class="text-[#b90027]">*</span> <span class="text-xs font-normal text-[#9ca3af]">3 letters</span></label>
                            <input wire:model="code" type="text" maxlength="3" placeholder="GHS"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['JetBrains_Mono'] uppercase placeholder:text-[#9ca3af] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all">
                            @error('code') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Symbol <span class="text-[#b90027]">*</span></label>
                            <input wire:model="symbol" type="text" placeholder="GH₵"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['JetBrains_Mono'] text-lg placeholder:text-[#9ca3af] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all">
                            @error('symbol') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Name <span class="text-[#b90027]">*</span></label>
                            <input wire:model="name" type="text" placeholder="Ghana Cedi"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all">
                            @error('name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-6 p-4 bg-[#f6f3f2] rounded-lg">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input wire:model="is_active" type="checkbox" class="w-4 h-4 rounded border-2 border-[#d1d5db] text-[#316948] focus:ring-[#316948]/20">
                            <div>
                                <p class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Active</p>
                                <p class="text-xs text-[#9ca3af] font-['Inter']">Show in pricing dropdown</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input wire:model="is_default" type="checkbox" class="w-4 h-4 rounded border-2 border-[#d1d5db] text-[#745b00] focus:ring-[#745b00]/20">
                            <div>
                                <p class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Set as Default</p>
                                <p class="text-xs text-[#9ca3af] font-['Inter']">Used when no currency is selected</p>
                            </div>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-[#e5e2e1]">
                        <button type="button" wire:click="$set('showForm', false)" class="px-5 py-2.5 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] font-semibold font-['Inter'] hover:bg-[#f6f3f2] transition-colors text-sm">Cancel</button>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-[#745b00] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all text-sm">
                            <span class="material-symbols-outlined text-lg">save</span>
                            {{ $editingCurrencyId ? 'Update' : 'Add' }} Currency
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- ─── Currencies Table ─────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] overflow-hidden">
            <div class="bg-[#1c1b1b] px-6 py-4">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Code</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Symbol</div>
                    <div class="col-span-3 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Name</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-center">Status</div>
                    <div class="col-span-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-center">Default</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-right">Actions</div>
                </div>
            </div>

            @forelse($currencies as $currency)
                <div class="border-b border-[#e5e2e1] last:border-b-0 hover:bg-[#f6f3f2] transition-colors px-6 py-4 {{ $currency->is_default ? 'bg-[#fefce8]' : 'bg-white' }}"
                     wire:key="currency-{{ $currency->id }}">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-2">
                            <span class="text-sm font-black font-['JetBrains_Mono'] text-[#1c1b1b] uppercase">{{ $currency->code }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xl font-bold font-['JetBrains_Mono'] text-[#745b00]">{{ $currency->symbol }}</span>
                        </div>
                        <div class="col-span-3">
                            <span class="text-sm text-[#1c1b1b] font-['Inter']">{{ $currency->name }}</span>
                        </div>
                        <div class="col-span-2 text-center">
                            <button wire:click="toggleActive({{ $currency->id }})"
                                    class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase px-3 py-1.5 rounded-full border transition-all {{ $currency->is_active ? 'bg-[#f0fdf4] text-[#316948] border-[#316948]/30 hover:bg-[#316948] hover:text-white' : 'bg-[#fef2f4] text-[#b90027] border-[#b90027]/30 hover:bg-[#b90027] hover:text-white' }}">
                                {{ $currency->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </div>
                        <div class="col-span-1 text-center">
                            @if($currency->is_default)
                                <span class="material-symbols-outlined text-[#f1c100] text-2xl" style="font-variation-settings: 'FILL' 1" title="Default">star</span>
                            @else
                                <button wire:click="setDefault({{ $currency->id }})" class="text-[#d1d5db] hover:text-[#f1c100] transition-colors" title="Set as default">
                                    <span class="material-symbols-outlined text-2xl">star</span>
                                </button>
                            @endif
                        </div>
                        <div class="col-span-2 flex items-center justify-end gap-1">
                            <button wire:click="edit({{ $currency->id }})" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#745b00] hover:bg-[#fefce8] transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            <button wire:click="delete({{ $currency->id }})" wire:confirm="Delete {{ $currency->code }}?" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#b90027] hover:bg-[#fef2f4] transition-colors" title="Delete">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center">
                    <span class="material-symbols-outlined text-5xl text-[#9ca3af] mb-3 block">currency_exchange</span>
                    <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">No currencies configured</p>
                    <p class="text-sm text-[#6b7280] font-['Inter'] mb-6">Add GHS as your first currency to get started</p>
                    @if(!$showForm)
                        <button wire:click="create" class="inline-flex items-center gap-2 bg-[#745b00] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] transition-all text-sm">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Add Currency
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</div>

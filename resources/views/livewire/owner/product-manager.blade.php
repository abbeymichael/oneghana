<div class="min-h-screen bg-[#fcf9f8]">
    {{-- Kente Header Strip --}}
    <div class="h-1.5 w-full" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Back --}}
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#6b7280] font-['Inter'] hover:text-[#b90027] transition-colors group">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                Dashboard
            </a>
            <span class="text-[#d1d5db]">/</span>
            <a href="{{ route('owner.business.edit', $business) }}" class="text-sm text-[#6b7280] font-['Inter'] hover:text-[#b90027] transition-colors truncate">{{ $business->name }}</a>
            <span class="text-[#d1d5db]">/</span>
            <span class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Products & Services</span>
        </div>

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-[#316948] flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-xl">inventory_2</span>
                    </div>
                    <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#316948] bg-[#f0fdf4] px-3 py-1 rounded-full border border-[#316948]/20">
                        {{ $products->count() }} {{ Str::plural('item', $products->count()) }}
                    </span>
                </div>
                <h1 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Products & Services</h1>
                <p class="text-[#6b7280] font-['Inter'] mt-1">{{ $business->name }}</p>
            </div>
            @if(!$showForm)
                <button
                    wire:click="create"
                    class="inline-flex items-center gap-2 bg-[#b90027] text-white font-bold font-['Inter'] py-3 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm whitespace-nowrap"
                >
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Add Product / Service
                </button>
            @endif
        </div>

        {{-- Flash Message --}}
        @if(session('message'))
            <div class="mb-6 p-4 rounded-xl bg-[#f0fdf4] border-[1.5px] border-[#316948] flex items-center gap-3 shadow-[3px_3px_0px_#316948]">
                <span class="material-symbols-outlined text-[#316948] text-xl flex-shrink-0">check_circle</span>
                <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('message') }}</p>
            </div>
        @endif

        {{-- ─── Add / Edit Form ──────────────────────────────────────────── --}}
        @if($showForm)
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#b90027] mb-8 overflow-hidden"
                 x-data x-init="$el.scrollIntoView({ behavior: 'smooth', block: 'start' })">
                <div class="bg-[#b90027] px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-white text-xl">{{ $editingProductId ? 'edit' : 'add_circle' }}</span>
                        <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">
                            {{ $editingProductId ? 'Edit Product / Service' : 'New Product / Service' }}
                        </h2>
                    </div>
                    <button type="button" wire:click="$set('showForm', false)" class="text-white/70 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form wire:submit="save" class="p-6 space-y-5">
                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="p-4 rounded-lg bg-[#fef2f4] border border-[#b90027]/30 flex items-start gap-2">
                            <span class="material-symbols-outlined text-[#b90027] text-lg flex-shrink-0 mt-0.5">error</span>
                            <ul class="text-sm text-[#b90027] font-['Inter'] space-y-0.5 list-disc list-inside">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Name + Type --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Name <span class="text-[#b90027]">*</span>
                            </label>
                            <input
                                wire:model="name"
                                type="text"
                                placeholder="e.g. Kente Fabric Roll, Logo Design"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                            >
                            @error('name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Type</label>
                            <div class="flex gap-3">
                                <label class="flex-1 flex items-center gap-3 p-3 rounded-lg border-2 cursor-pointer transition-all {{ $type === 'product' ? 'border-[#b90027] bg-[#fef2f4]' : 'border-[#d1d5db] bg-white hover:border-[#9ca3af]' }}">
                                    <input wire:model="type" type="radio" value="product" class="sr-only">
                                    <span class="material-symbols-outlined text-xl {{ $type === 'product' ? 'text-[#b90027]' : 'text-[#9ca3af]' }}">inventory_2</span>
                                    <span class="text-sm font-semibold font-['Inter'] {{ $type === 'product' ? 'text-[#b90027]' : 'text-[#6b7280]' }}">Product</span>
                                </label>
                                <label class="flex-1 flex items-center gap-3 p-3 rounded-lg border-2 cursor-pointer transition-all {{ $type === 'service' ? 'border-[#316948] bg-[#f0fdf4]' : 'border-[#d1d5db] bg-white hover:border-[#9ca3af]' }}">
                                    <input wire:model="type" type="radio" value="service" class="sr-only">
                                    <span class="material-symbols-outlined text-xl {{ $type === 'service' ? 'text-[#316948]' : 'text-[#9ca3af]' }}">handyman</span>
                                    <span class="text-sm font-semibold font-['Inter'] {{ $type === 'service' ? 'text-[#316948]' : 'text-[#6b7280]' }}">Service</span>
                                </label>
                            </div>
                            @error('type') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Description <span class="text-xs font-normal text-[#9ca3af]">Optional</span></label>
                        <textarea
                            wire:model="description"
                            rows="3"
                            placeholder="Describe this product or service..."
                            class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200 resize-none"
                        ></textarea>
                        @error('description') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                    </div>

                    {{-- Price + Currency + Unit --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Price
                                <span class="text-xs font-normal text-[#9ca3af]">empty = "Contact for pricing"</span>
                            </label>
                            <input
                                wire:model="price"
                                type="number"
                                step="0.01"
                                min="0"
                                placeholder="0.00"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] font-['JetBrains_Mono'] placeholder:text-[#9ca3af] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all duration-200"
                            >
                            @error('price') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Currency</label>
                            <select
                                wire:model="currency_id"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#745b00] focus:ring-2 focus:ring-[#745b00]/20 outline-none transition-all duration-200"
                            >
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->code }} ({{ $currency->symbol }})</option>
                                @endforeach
                            </select>
                            @error('currency_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Unit
                                <span class="text-xs font-normal text-[#9ca3af]">e.g. per piece, /hr</span>
                            </label>
                            <input
                                wire:model="unit"
                                type="text"
                                placeholder="per piece"
                                class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200"
                            >
                            @error('unit') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Photo + Availability --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                                Photo <span class="text-xs font-normal text-[#9ca3af]">Optional — max 5MB</span>
                            </label>
                            <div class="relative border-2 border-dashed border-[#d1d5db] rounded-xl p-5 text-center hover:border-[#b90027] transition-colors cursor-pointer group bg-[#fcf9f8]">
                                <input wire:model="photo" type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                @if($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-16 h-16 object-cover rounded-lg border-[1.5px] border-[#316948] mx-auto mb-2">
                                    <p class="text-xs text-[#316948] font-semibold font-['Inter']">New photo ready</p>
                                @else
                                    <span class="material-symbols-outlined text-3xl text-[#9ca3af] group-hover:text-[#b90027] transition-colors">add_photo_alternate</span>
                                    <p class="text-xs text-[#6b7280] font-['Inter'] mt-1"><span class="font-semibold text-[#b90027]">Click</span> or drag to upload</p>
                                @endif
                            </div>
                            @error('photo') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col justify-center">
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-3">Availability</label>
                            <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all {{ $is_available ? 'border-[#316948] bg-[#f0fdf4]' : 'border-[#d1d5db] bg-[#f6f3f2]' }}">
                                <input wire:model="is_available" type="checkbox" id="is_available" class="w-5 h-5 rounded border-2 border-[#d1d5db] text-[#316948] focus:ring-[#316948]/20">
                                <div>
                                    <p class="text-sm font-bold font-['Inter'] {{ $is_available ? 'text-[#316948]' : 'text-[#6b7280]' }}">
                                        {{ $is_available ? '✓ Available now' : 'Currently unavailable' }}
                                    </p>
                                    <p class="text-xs font-['Inter'] text-[#9ca3af]">Uncheck to temporarily hide from customers</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e5e2e1]">
                        <button
                            type="button"
                            wire:click="$set('showForm', false)"
                            class="px-5 py-2.5 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] font-semibold font-['Inter'] hover:bg-[#f6f3f2] transition-colors text-sm"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 bg-[#b90027] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm active:translate-x-0.5 active:translate-y-0.5 active:shadow-none"
                        >
                            <span class="material-symbols-outlined text-lg">{{ $editingProductId ? 'save' : 'add_circle' }}</span>
                            {{ $editingProductId ? 'Update Product' : 'Add Product' }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- ─── Products Table ───────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] overflow-hidden">
            {{-- Table Header --}}
            <div class="bg-[#1c1b1b] px-6 py-4">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-5 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Product / Service</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Type</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Price</div>
                    <div class="col-span-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Status</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-right">Actions</div>
                </div>
            </div>

            {{-- Table Body --}}
            @forelse($products as $product)
                <div class="border-b border-[#e5e2e1] last:border-b-0 hover:bg-[#fcf9f8] transition-colors group px-6 py-4"
                     wire:key="product-{{ $product->id }}">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        {{-- Name + Photo --}}
                        <div class="col-span-5 flex items-center gap-3 min-w-0">
                            @if($product->getFirstMediaUrl('product_photos'))
                                <img src="{{ $product->getFirstMediaUrl('product_photos', 'thumb') ?: $product->getFirstMediaUrl('product_photos') }}"
                                     alt="{{ $product->name }}"
                                     class="w-10 h-10 rounded-lg object-cover border-[1.5px] border-[#e5e2e1] flex-shrink-0">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-[#f6f3f2] flex items-center justify-center border-[1.5px] border-[#e5e2e1] flex-shrink-0">
                                    <span class="material-symbols-outlined text-[#9ca3af] text-lg">{{ $product->type === 'service' ? 'handyman' : 'inventory_2' }}</span>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-[#1c1b1b] font-['Inter'] truncate">{{ $product->name }}</p>
                                @if($product->unit)
                                    <p class="text-xs text-[#9ca3af] font-['JetBrains_Mono']">per {{ $product->unit }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Type Badge --}}
                        <div class="col-span-2">
                            @if($product->type === 'service')
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase text-[#316948] bg-[#f0fdf4] border border-[#316948]/20 px-2 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-xs">handyman</span>
                                    Service
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase text-[#745b00] bg-[#fefce8] border border-[#745b00]/20 px-2 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-xs">inventory_2</span>
                                    Product
                                </span>
                            @endif
                        </div>

                        {{-- Price --}}
                        <div class="col-span-2">
                            <p class="text-sm font-bold text-[#1c1b1b] font-['JetBrains_Mono']">{{ $product->formattedPrice() }}</p>
                        </div>

                        {{-- Availability --}}
                        <div class="col-span-1">
                            @if($product->is_available)
                                <span class="w-2.5 h-2.5 rounded-full bg-[#316948] block" title="Available"></span>
                            @else
                                <span class="w-2.5 h-2.5 rounded-full bg-[#b90027] block" title="Unavailable"></span>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="col-span-2 flex items-center justify-end gap-2">
                            <button
                                wire:click="edit({{ $product->id }})"
                                class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#1c1b1b] hover:bg-[#f6f3f2] transition-colors"
                                title="Edit"
                            >
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            <button
                                wire:click="delete({{ $product->id }})"
                                wire:confirm="Are you sure you want to delete '{{ $product->name }}'? This cannot be undone."
                                class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#b90027] hover:bg-[#fef2f4] transition-colors"
                                title="Delete"
                            >
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <div class="w-16 h-16 rounded-full bg-[#f6f3f2] flex items-center justify-center mx-auto mb-4 border border-[#e5e2e1]">
                        <span class="material-symbols-outlined text-3xl text-[#9ca3af]">inventory_2</span>
                    </div>
                    <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">No products yet</p>
                    <p class="text-sm text-[#6b7280] font-['Inter'] mb-6">Start adding products and services to attract customers</p>
                    @if(!$showForm)
                        <button wire:click="create"
                                class="inline-flex items-center gap-2 bg-[#b90027] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Add First Product
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Summary Footer --}}
        @if($products->count() > 0)
            <div class="flex items-center justify-between mt-4 px-1">
                <p class="text-xs text-[#9ca3af] font-['JetBrains_Mono']">
                    {{ $products->where('is_available', true)->count() }} available · {{ $products->where('is_available', false)->count() }} unavailable
                </p>
                <p class="text-xs text-[#9ca3af] font-['JetBrains_Mono']">
                    {{ $products->where('type', 'product')->count() }} products · {{ $products->where('type', 'service')->count() }} services
                </p>
            </div>
        @endif

    </div>
</div>

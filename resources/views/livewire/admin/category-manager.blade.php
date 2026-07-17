@php use App\Models\Category; @endphp
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
            <span class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Categories</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-[#316948] flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-xl">category</span>
                    </div>
                    <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#316948] bg-[#f0fdf4] px-3 py-1 rounded-full border border-[#316948]/20">Admin</span>
                </div>
                <h1 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Category Manager</h1>
                <p class="text-[#6b7280] font-['Inter'] mt-1">Organize business types and configure custom field schemas</p>
            </div>
            @if(!$showForm)
                <button wire:click="create"
                        class="inline-flex items-center gap-2 bg-[#316948] text-white font-bold font-['Inter'] py-3 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Add Category
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

        {{-- ─── Add / Edit Form ──────────────────────────────────────────── --}}
        @if($showForm)
            <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#316948] mb-6 overflow-hidden">
                <div class="bg-[#316948] px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-white text-xl">{{ $editingCategoryId ? 'edit' : 'add_circle' }}</span>
                        <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-white">
                            {{ $editingCategoryId ? 'Edit Category' : 'New Category' }}
                        </h2>
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
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Name <span class="text-[#b90027]">*</span></label>
                            <input wire:model="name" type="text" placeholder="e.g. Healthcare, Retail"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all">
                            @error('name') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Parent Category</label>
                            <select wire:model="parent_id"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all">
                                <option value="">— Root Category —</option>
                                @foreach($parentCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Icon <span class="text-xs font-normal text-[#9ca3af]">emoji or icon class</span></label>
                        <input wire:model="icon" type="text" placeholder="🏥  or  fas fa-hospital"
                               class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">
                            Custom Fields Schema <span class="text-xs font-normal text-[#9ca3af]">JSON array</span>
                        </label>
                        <textarea wire:model="custom_fields_schema" rows="6"
                                  placeholder='[{"key":"license_number","label":"License Number","type":"text","required":true},{"key":"years_in_business","label":"Years in Business","type":"number","required":false}]'
                                  class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-[#fcf9f8] text-[#1c1b1b] font-['JetBrains_Mono'] text-xs placeholder:text-[#9ca3af] focus:border-[#316948] focus:ring-2 focus:ring-[#316948]/20 outline-none transition-all resize-none"></textarea>
                        @error('custom_fields_schema') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                        <p class="mt-1.5 text-xs text-[#9ca3af] font-['Inter']">Supported types: <code class="font-['JetBrains_Mono'] bg-[#f6f3f2] px-1 rounded">text</code>, <code class="font-['JetBrains_Mono'] bg-[#f6f3f2] px-1 rounded">number</code>, <code class="font-['JetBrains_Mono'] bg-[#f6f3f2] px-1 rounded">boolean</code>, <code class="font-['JetBrains_Mono'] bg-[#f6f3f2] px-1 rounded">select</code></p>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-[#e5e2e1]">
                        <button type="button" wire:click="$set('showForm', false)"
                                class="px-5 py-2.5 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] font-semibold font-['Inter'] hover:bg-[#f6f3f2] transition-colors text-sm">Cancel</button>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-[#316948] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all text-sm">
                            <span class="material-symbols-outlined text-lg">{{ $editingCategoryId ? 'save' : 'add_circle' }}</span>
                            {{ $editingCategoryId ? 'Update' : 'Create' }} Category
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- ─── Categories Table ─────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] overflow-hidden">
            <div class="bg-[#1c1b1b] px-6 py-4">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-4 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Category</div>
                    <div class="col-span-3 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Slug</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af]">Parent</div>
                    <div class="col-span-1 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-center">Biz.</div>
                    <div class="col-span-2 text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#9ca3af] text-right">Actions</div>
                </div>
            </div>

            @forelse($categories as $category)
                {{-- Root category row --}}
                <div class="border-b border-[#e5e2e1] last:border-b-0 hover:bg-[#f6f3f2] transition-colors px-6 py-4 bg-white" wire:key="cat-{{ $category->id }}">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-4 flex items-center gap-2 min-w-0">
                            @if($category->icon)
                                <span class="text-lg flex-shrink-0">{{ $category->icon }}</span>
                            @else
                                <span class="material-symbols-outlined text-[#9ca3af] text-lg flex-shrink-0">category</span>
                            @endif
                            <span class="text-sm font-bold text-[#1c1b1b] font-['Inter'] truncate">{{ $category->name }}</span>
                            @if($category->children->count() > 0)
                                <span class="text-[10px] font-bold font-['JetBrains_Mono'] bg-[#f6f3f2] text-[#6b7280] px-1.5 py-0.5 rounded-full flex-shrink-0">{{ $category->children->count() }}</span>
                            @endif
                        </div>
                        <div class="col-span-3">
                            <code class="text-xs font-['JetBrains_Mono'] text-[#6b7280] bg-[#f6f3f2] px-2 py-0.5 rounded">{{ $category->slug }}</code>
                        </div>
                        <div class="col-span-2 text-sm text-[#9ca3af] font-['Inter']">—</div>
                        <div class="col-span-1 text-center">
                            <span class="text-sm font-bold text-[#1c1b1b] font-['JetBrains_Mono']">{{ $category->businesses_count ?? $category->businesses()->count() }}</span>
                        </div>
                        <div class="col-span-2 flex items-center justify-end gap-1">
                            <button wire:click="edit({{ $category->id }})" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#316948] hover:bg-[#f0fdf4] transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="Delete '{{ $category->name }}'? This cannot be undone." class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#b90027] hover:bg-[#fef2f4] transition-colors" title="Delete">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Child category rows --}}
                @foreach($category->children as $child)
                    <div class="border-b border-[#e5e2e1] last:border-b-0 hover:bg-[#f6f3f2] transition-colors px-6 py-3.5 bg-[#fcf9f8]" wire:key="cat-child-{{ $child->id }}">
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-4 flex items-center gap-2 pl-8 min-w-0">
                                <span class="text-[#9ca3af] text-sm flex-shrink-0">└</span>
                                @if($child->icon)
                                    <span class="text-base flex-shrink-0">{{ $child->icon }}</span>
                                @endif
                                <span class="text-sm text-[#1c1b1b] font-['Inter'] truncate">{{ $child->name }}</span>
                            </div>
                            <div class="col-span-3">
                                <code class="text-xs font-['JetBrains_Mono'] text-[#9ca3af] bg-[#f6f3f2] px-2 py-0.5 rounded">{{ $child->slug }}</code>
                            </div>
                            <div class="col-span-2 text-xs text-[#6b7280] font-['Inter'] truncate">{{ $category->name }}</div>
                            <div class="col-span-1 text-center">
                                <span class="text-sm font-['JetBrains_Mono'] text-[#6b7280]">{{ $child->businesses_count ?? $child->businesses()->count() }}</span>
                            </div>
                            <div class="col-span-2 flex items-center justify-end gap-1">
                                <button wire:click="edit({{ $child->id }})" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#316948] hover:bg-[#f0fdf4] transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </button>
                                <button wire:click="delete({{ $child->id }})" wire:confirm="Delete '{{ $child->name }}'?" class="p-1.5 rounded-lg text-[#6b7280] hover:text-[#b90027] hover:bg-[#fef2f4] transition-colors" title="Delete">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <div class="py-20 text-center">
                    <span class="material-symbols-outlined text-5xl text-[#9ca3af] mb-3 block">category</span>
                    <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">No categories yet</p>
                    <p class="text-sm text-[#6b7280] font-['Inter'] mb-6">Create your first category to organise businesses</p>
                    @if(!$showForm)
                        <button wire:click="create"
                                class="inline-flex items-center gap-2 bg-[#316948] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] transition-all text-sm">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Add First Category
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</div>

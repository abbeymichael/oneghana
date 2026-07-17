@php use Illuminate\Support\Str; @endphp
<div class="max-w-7xl mx-auto px-container-margin py-lg">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        <!-- Sidebar Filters -->
        <aside class="md:col-span-3 space-y-lg">
            <div class="bg-surface-container border-[1.5px] border-on-surface p-md space-y-md">
                <div class="flex items-center justify-between">
                    <h2 class="font-headline-sm text-headline-sm">Filters</h2>
                    <button wire:click="resetFilters" class="text-primary font-label-caps text-label-caps hover:underline">Clear All</button>
                </div>

                <section class="space-y-sm">
                    <h3 class="font-label-caps text-label-caps text-on-surface-variant">Category</h3>
                    <select wire:model.live="category" class="w-full bg-surface-container-low border-[1.5px] border-on-surface px-sm py-xs font-body-sm text-body-sm outline-none focus:border-primary">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @foreach($cat->children as $child)
                                <option value="{{ $child->slug }}">&nbsp;&nbsp;— {{ $child->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </section>

                <hr class="border-on-surface-variant/20">

                <section class="space-y-sm">
                    <h3 class="font-label-caps text-label-caps text-on-surface-variant">Region</h3>
                    <select wire:model.live="region" class="w-full bg-surface-container-low border-[1.5px] border-on-surface px-sm py-xs font-body-sm text-body-sm outline-none focus:border-primary">
                        <option value="">All Regions</option>
                        @foreach($regions as $r)
                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </section>

                <hr class="border-on-surface-variant/20">

                <section class="space-y-sm">
                    <h3 class="font-label-caps text-label-caps text-on-surface-variant">District</h3>
                    <select wire:model.live="district" class="w-full bg-surface-container-low border-[1.5px] border-on-surface px-sm py-xs font-body-sm text-body-sm outline-none focus:border-primary">
                        <option value="">All Districts</option>
                        @if($selectedRegion)
                            @foreach($selectedRegion->districts as $d)
                                <option value="{{ $d->name }}">{{ $d->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </section>

                <hr class="border-on-surface-variant/20">

                <section class="space-y-sm">
                    <h3 class="font-label-caps text-label-caps text-on-surface-variant">Sort By</h3>
                    <div class="space-y-xs">
                        <button wire:click="$set('sort', 'latest')" class="flex items-center gap-xs w-full p-xs border-[1.5px] {{ $sort === 'latest' ? 'border-primary bg-primary-container text-on-primary-container' : 'border-transparent hover:border-on-surface' }} transition-all">
                            <span class="font-body-sm text-body-sm">Latest</span>
                        </button>
                        <button wire:click="$set('sort', 'name')" class="flex items-center gap-xs w-full p-xs border-[1.5px] {{ $sort === 'name' ? 'border-primary bg-primary-container text-on-primary-container' : 'border-transparent hover:border-on-surface' }} transition-all">
                            <span class="font-body-sm text-body-sm">Name</span>
                        </button>
                        <button wire:click="$set('sort', 'views')" class="flex items-center gap-xs w-full p-xs border-[1.5px] {{ $sort === 'views' ? 'border-primary bg-primary-container text-on-primary-container' : 'border-transparent hover:border-on-surface' }} transition-all">
                            <span class="font-body-sm text-body-sm">Most Viewed</span>
                        </button>
                    </div>
                </section>
            </div>

            <x-ad-slot zone="search_sidebar" />
        </aside>

        <!-- Main Content Area -->
        <div class="md:col-span-9 space-y-lg">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-md">
                <h1 class="font-display-lg-mobile text-display-lg-mobile text-on-surface">
                    @if($search)
                        Results for "<span class="text-primary underline">{{ $search }}</span>"
                    @else
                        Browse <span class="text-primary">Businesses</span>
                    @endif
                </h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $businesses->total() }} businesses found</p>
            </div>

            <!-- Search Bar -->
            <div class="bg-surface-container border-[1.5px] border-on-surface p-sm flex flex-col md:flex-row gap-xs pop-shadow">
                <div class="flex-1 flex items-center border-[1.5px] border-transparent focus-within:border-primary transition-all px-md">
                    <span class="material-symbols-outlined text-on-surface-variant mr-sm">search</span>
                    <input wire:model.live.debounce.300ms="search" type="text" class="w-full py-md border-none focus:ring-0 font-body-md bg-transparent" placeholder="Search businesses...">
                </div>
            </div>

            @if($businesses->isEmpty())
                <div class="text-center py-xl">
                    <span class="material-symbols-outlined text-[60px] text-on-surface-variant/30">search_off</span>
                    <p class="font-headline-md text-on-surface-variant mt-md">No businesses found</p>
                    <p class="font-body-sm text-on-surface-variant mt-sm">Try adjusting your filters or search term</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-lg">
                @foreach($businesses as $business)
                    <article class="bg-surface border-[1.5px] border-on-surface pop-shadow pop-shadow-yellow transition-all flex flex-col group @if($business->is_featured) kente-border @endif">
                        <div class="h-48 overflow-hidden relative border-b-[1.5px] border-on-surface">
                            @if($business->getFirstMediaUrl('logo'))
                                <div class="w-full h-full bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ $business->getFirstMediaUrl('logo') }}')"></div>
                            @else
                                <div class="w-full h-full bg-surface-container-highest flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                    <span class="material-symbols-outlined text-[60px] text-on-surface-variant/30">store</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 flex gap-2">
                                @if($business->category)
                                    <span class="bg-secondary text-on-secondary font-label-caps text-label-caps px-sm py-1 border-[1.5px] border-on-surface">{{ $business->category->name }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-md space-y-md flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h2 class="font-headline-md text-headline-md">
                                        <a href="{{ route('business.show', $business) }}" class="hover:text-primary transition-colors">{{ $business->name }}</a>
                                    </h2>
                                    @if($averageRating = $business->averageRating())
                                        <div class="flex items-center gap-1 bg-tertiary-fixed text-on-tertiary-fixed px-1 border-[1.5px] border-on-surface">
                                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="font-label-caps text-label-caps">{{ number_format($averageRating, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                @if($business->region)
                                    <div class="flex items-center gap-sm mt-xs text-on-surface-variant">
                                        <span class="material-symbols-outlined text-[18px]">location_on</span>
                                        <span class="font-body-sm text-body-sm">{{ $business->region->name }}{{ $business->district ? ', '.$business->district->name : '' }}</span>
                                    </div>
                                @endif
                                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-sm">{{ Str::limit($business->description, 120) }}</p>
                            </div>
                            <div class="flex gap-sm pt-md">
                                <a href="{{ route('business.show', $business) }}" class="flex-grow bg-primary text-on-primary font-label-caps text-label-caps py-sm border-[1.5px] border-on-surface hover:bg-primary-container active:scale-95 transition-all text-center">View Details</a>
                                @if($business->phone)
                                    <a href="tel:{{ $business->phone }}" class="w-12 flex items-center justify-center border-[1.5px] border-on-surface text-secondary hover:bg-secondary-container active:scale-95 transition-all">
                                        <span class="material-symbols-outlined">call</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($businesses->hasPages())
                <nav class="flex justify-center items-center gap-sm pt-xl">
                    @if($businesses->onFirstPage())
                        <span class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface opacity-50">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </span>
                    @else
                        <button wire:click="previousPage" class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface hover:bg-primary-container transition-colors">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    @endif

                    @php
                        $currentPage = $businesses->currentPage();
                        $lastPage = $businesses->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                    @endphp

                    @if($start > 1)
                        <button wire:click="gotoPage(1)" class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface hover:bg-surface-container-high font-label-caps">1</button>
                        @if($start > 2)<span class="px-xs font-label-caps">...</span>@endif
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        <button wire:click="gotoPage({{ $i }})" class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface font-label-caps {{ $i === $currentPage ? 'bg-primary text-on-primary' : 'hover:bg-surface-container-high' }}">{{ $i }}</button>
                    @endfor

                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)<span class="px-xs font-label-caps">...</span>@endif
                        <button wire:click="gotoPage({{ $lastPage }})" class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface hover:bg-surface-container-high font-label-caps">{{ $lastPage }}</button>
                    @endif

                    @if($businesses->onLastPage())
                        <span class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface opacity-50">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </span>
                    @else
                        <button wire:click="nextPage" class="w-10 h-10 flex items-center justify-center border-[1.5px] border-on-surface hover:bg-primary-container transition-colors">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</div>

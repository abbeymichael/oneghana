@php use Illuminate\Support\Str; @endphp
<div>
    <!-- Hero Section -->
    <section class="relative overflow-hidden px-container-margin py-xl bg-surface-container-low border-b-[1.5px] border-on-surface" style="background-image: radial-gradient(#916e6d 0.5px, transparent 0.5px); background-size: 16px 16px;">
        <div class="relative z-10 text-center flex flex-col items-center gap-lg py-xl max-w-7xl mx-auto">
            <h1 class="font-display-lg text-display-lg max-w-2xl">Find the Heartbeat of Ghanaian Industry</h1>
            <p class="font-body-lg text-on-surface-variant max-w-xl">Discover reliable local businesses, from the best waakye joints to top-tier electronics repair specialists.</p>
            <!-- Search Bar -->
            <div class="w-full max-w-4xl bg-background border-[1.5px] border-on-surface p-sm flex flex-col md:flex-row gap-xs pop-shadow mt-lg">
                <div class="flex-1 flex items-center border-[1.5px] border-transparent focus-within:border-primary transition-all px-md">
                    <span class="material-symbols-outlined text-on-surface-variant mr-sm">search</span>
                    <input class="w-full py-md border-none focus:ring-0 font-body-md bg-transparent" placeholder="Keywords: Salon, Waakye, Plumber..." type="text" onchange="window.location='{{ route('business.search') }}?search='+this.value">
                </div>
                <div class="w-[1.5px] bg-outline hidden md:block my-unit"></div>
                <div class="flex-1 flex items-center border-[1.5px] border-transparent focus-within:border-primary transition-all px-md">
                    <span class="material-symbols-outlined text-on-surface-variant mr-sm">category</span>
                    <select class="w-full py-md border-none focus:ring-0 font-body-md bg-transparent" onchange="if(this.value) window.location='{{ route('business.search') }}?category='+this.value">
                        <option value="">All Categories</option>
                        @foreach($featuredCategories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-[1.5px] bg-outline hidden md:block my-unit"></div>
                <div class="flex-1 flex items-center border-[1.5px] border-transparent focus-within:border-primary transition-all px-md">
                    <span class="material-symbols-outlined text-on-surface-variant mr-sm">location_on</span>
                    <input class="w-full py-md border-none focus:ring-0 font-body-md bg-transparent" placeholder="Accra, Kumasi, Tamale..." type="text" onchange="window.location='{{ route('business.search') }}?search='+this.value">
                </div>
                <a href="{{ route('business.search') }}" class="bg-primary text-on-primary font-label-caps text-label-caps px-xl py-md border-[1.5px] border-on-surface hover:bg-on-primary-fixed-variant transition-colors inline-flex items-center whitespace-nowrap">
                    SEARCH
                </a>
            </div>
        </div>
        <div class="absolute top-0 right-0 p-lg opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[200px]" style="font-variation-settings: 'FILL' 1;">storefront</span>
        </div>
    </section>

    <div class="max-w-7xl mx-auto">
        <!-- Featured Categories Grid -->
        <section class="px-container-margin py-xl">
            <div class="flex justify-between items-end mb-lg">
                <div class="flex flex-col gap-xs">
                    <span class="font-label-caps text-label-caps text-primary">POPULAR HUB</span>
                    <h2 class="font-headline-md text-headline-md">Explore by Category</h2>
                </div>
                <a href="{{ route('business.search') }}" class="font-label-caps text-label-caps text-secondary underline hover:text-primary transition-colors">View All</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-md">
                @forelse($featuredCategories as $category)
                    @php
                        $colors = ['border-primary text-primary group-hover:bg-primary', 'border-secondary text-secondary group-hover:bg-secondary', 'border-tertiary text-tertiary group-hover:bg-tertiary'];
                        $colorClass = $colors[$loop->index % 3];
                        $icons = ['restaurant', 'content_cut', 'devices', 'hotel', 'build', 'shopping_basket', 'local_shipping', 'handyman', 'school', 'medical_services'];
                        $icon = $icons[$loop->index % count($icons)];
                    @endphp
                    <a href="{{ route('business.search', ['category' => $category->slug]) }}" class="group cursor-pointer border-[1.5px] border-on-surface p-lg bg-background text-center flex flex-col items-center gap-md transition-all hover:translate-y-[-4px] pop-shadow-yellow">
                        <div class="w-16 h-16 rounded-full border-[1.5px] {{ $colorClass }} group-hover:text-on-primary transition-all flex items-center justify-center">
                            <span class="material-symbols-outlined text-[32px]">{{ $icon }}</span>
                        </div>
                        <span class="font-label-caps text-label-caps">{{ $category->name }}</span>
                        @if($category->children->count())
                            <span class="font-body-sm text-on-surface-variant text-[11px]">{{ $category->children->count() }} subcategories</span>
                        @endif
                    </a>
                @empty
                    <div class="col-span-full text-center py-lg">
                        <p class="font-body-md text-on-surface-variant">No categories found.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Nearby Listings & Sponsored Content -->
        <section class="px-container-margin py-xl flex flex-col lg:flex-row gap-lg">
            <div class="flex-1">
                <div class="flex items-center gap-md mb-lg">
                    <h2 class="font-headline-md text-headline-md">Recently Added</h2>
                    <span class="bg-secondary-container text-on-secondary-container px-sm py-xs font-label-caps text-[10px] flex items-center gap-xs">
                        <span class="material-symbols-outlined text-[14px]">schedule</span> LATEST
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                    @forelse($recentListings as $business)
                        <div class="border-[1.5px] border-on-surface bg-surface flex flex-col transition-all hover:translate-x-[4px] pop-shadow @if($business->is_featured) kente-border @endif">
                            <div class="h-48 overflow-hidden relative border-b-[1.5px] border-on-surface">
                                @if($business->getFirstMediaUrl('logo'))
                                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $business->getFirstMediaUrl('logo') }}')"></div>
                                @else
                                    <div class="w-full h-full bg-surface-container-highest flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[60px] text-on-surface-variant/30">store</span>
                                    </div>
                                @endif
                                @if($business->is_featured)
                                    <div class="absolute top-md right-md bg-tertiary text-on-tertiary px-sm py-unit font-label-caps text-[10px] border-[1.5px] border-on-surface">FEATURED</div>
                                @endif
                            </div>
                            <div class="p-md flex flex-col gap-sm flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-headline-sm text-headline-sm">
                                        <a href="{{ route('business.show', $business) }}" class="hover:text-primary transition-colors">{{ $business->name }}</a>
                                    </h3>
                                    @if($business->averageRating())
                                        <span class="text-tertiary flex items-center gap-xs font-label-caps text-[12px]">
                                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                            {{ number_format($business->averageRating(), 1) }}
                                        </span>
                                    @endif
                                </div>
                                <p class="font-body-sm text-on-surface-variant line-clamp-2">{{ Str::limit($business->description, 120) }}</p>
                                @if($business->region)
                                    <div class="flex items-center gap-xs text-on-surface-variant font-label-caps text-[11px]">
                                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                                        {{ $business->region->name }}{{ $business->district ? ', '.$business->district->name : '' }}
                                    </div>
                                @endif
                                <div class="mt-auto flex justify-between items-center pt-md">
                                    <span class="text-primary font-label-caps text-label-caps">{{ $business->category?->name ?? 'BUSINESS' }}</span>
                                    <div class="flex gap-xs">
                                        @if($business->phone)
                                            <a href="tel:{{ $business->phone }}" class="bg-on-surface text-background font-label-caps text-[10px] px-md py-sm hover:bg-primary transition-colors inline-flex items-center gap-xs">
                                                <span class="material-symbols-outlined text-[14px]">call</span>
                                            </a>
                                        @endif
                                        <a href="{{ route('business.show', $business) }}" class="bg-primary text-on-primary font-label-caps text-[10px] px-md py-sm hover:opacity-90 transition-all inline-flex items-center gap-xs">
                                            <span>View</span>
                                            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-xl">
                            <span class="material-symbols-outlined text-[60px] text-on-surface-variant/30">store</span>
                            <p class="font-body-md text-on-surface-variant mt-md">No businesses listed yet.</p>
                            @auth
                                <a href="{{ route('business.register') }}" class="mt-md inline-block bg-primary text-on-primary font-label-caps text-label-caps px-lg py-sm border-[1.5px] border-on-surface pop-shadow">Be the First</a>
                            @else
                                <a href="{{ route('register') }}" class="mt-md inline-block bg-primary text-on-primary font-label-caps text-label-caps px-lg py-sm border-[1.5px] border-on-surface pop-shadow">Get Started</a>
                            @endauth
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="w-full lg:w-80 flex flex-col gap-lg">
                <x-ad-slot zone="homepage_banner" />
                <div class="border-[1.5px] border-on-surface p-md bg-secondary-container">
                    <h4 class="font-label-caps text-label-caps text-on-secondary-container mb-sm">MARKET STATS</h4>
                    <div class="flex flex-col gap-sm">
                        <div class="flex justify-between border-b border-on-secondary-container/20 pb-xs">
                            <span class="font-body-sm">Active Listings</span>
                            <span class="font-headline-sm">{{ number_format($totalBusinesses ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between border-b border-on-secondary-container/20 pb-xs">
                            <span class="font-body-sm">Categories</span>
                            <span class="font-headline-sm">{{ number_format($featuredCategories->count() ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between pb-xs">
                            <span class="font-body-sm">Regions Covered</span>
                            <span class="font-headline-sm">16</span>
                        </div>
                    </div>
                </div>
            </aside>
        </section>
    </div>
</div>

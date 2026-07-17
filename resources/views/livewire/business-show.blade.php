@php use Illuminate\Support\Str; @endphp
<div class="max-w-7xl mx-auto px-container-margin py-lg space-y-xl">
    <!-- Hero Section: Logo & Info -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <div class="lg:col-span-4 flex flex-col gap-md">
            <div class="border-[1.5px] border-on-surface p-md bg-surface flex flex-col items-center text-center market-shadow">
                <div class="w-32 h-32 mb-md border-[1.5px] border-on-surface overflow-hidden">
                    @if($business->getFirstMediaUrl('logo'))
                        <img src="{{ $business->getFirstMediaUrl('logo') }}" alt="{{ $business->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-surface-container-highest flex items-center justify-center">
                            <span class="material-symbols-outlined text-[48px] text-on-surface-variant/30">store</span>
                        </div>
                    @endif
                </div>
                <h1 class="font-display-lg text-display-lg text-on-surface mb-xs">{{ $business->name }}</h1>
                @if($business->category)
                    <span class="font-label-caps text-label-caps text-secondary border-[1.5px] border-secondary px-sm py-unit mb-xs">{{ $business->category->name }}</span>
                @endif
                @if($averageRating)
                    <div class="flex items-center gap-xs text-tertiary-fixed-dim font-bold">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="font-headline-sm">{{ number_format($averageRating, 1) }}</span>
                        <span class="font-label-caps text-[10px] text-on-surface-variant">({{ $reviewsCount }} reviews)</span>
                    </div>
                @endif
                @if($business->description)
                    <p class="mt-md font-body-sm text-on-surface-variant italic line-clamp-3">"{{ Str::limit($business->description, 150) }}"</p>
                @endif
            </div>

            <!-- Quick Actions / Info Block -->
            <div class="border-[1.5px] border-on-surface bg-surface-container p-md space-y-md kente-border">
                @if($business->address_text)
                    <div class="flex items-start gap-md">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <div>
                            <p class="font-label-caps text-label-caps opacity-70">ADDRESS</p>
                            <p class="font-body-md font-bold">{{ $business->address_text }}</p>
                            @if($business->ghanapost_gps)
                                <p class="font-body-sm text-primary font-bold mt-xs">GPS: {{ $business->ghanapost_gps }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                @if($business->region)
                    <div class="flex items-start gap-md">
                        <span class="material-symbols-outlined text-primary">map</span>
                        <div>
                            <p class="font-label-caps text-label-caps opacity-70">LOCATION</p>
                            <p class="font-body-md">{{ $business->region->name }}{{ $business->district ? ', '.$business->district->name : '' }}</p>
                        </div>
                    </div>
                @endif

                <div class="pt-md border-t border-outline-variant flex flex-wrap gap-sm">
                    @if($business->momo_mtn || $business->momo_vodafone || $business->momo_airteltigo)
                        <div class="flex items-center gap-xs bg-white border border-on-surface px-sm py-xs">
                            <span class="material-symbols-outlined text-tertiary">payments</span>
                            <span class="font-label-caps text-[10px]">MoMo Accepted</span>
                        </div>
                    @endif
                    @if($business->whatsapp_number)
                        <a href="{{ $business->whatsappLink() }}" target="_blank" class="flex-1 bg-secondary text-on-secondary font-label-caps text-label-caps py-sm flex items-center justify-center gap-sm market-shadow active:scale-95 transition-all">
                            <span class="material-symbols-outlined">chat</span>
                            WHATSAPP US
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Gallery Area -->
        <div class="lg:col-span-8 grid grid-cols-2 md:grid-cols-3 gap-gutter h-[400px] lg:h-[500px]">
            @php
                $galleryMedia = $business->getMedia('gallery');
            @endphp
            @if($galleryMedia->isNotEmpty())
                <div class="col-span-2 row-span-2 border-[1.5px] border-on-surface overflow-hidden relative group">
                    <img src="{{ $galleryMedia->first()->getUrl() }}" alt="{{ $business->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                @foreach($galleryMedia->slice(1, 3) as $media)
                    <div class="border-[1.5px] border-on-surface overflow-hidden relative group">
                        <img src="{{ $media->getUrl() }}" alt="{{ $business->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                @endforeach
            @else
                <div class="col-span-2 row-span-2 border-[1.5px] border-on-surface bg-surface-container-highest flex items-center justify-center">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-[80px] text-on-surface-variant/30">image</span>
                        <p class="font-body-sm text-on-surface-variant">No gallery images</p>
                    </div>
                </div>
                <div class="border-[1.5px] border-on-surface bg-surface-container-highest flex items-center justify-center">
                    <span class="material-symbols-outlined text-[40px] text-on-surface-variant/30">image</span>
                </div>
                <div class="border-[1.5px] border-on-surface bg-surface-container-highest flex items-center justify-center">
                    <span class="material-symbols-outlined text-[40px] text-on-surface-variant/30">image</span>
                </div>
            @endif
        </div>
    </section>

    <x-ad-slot zone="listing_banner" />

    <!-- Contact Info -->
    <section class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        <div class="md:col-span-8 space-y-lg">
            <!-- Contact Details -->
            <div class="border-[1.5px] border-on-surface bg-surface p-lg">
                <h2 class="font-headline-md text-headline-md mb-lg flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary">contact_page</span>
                    Contact Information
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-lg">
                    @if($business->phone)
                        <div class="space-y-xs">
                            <p class="font-label-caps text-label-caps text-on-surface-variant">PHONE</p>
                            <a href="tel:{{ $business->phone }}" class="font-body-md font-bold hover:text-primary transition-colors flex items-center gap-sm">
                                <span class="material-symbols-outlined text-secondary">call</span>
                                {{ $business->phone }}
                            </a>
                        </div>
                    @endif
                    @if($business->whatsapp_number)
                        <div class="space-y-xs">
                            <p class="font-label-caps text-label-caps text-on-surface-variant">WHATSAPP</p>
                            <a href="{{ $business->whatsappLink() }}" target="_blank" class="font-body-md font-bold text-secondary hover:text-primary transition-colors flex items-center gap-sm">
                                <span class="material-symbols-outlined">chat</span>
                                Chat on WhatsApp
                            </a>
                        </div>
                    @endif
                    @if($business->email)
                        <div class="space-y-xs">
                            <p class="font-label-caps text-label-caps text-on-surface-variant">EMAIL</p>
                            <a href="mailto:{{ $business->email }}" class="font-body-md hover:text-primary transition-colors flex items-center gap-sm">
                                <span class="material-symbols-outlined text-primary">mail</span>
                                {{ $business->email }}
                            </a>
                        </div>
                    @endif
                    @if($business->website)
                        <div class="space-y-xs">
                            <p class="font-label-caps text-label-caps text-on-surface-variant">WEBSITE</p>
                            <a href="{{ $business->website }}" target="_blank" class="font-body-md hover:text-primary transition-colors flex items-center gap-sm">
                                <span class="material-symbols-outlined text-primary">language</span>
                                {{ Str::limit($business->website, 30) }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Mobile Money -->
            @if($business->momo_mtn || $business->momo_vodafone || $business->momo_airteltigo)
                <div class="border-[1.5px] border-on-surface bg-surface p-lg">
                    <h2 class="font-headline-md text-headline-md mb-lg flex items-center gap-sm">
                        <span class="material-symbols-outlined text-tertiary">payments</span>
                        Mobile Money
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-md">
                        @if($business->momo_mtn)
                            <div class="border-[1.5px] border-on-surface p-md bg-surface-container-low text-center">
                                <span class="material-symbols-outlined text-tertiary-container" style="font-variation-settings: 'FILL' 1;">sim_card</span>
                                <p class="font-label-caps text-label-caps mt-sm">MTN MoMo</p>
                                <p class="font-body-md font-bold">{{ $business->momo_mtn }}</p>
                            </div>
                        @endif
                        @if($business->momo_vodafone)
                            <div class="border-[1.5px] border-on-surface p-md bg-surface-container-low text-center">
                                <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">sim_card</span>
                                <p class="font-label-caps text-label-caps mt-sm">Telecel Cash</p>
                                <p class="font-body-md font-bold">{{ $business->momo_vodafone }}</p>
                            </div>
                        @endif
                        @if($business->momo_airteltigo)
                            <div class="border-[1.5px] border-on-surface p-md bg-surface-container-low text-center">
                                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">sim_card</span>
                                <p class="font-label-caps text-label-caps mt-sm">AirtelTigo Money</p>
                                <p class="font-body-md font-bold">{{ $business->momo_airteltigo }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Products & Services -->
            @if($business->products->isNotEmpty())
                <section class="space-y-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="font-headline-md text-headline-md text-primary border-b-4 border-primary pb-xs">Products & Services</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
                        @foreach($business->products as $product)
                            <div class="border-[1.5px] border-on-surface bg-surface market-shadow-hover p-md flex gap-md transition-all @if(!$product->is_available) opacity-60 @endif">
                                <div class="w-24 h-24 bg-surface-container-highest border-[1.5px] border-on-surface flex-shrink-0">
                                    @if($product->getFirstMediaUrl('product_photos'))
                                        <img src="{{ $product->getFirstMediaUrl('product_photos') }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-on-surface-variant/30">inventory_2</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col justify-between flex-grow">
                                    <div>
                                        <h4 class="font-headline-sm text-on-surface">{{ $product->name }}</h4>
                                        @if($product->description)
                                            <p class="font-body-sm text-on-surface-variant line-clamp-2">{{ $product->description }}</p>
                                        @endif
                                        @if($product->unit)
                                            <p class="font-body-sm text-on-surface-variant text-[11px]">Per {{ $product->unit }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center justify-between mt-sm">
                                        <span class="font-label-caps text-lg font-bold text-primary">{{ $product->formattedPrice() }}</span>
                                        @if($business->whatsapp_number)
                                            <a href="{{ $business->whatsappLink($product->whatsappEnquiryText()) }}" target="_blank" class="text-secondary font-bold text-body-sm hover:underline flex items-center gap-xs">
                                                <span class="material-symbols-outlined text-[14px]">chat</span>
                                                Enquire
                                            </a>
                                        @endif
                                    </div>
                                    @if(!$product->is_available)
                                        <span class="mt-xs font-label-caps text-[10px] text-error">CURRENTLY UNAVAILABLE</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Reviews -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-xl">
                <div class="lg:col-span-8 space-y-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="font-headline-md text-headline-md">Community Reviews</h2>
                        @auth
                            <button wire:click="$toggle('showReviewForm')" class="font-label-caps text-label-caps bg-primary text-on-primary px-lg py-sm border-[1.5px] border-on-surface pop-shadow hover:pop-shadow-yellow active:scale-95 transition-all flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[16px]">rate_review</span>
                                Write Review
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="font-label-caps text-label-caps text-primary underline">Login to review</a>
                        @endauth
                    </div>

                    @auth @if($showReviewForm) <livewire:review-form :business="$business" :key="'review-'.$business->id" /> @endif @endauth

                    <div class="space-y-lg">
                        @forelse($business->approvedReviews as $review)
                            <div class="border-[1.5px] border-on-surface p-lg space-y-md">
                                <div class="flex justify-between items-start">
                                    <div class="flex gap-md">
                                        <div class="w-12 h-12 bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-headline-sm border-[1.5px] border-on-surface">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-body-md font-bold">{{ $review->user->name }}</p>
                                            <p class="font-label-caps text-[10px] opacity-60">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-tertiary-container">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? 1 : 0 }};">star</span>
                                        @endfor
                                    </div>
                                </div>
                                <p class="font-body-md">{{ $review->body }}</p>
                                @if($review->owner_response)
                                    <div class="bg-surface-container-low p-md border-l-4 border-secondary ml-md">
                                        <p class="font-label-caps text-[10px] text-secondary font-bold mb-xs">{{ strtoupper($business->name) }} (OWNER)</p>
                                        <p class="font-body-sm italic">{{ $review->owner_response }}</p>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-lg border-[1.5px] border-dashed border-outline-variant p-lg">
                                <span class="material-symbols-outlined text-[48px] text-on-surface-variant/30">reviews</span>
                                <p class="font-body-md text-on-surface-variant mt-sm">No reviews yet.</p>
                                @auth
                                    <button wire:click="$set('showReviewForm', true)" class="mt-md font-label-caps text-label-caps text-primary underline">Be the first to review</button>
                                @endauth
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Rating Summary Sidebar -->
                <div class="lg:col-span-4">
                    <div class="border-[1.5px] border-on-surface p-lg bg-surface sticky top-28 market-shadow">
                        @if($averageRating)
                            <div class="text-center mb-lg">
                                <div class="text-[64px] font-display-lg leading-none text-primary">{{ number_format($averageRating, 1) }}</div>
                                <div class="flex justify-center text-tertiary-container my-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $diff = $averageRating - ($i - 1);
                                            $fill = $diff >= 1 ? 1 : ($diff > 0 ? 0.5 : 0);
                                        @endphp
                                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' {{ $fill }};">{{ $fill == 0.5 ? 'star_half' : 'star' }}</span>
                                    @endfor
                                </div>
                                <p class="font-label-caps text-label-caps opacity-60">BASED ON {{ $reviewsCount }} RATINGS</p>
                            </div>

                            @php
                                $ratingBreakdown = [];
                                $totalApproved = max($business->approvedReviews->count(), 1);
                                for($i = 5; $i >= 1; $i--) {
                                    $count = $business->approvedReviews->where('rating', $i)->count();
                                    $ratingBreakdown[$i] = [
                                        'count' => $count,
                                        'percent' => round(($count / $totalApproved) * 100)
                                    ];
                                }
                            @endphp

                            <div class="space-y-sm mb-lg">
                                @foreach($ratingBreakdown as $star => $data)
                                    <div class="flex items-center gap-md">
                                        <span class="font-label-caps text-[10px] w-4">{{ $star }}</span>
                                        <div class="flex-grow h-2 bg-surface-container-highest">
                                            <div class="h-full bg-secondary" style="width: {{ $data['percent'] }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center mb-lg py-lg">
                                <span class="material-symbols-outlined text-[60px] text-on-surface-variant/30">reviews</span>
                                <p class="font-body-md text-on-surface-variant">No ratings yet</p>
                            </div>
                        @endif

                        @auth
                            <button wire:click="$set('showReviewForm', true)" class="w-full bg-primary text-on-primary font-label-caps text-label-caps py-md market-shadow hover:brightness-110 active:scale-95 transition-all">WRITE A REVIEW</button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-primary text-on-primary font-label-caps text-label-caps py-md market-shadow text-center">LOGIN TO REVIEW</a>
                        @endauth
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="md:col-span-4 space-y-lg">
            <div class="border-[1.5px] border-on-surface bg-surface p-lg sticky top-28">
                <h3 class="font-headline-sm text-headline-sm mb-lg">Quick Actions</h3>
                <div class="space-y-md">
                    @if($business->whatsapp_number)
                        <a href="{{ $business->whatsappLink() }}" target="_blank" class="w-full bg-secondary text-on-secondary font-label-caps text-label-caps py-md border-[1.5px] border-on-surface market-shadow active:scale-95 transition-all flex items-center justify-center gap-sm">
                            <span class="material-symbols-outlined">chat</span>
                            WhatsApp
                        </a>
                    @endif
                    @if($business->phone)
                        <a href="tel:{{ $business->phone }}" class="w-full bg-on-surface text-background font-label-caps text-label-caps py-md border-[1.5px] border-on-surface hover:bg-primary hover:text-on-primary active:scale-95 transition-all flex items-center justify-center gap-sm">
                            <span class="material-symbols-outlined">call</span>
                            Call Now
                        </a>
                    @endif
                    @if($business->address_text)
                        <a href="https://maps.google.com/?q={{ urlencode($business->address_text) }}" target="_blank" class="w-full border-[1.5px] border-on-surface py-md font-label-caps text-label-caps hover:bg-surface-container-high active:scale-95 transition-all flex items-center justify-center gap-sm">
                            <span class="material-symbols-outlined">directions</span>
                            Directions
                        </a>
                    @endif
                </div>
                @if($business->views_count)
                    <div class="mt-lg pt-lg border-t-[1.5px] border-outline-variant text-center">
                        <span class="material-symbols-outlined text-on-surface-variant/50">visibility</span>
                        <p class="font-label-caps text-label-caps text-on-surface-variant">{{ number_format($business->views_count) }} views</p>
                    </div>
                @endif
            </div>
            <x-ad-slot zone="listing_sidebar" />
        </div>
    </section>
</div>

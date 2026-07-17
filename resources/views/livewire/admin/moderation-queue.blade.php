<div class="min-h-screen bg-[#fcf9f8]">
    {{-- Kente Header Strip --}}
    <div class="h-1.5 w-full" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Back + Header --}}
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#6b7280] font-['Inter'] hover:text-[#b90027] transition-colors group">
                <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                Dashboard
            </a>
            <span class="text-[#d1d5db]">/</span>
            <span class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">Moderation Queue</span>
        </div>

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-lg bg-[#b90027] flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-xl">gavel</span>
                </div>
                <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#b90027] bg-[#fef2f4] px-3 py-1 rounded-full border border-[#b90027]/20">Admin</span>
            </div>
            <h1 class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Moderation Queue</h1>
            <p class="text-[#6b7280] font-['Inter'] mt-1">Review and moderate businesses and customer reviews</p>
        </div>

        {{-- Flash Message --}}
        @if(session('message'))
            <div class="mb-6 p-4 rounded-xl bg-[#f0fdf4] border-[1.5px] border-[#316948] flex items-center gap-3 shadow-[3px_3px_0px_#316948]">
                <span class="material-symbols-outlined text-[#316948] text-xl flex-shrink-0">check_circle</span>
                <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('message') }}</p>
            </div>
        @endif

        {{-- ─── Tab Navigation ───────────────────────────────────────────── --}}
        <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] mb-6 overflow-hidden">
            <div class="flex border-b border-[#e5e2e1]">
                {{-- Tab: Businesses --}}
                <button
                    wire:click="$set('tab', 'businesses')"
                    class="flex-1 flex items-center justify-center gap-2 px-5 py-4 text-sm font-bold font-['Inter'] transition-all duration-200 border-b-4 {{ $tab === 'businesses' ? 'border-[#b90027] text-[#b90027] bg-[#fef2f4]' : 'border-transparent text-[#6b7280] hover:text-[#1c1b1b] hover:bg-[#f6f3f2]' }}"
                >
                    <span class="material-symbols-outlined text-lg">store</span>
                    <span>Pending Businesses</span>
                    <span class="text-[10px] font-bold font-['JetBrains_Mono'] {{ $tab === 'businesses' ? 'bg-[#b90027] text-white' : 'bg-[#f6f3f2] text-[#6b7280]' }} px-2 py-0.5 rounded-full">
                        {{ $pendingBusinesses->total() }}
                    </span>
                </button>

                {{-- Tab: Flagged --}}
                <button
                    wire:click="$set('tab', 'flagged')"
                    class="flex-1 flex items-center justify-center gap-2 px-5 py-4 text-sm font-bold font-['Inter'] transition-all duration-200 border-b-4 {{ $tab === 'flagged' ? 'border-[#b90027] text-[#b90027] bg-[#fef2f4]' : 'border-transparent text-[#6b7280] hover:text-[#1c1b1b] hover:bg-[#f6f3f2]' }}"
                >
                    <span class="material-symbols-outlined text-lg">flag</span>
                    <span>Flagged</span>
                    @if($flaggedBusinesses->total() > 0)
                        <span class="text-[10px] font-bold font-['JetBrains_Mono'] bg-[#b90027] text-white px-2 py-0.5 rounded-full animate-pulse">
                            {{ $flaggedBusinesses->total() }}
                        </span>
                    @endif
                </button>

                {{-- Tab: Reviews --}}
                <button
                    wire:click="$set('tab', 'reviews')"
                    class="flex-1 flex items-center justify-center gap-2 px-5 py-4 text-sm font-bold font-['Inter'] transition-all duration-200 border-b-4 {{ $tab === 'reviews' ? 'border-[#b90027] text-[#b90027] bg-[#fef2f4]' : 'border-transparent text-[#6b7280] hover:text-[#1c1b1b] hover:bg-[#f6f3f2]' }}"
                >
                    <span class="material-symbols-outlined text-lg">rate_review</span>
                    <span>Reviews</span>
                    @if($pendingReviews->total() > 0)
                        <span class="text-[10px] font-bold font-['JetBrains_Mono'] bg-[#745b00] text-white px-2 py-0.5 rounded-full">
                            {{ $pendingReviews->total() }}
                        </span>
                    @endif
                </button>
            </div>
        </div>

        {{-- ─── Tab: Pending Businesses ──────────────────────────────────── --}}
        @if($tab === 'businesses')
            <div class="space-y-4">
                @forelse($pendingBusinesses as $business)
                    <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] hover:shadow-[5px_5px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 overflow-hidden"
                         wire:key="biz-{{ $business->id }}">
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    {{-- Meta --}}
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase bg-[#fefce8] text-[#745b00] border border-[#745b00]/20 px-2 py-0.5 rounded-full">PENDING</span>
                                        @if($business->category)
                                            <span class="text-[10px] font-['JetBrains_Mono'] text-[#6b7280] bg-[#f6f3f2] px-2 py-0.5 rounded-full">{{ $business->category->name }}</span>
                                        @endif
                                        @if($business->region)
                                            <span class="text-[10px] font-['JetBrains_Mono'] text-[#6b7280] flex items-center gap-0.5">
                                                <span class="material-symbols-outlined text-xs">location_on</span>
                                                {{ $business->region->name }}
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-1">{{ $business->name }}</h3>
                                    <p class="text-xs text-[#9ca3af] font-['Inter'] mb-3">
                                        Submitted by <span class="font-semibold text-[#6b7280]">{{ $business->user?->name }}</span>
                                        · {{ $business->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-sm text-[#6b7280] font-['Inter'] line-clamp-2">{{ Str::limit($business->description, 200) }}</p>
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <a href="{{ route('business.show', $business) }}" target="_blank"
                                       class="p-2.5 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] hover:border-[#1c1b1b] hover:text-[#1c1b1b] transition-colors"
                                       title="View listing">
                                        <span class="material-symbols-outlined text-xl">open_in_new</span>
                                    </a>
                                    <button
                                        wire:click="flagBusiness({{ $business->id }})"
                                        wire:confirm="Flag '{{ $business->name }}'? It will be hidden from public listings."
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg border-[1.5px] border-[#b90027] text-[#b90027] font-bold font-['Inter'] text-xs hover:bg-[#b90027] hover:text-white transition-all"
                                    >
                                        <span class="material-symbols-outlined text-base">flag</span>
                                        Flag
                                    </button>
                                    <button
                                        wire:click="approveBusiness({{ $business->id }})"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg bg-[#316948] text-white font-bold font-['Inter'] text-xs border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] hover:shadow-[3px_3px_0px_#f1c100] hover:-translate-x-px hover:-translate-y-px transition-all"
                                    >
                                        <span class="material-symbols-outlined text-base">check_circle</span>
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] py-16 text-center">
                        <span class="material-symbols-outlined text-5xl text-[#9ca3af] mb-3 block">store</span>
                        <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">Queue is clear</p>
                        <p class="text-sm text-[#6b7280] font-['Inter']">No businesses currently pending moderation.</p>
                    </div>
                @endforelse
                @if($pendingBusinesses->hasPages())
                    <div class="mt-4">{{ $pendingBusinesses->links() }}</div>
                @endif
            </div>

        {{-- ─── Tab: Flagged ──────────────────────────────────────────────── --}}
        @elseif($tab === 'flagged')
            <div class="space-y-4">
                @forelse($flaggedBusinesses as $business)
                    <div class="bg-white rounded-xl border-[1.5px] border-[#b90027] shadow-[3px_3px_0px_#b90027] overflow-hidden"
                         wire:key="flag-{{ $business->id }}">
                        <div class="h-1 bg-[#b90027]"></div>
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase bg-[#fef2f4] text-[#b90027] border border-[#b90027]/20 px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">flag</span>
                                            FLAGGED
                                        </span>
                                        @if($business->category)
                                            <span class="text-[10px] font-['JetBrains_Mono'] text-[#6b7280] bg-[#f6f3f2] px-2 py-0.5 rounded-full">{{ $business->category->name }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-1">{{ $business->name }}</h3>
                                    <p class="text-xs text-[#9ca3af] font-['Inter'] mb-3">
                                        Owner: <span class="font-semibold text-[#6b7280]">{{ $business->user?->name }}</span>
                                        · Flagged {{ $business->updated_at->diffForHumans() }}
                                    </p>
                                    <p class="text-sm text-[#6b7280] font-['Inter'] line-clamp-2">{{ Str::limit($business->description, 200) }}</p>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <a href="{{ route('business.show', $business) }}" target="_blank"
                                       class="p-2.5 rounded-lg border-[1.5px] border-[#d1d5db] text-[#6b7280] hover:border-[#1c1b1b] hover:text-[#1c1b1b] transition-colors"
                                       title="View listing">
                                        <span class="material-symbols-outlined text-xl">open_in_new</span>
                                    </a>
                                    <button
                                        wire:click="approveBusiness({{ $business->id }})"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg bg-[#316948] text-white font-bold font-['Inter'] text-xs border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] hover:shadow-[3px_3px_0px_#f1c100] hover:-translate-x-px hover:-translate-y-px transition-all"
                                    >
                                        <span class="material-symbols-outlined text-base">check_circle</span>
                                        Unflag & Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] py-16 text-center">
                        <span class="material-symbols-outlined text-5xl text-[#9ca3af] mb-3 block">flag</span>
                        <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">No flagged businesses</p>
                        <p class="text-sm text-[#6b7280] font-['Inter']">All clear — no businesses have been flagged.</p>
                    </div>
                @endforelse
                @if($flaggedBusinesses->hasPages())
                    <div class="mt-4">{{ $flaggedBusinesses->links() }}</div>
                @endif
            </div>

        {{-- ─── Tab: Reviews ──────────────────────────────────────────────── --}}
        @elseif($tab === 'reviews')
            <div class="space-y-4">
                @forelse($pendingReviews as $review)
                    <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] overflow-hidden"
                         wire:key="review-{{ $review->id }}">
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    {{-- Reviewer Info + Rating --}}
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 rounded-full bg-[#1c1b1b] flex items-center justify-center border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] flex-shrink-0">
                                            <span class="text-sm font-black text-white font-['Bricolage_Grotesque']">{{ strtoupper(substr($review->user?->name ?? 'U', 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-[#1c1b1b] font-['Inter']">{{ $review->user?->name ?? 'Anonymous' }}</p>
                                            <div class="flex items-center gap-2">
                                                <div class="flex items-center gap-0.5">
                                                    @for($s = 1; $s <= 5; $s++)
                                                        <span class="material-symbols-outlined text-sm {{ $s <= $review->rating ? 'text-[#f1c100]' : 'text-[#d1d5db]' }}"
                                                              style="{{ $s <= $review->rating ? 'font-variation-settings: \'FILL\' 1' : '' }}">star</span>
                                                    @endfor
                                                    <span class="ml-1 text-xs font-bold font-['JetBrains_Mono'] text-[#1c1b1b]">{{ $review->rating }}/5</span>
                                                </div>
                                                <span class="text-xs text-[#9ca3af] font-['Inter']">on</span>
                                                <a href="{{ route('business.show', $review->business) }}" target="_blank"
                                                   class="text-xs font-semibold text-[#b90027] hover:underline font-['Inter']">{{ $review->business?->name }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Review Body --}}
                                    <div class="bg-[#f6f3f2] rounded-lg p-4 mb-2 border-l-4 border-[#745b00]">
                                        <p class="text-sm text-[#1c1b1b] font-['Inter'] italic">"{{ $review->body }}"</p>
                                    </div>
                                    <p class="text-xs text-[#9ca3af] font-['JetBrains_Mono']">Submitted {{ $review->created_at->diffForHumans() }}</p>
                                </div>

                                {{-- Actions --}}
                                <div class="flex flex-col gap-2 flex-shrink-0 min-w-[140px]">
                                    <button
                                        wire:click="approveReview({{ $review->id }})"
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-lg bg-[#316948] text-white font-bold font-['Inter'] text-xs border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] hover:shadow-[3px_3px_0px_#f1c100] hover:-translate-x-px hover:-translate-y-px transition-all"
                                    >
                                        <span class="material-symbols-outlined text-base">check_circle</span>
                                        Approve
                                    </button>
                                    <button
                                        wire:click="flagReview({{ $review->id }})"
                                        wire:confirm="Flag this review? It will be hidden from the business listing."
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-lg border-[1.5px] border-[#b90027] text-[#b90027] font-bold font-['Inter'] text-xs hover:bg-[#b90027] hover:text-white transition-all"
                                    >
                                        <span class="material-symbols-outlined text-base">flag</span>
                                        Flag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] py-16 text-center">
                        <span class="material-symbols-outlined text-5xl text-[#9ca3af] mb-3 block">rate_review</span>
                        <p class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] mb-1">All reviews moderated</p>
                        <p class="text-sm text-[#6b7280] font-['Inter']">No pending reviews at this time.</p>
                    </div>
                @endforelse
                @if($pendingReviews->hasPages())
                    <div class="mt-4">{{ $pendingReviews->links() }}</div>
                @endif
            </div>
        @endif

    </div>
</div>

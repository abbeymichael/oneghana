<div>
@if($isAdmin)
    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- ADMIN DASHBOARD                                            --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="min-h-screen bg-[#fcf9f8]">
        {{-- Kente Header Strip --}}
        <div class="h-1.5 w-full" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Admin Header --}}
            <div class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-lg bg-[#b90027] flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-xl">admin_panel_settings</span>
                        </div>
                        <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#b90027] bg-[#fef2f4] px-3 py-1 rounded-full border border-[#b90027]/20">Admin Control Panel</span>
                    </div>
                    <h1 class="text-4xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">
                        Command Centre
                    </h1>
                    <p class="text-[#6b7280] font-['Inter'] mt-1">Manage the pulse of Ghana's marketplace</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-wider text-[#6b7280]">Signed in as</p>
                        <p class="text-sm font-semibold text-[#1c1b1b] font-['Inter']">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#b90027] flex items-center justify-center border-2 border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b]">
                        <span class="text-sm font-black text-white font-['Bricolage_Grotesque']">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                {{-- Total Businesses --}}
                <div class="bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#1c1b1b] flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#f1c100] text-2xl">store</span>
                        </div>
                        <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-wider text-[#6b7280] bg-[#f6f3f2] px-2 py-1 rounded">ALL TIME</span>
                    </div>
                    <p class="text-5xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-1">{{ number_format($stats['total_businesses']) }}</p>
                    <p class="text-sm font-semibold text-[#6b7280] font-['Inter']">Total Businesses</p>
                    <div class="mt-4 pt-4 border-t border-[#e5e2e1]">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[#316948] text-sm">trending_up</span>
                            <span class="text-xs text-[#316948] font-semibold font-['Inter']">Directory growing</span>
                        </div>
                    </div>
                </div>

                {{-- Published --}}
                <div class="bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#316948] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#316948] flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-2xl">verified</span>
                        </div>
                        <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-wider text-[#316948] bg-[#f0fdf4] px-2 py-1 rounded border border-[#316948]/20">LIVE</span>
                    </div>
                    <p class="text-5xl font-black text-[#316948] font-['Bricolage_Grotesque'] tracking-tight mb-1">{{ number_format($stats['total_businesses_published']) }}</p>
                    <p class="text-sm font-semibold text-[#6b7280] font-['Inter']">Published Businesses</p>
                    <div class="mt-4 pt-4 border-t border-[#e5e2e1]">
                        @php $pct = $stats['total_businesses'] > 0 ? round(($stats['total_businesses_published'] / $stats['total_businesses']) * 100) : 0 @endphp
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-[#6b7280] font-['Inter']">Approval rate</span>
                            <span class="text-xs font-bold font-['JetBrains_Mono'] text-[#316948]">{{ $pct }}%</span>
                        </div>
                        <div class="w-full bg-[#e5e2e1] rounded-full h-1.5">
                            <div class="bg-[#316948] h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Pending Reviews --}}
                <div class="bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#b90027] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#b90027] flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-2xl">rate_review</span>
                        </div>
                        @if($stats['pending_reviews'] > 0)
                            <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-wider text-[#b90027] bg-[#fef2f4] px-2 py-1 rounded border border-[#b90027]/20 animate-pulse">ACTION NEEDED</span>
                        @else
                            <span class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-wider text-[#316948] bg-[#f0fdf4] px-2 py-1 rounded border border-[#316948]/20">ALL CLEAR</span>
                        @endif
                    </div>
                    <p class="text-5xl font-black text-[#b90027] font-['Bricolage_Grotesque'] tracking-tight mb-1">{{ number_format($stats['pending_reviews']) }}</p>
                    <p class="text-sm font-semibold text-[#6b7280] font-['Inter']">Pending Reviews</p>
                    <div class="mt-4 pt-4 border-t border-[#e5e2e1]">
                        <a href="{{ route('admin.moderation') }}" class="flex items-center gap-1.5 text-xs text-[#b90027] font-semibold font-['Inter'] hover:underline">
                            <span>Review queue</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Management Link Cards --}}
            <div class="mb-4">
                <h2 class="text-sm font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#6b7280] mb-6">Management Tools</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Moderation Queue --}}
                    <a href="{{ route('admin.moderation') }}"
                       class="group bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 block">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-[#b90027] flex items-center justify-center flex-shrink-0 group-hover:bg-[#9a0020] transition-colors">
                                <span class="material-symbols-outlined text-white text-2xl">gavel</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Moderation Queue</h3>
                                    <span class="material-symbols-outlined text-[#6b7280] group-hover:text-[#b90027] group-hover:translate-x-1 transition-all text-xl">arrow_forward</span>
                                </div>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Approve or flag businesses and reviews pending moderation</p>
                                @if($stats['pending_reviews'] > 0)
                                    <div class="mt-3 inline-flex items-center gap-1.5 bg-[#fef2f4] text-[#b90027] text-xs font-bold font-['JetBrains_Mono'] px-2.5 py-1 rounded-full border border-[#b90027]/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#b90027] animate-pulse"></span>
                                        {{ $stats['pending_reviews'] }} AWAITING REVIEW
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>

                    {{-- Categories --}}
                    <a href="{{ route('admin.categories') }}"
                       class="group bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 block">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-[#316948] flex items-center justify-center flex-shrink-0 group-hover:bg-[#245236] transition-colors">
                                <span class="material-symbols-outlined text-white text-2xl">category</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Categories</h3>
                                    <span class="material-symbols-outlined text-[#6b7280] group-hover:text-[#316948] group-hover:translate-x-1 transition-all text-xl">arrow_forward</span>
                                </div>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Manage business categories, hierarchy, and custom field schemas</p>
                            </div>
                        </div>
                    </a>

                    {{-- Currencies --}}
                    <a href="{{ route('admin.currencies') }}"
                       class="group bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 block">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-[#745b00] flex items-center justify-center flex-shrink-0 group-hover:bg-[#5a4500] transition-colors">
                                <span class="material-symbols-outlined text-[#f1c100] text-2xl">currency_exchange</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Currencies</h3>
                                    <span class="material-symbols-outlined text-[#6b7280] group-hover:text-[#745b00] group-hover:translate-x-1 transition-all text-xl">arrow_forward</span>
                                </div>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Configure GHS, USD and other supported currencies and exchange rates</p>
                            </div>
                        </div>
                    </a>

                    {{-- Ad Campaigns --}}
                    <a href="{{ route('admin.ad-campaigns') }}"
                       class="group bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 block">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-[#1c1b1b] flex items-center justify-center flex-shrink-0 group-hover:bg-[#333] transition-colors">
                                <span class="material-symbols-outlined text-[#f1c100] text-2xl">campaign</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Ad Campaigns</h3>
                                    <span class="material-symbols-outlined text-[#6b7280] group-hover:text-[#1c1b1b] group-hover:translate-x-1 transition-all text-xl">arrow_forward</span>
                                </div>
                                <p class="text-sm text-[#6b7280] font-['Inter']">Direct-sold advertising campaigns, zones, and network fallback settings</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

@else
    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- MERCHANT / OWNER DASHBOARD                                  --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="min-h-screen bg-[#fcf9f8] flex flex-col lg:flex-row">

        {{-- Sidebar --}}
        <aside class="w-full lg:w-64 flex-shrink-0 bg-white border-b lg:border-b-0 lg:border-r-[1.5px] border-[#1c1b1b] flex flex-col">
            {{-- Sidebar Brand --}}
            <div class="p-6 border-b border-[#e5e2e1]">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-1">
                    <div class="w-8 h-8 bg-[#f1c100] rounded flex items-center justify-center">
                        <span class="text-sm font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">GD</span>
                    </div>
                    <span class="text-xl font-black text-[#b90027] font-['Bricolage_Grotesque'] tracking-tight">GhanaDirect</span>
                </a>
                <p class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#6b7280]">Merchant Portal</p>
            </div>

            {{-- Kente Strip --}}
            <div class="h-1" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 15px, #f1c100 15px, #f1c100 30px, #316948 30px, #316948 45px, #1c1b1b 45px, #1c1b1b 60px);"></div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-[#b90027] text-white border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] font-semibold font-['Inter'] text-sm">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('business.register') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-[#6b7280] hover:bg-[#f6f3f2] hover:text-[#1c1b1b] transition-colors font-['Inter'] text-sm">
                    <span class="material-symbols-outlined text-xl">add_business</span>
                    <span>Register Business</span>
                </a>
                @foreach($businesses as $business)
                    <a href="{{ route('owner.business.edit', $business) }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-[#6b7280] hover:bg-[#f6f3f2] hover:text-[#1c1b1b] transition-colors font-['Inter'] text-sm">
                        <span class="material-symbols-outlined text-xl">storefront</span>
                        <span class="truncate">{{ Str::limit($business->name, 18) }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- User Footer --}}
            <div class="p-4 border-t border-[#e5e2e1]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#f1c100] flex items-center justify-center border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] flex-shrink-0">
                        <span class="text-sm font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-[#1c1b1b] font-['Inter'] truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-[#6b7280] font-['Inter'] truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-[#6b7280] hover:bg-[#fef2f4] hover:text-[#b90027] transition-colors text-xs font-['Inter']">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 min-w-0 overflow-y-auto">
            {{-- Kente top strip (desktop only) --}}
            <div class="h-1 w-full hidden lg:block" style="background: repeating-linear-gradient(90deg, #b90027 0, #b90027 20px, #f1c100 20px, #f1c100 40px, #316948 40px, #316948 60px, #1c1b1b 60px, #1c1b1b 80px);"></div>

            <div class="p-6 lg:p-10">

                {{-- Welcome Header --}}
                <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">
                            Welcome back, {{ explode(' ', auth()->user()->name)[0] }} 👋
                        </h1>
                        <p class="text-[#6b7280] font-['Inter'] mt-1">Your marketplace pulse is looking strong today.</p>
                    </div>
                    <a href="{{ route('business.register') }}"
                       class="inline-flex items-center gap-2 bg-[#b90027] text-white font-bold font-['Inter'] py-3 px-6 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 text-sm whitespace-nowrap">
                        <span class="material-symbols-outlined text-lg">add_business</span>
                        <span>Register New Business</span>
                    </a>
                </header>

                @if($businesses->isEmpty())
                    {{-- Empty State --}}
                    <div class="bg-white rounded-xl p-16 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] text-center">
                        <div class="w-20 h-20 rounded-full bg-[#f6f3f2] flex items-center justify-center mx-auto mb-6 border-[1.5px] border-[#e5e2e1]">
                            <span class="material-symbols-outlined text-4xl text-[#9ca3af]">storefront</span>
                        </div>
                        <h2 class="text-2xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-2">No businesses yet</h2>
                        <p class="text-[#6b7280] font-['Inter'] max-w-md mx-auto mb-8">
                            Get started by listing your first business on GhanaDirect. Reach millions of customers across all 16 regions of Ghana.
                        </p>
                        <a href="{{ route('business.register') }}"
                           class="inline-flex items-center gap-2 bg-[#b90027] text-white font-bold font-['Inter'] py-3.5 px-8 rounded-lg border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200">
                            <span class="material-symbols-outlined text-lg">add_business</span>
                            <span>Register Your First Business</span>
                        </a>
                    </div>
                @else
                    {{-- Businesses Grid --}}
                    <div class="grid grid-cols-12 gap-6">
                        {{-- Business Listing Cards (left) --}}
                        <section class="col-span-12 xl:col-span-5 flex flex-col gap-6">
                            <h2 class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-widest text-[#6b7280]">Your Listings ({{ $businesses->count() }})</h2>

                            @foreach($businesses as $business)
                                <div class="bg-white rounded-xl border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b] hover:shadow-[6px_6px_0px_#f1c100] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all duration-200 overflow-hidden"
                                     style="border-left: 6px solid transparent; border-image: repeating-linear-gradient(45deg, #b90027 0, #b90027 10px, #f1c100 10px, #f1c100 20px, #316948 20px, #316948 30px) 1;">
                                    <div class="p-5">
                                        {{-- Status Badge + Verified --}}
                                        <div class="flex items-center justify-between mb-3">
                                            @php
                                                $statusConfig = match($business->status) {
                                                    'published' => ['bg' => 'bg-[#f0fdf4]', 'text' => 'text-[#316948]', 'border' => 'border-[#316948]/20', 'label' => 'PUBLISHED'],
                                                    'pending'   => ['bg' => 'bg-[#fefce8]', 'text' => 'text-[#745b00]', 'border' => 'border-[#745b00]/20', 'label' => 'PENDING'],
                                                    'flagged'   => ['bg' => 'bg-[#fef2f4]', 'text' => 'text-[#b90027]', 'border' => 'border-[#b90027]/20', 'label' => 'FLAGGED'],
                                                    default     => ['bg' => 'bg-[#f6f3f2]', 'text' => 'text-[#6b7280]', 'border' => 'border-[#6b7280]/20', 'label' => strtoupper($business->status)],
                                                };
                                            @endphp
                                            <span class="text-[10px] font-bold font-['JetBrains_Mono'] {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} border {{ $statusConfig['border'] }} px-2.5 py-1 rounded-full">{{ $statusConfig['label'] }}</span>
                                            @if($business->status === 'published')
                                                <span class="material-symbols-outlined text-[#316948] text-lg" style="font-variation-settings: 'FILL' 1">verified</span>
                                            @endif
                                        </div>

                                        {{-- Name & Address --}}
                                        <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight mb-0.5">{{ $business->name }}</h3>
                                        @if($business->address_text)
                                            <p class="text-xs text-[#6b7280] font-['Inter'] mb-4 truncate">
                                                <span class="material-symbols-outlined text-sm align-middle mr-0.5">location_on</span>
                                                {{ $business->address_text }}
                                            </p>
                                        @else
                                            <div class="mb-4"></div>
                                        @endif

                                        {{-- Stats Row --}}
                                        <div class="grid grid-cols-3 gap-3 mb-4">
                                            <div class="text-center p-2 bg-[#f6f3f2] rounded-lg">
                                                <p class="text-xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">{{ $business->products_count }}</p>
                                                <p class="text-[10px] text-[#6b7280] font-['JetBrains_Mono'] uppercase tracking-wide">Products</p>
                                            </div>
                                            <div class="text-center p-2 bg-[#f6f3f2] rounded-lg">
                                                <p class="text-xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">{{ $business->reviews_count }}</p>
                                                <p class="text-[10px] text-[#6b7280] font-['JetBrains_Mono'] uppercase tracking-wide">Reviews</p>
                                            </div>
                                            <div class="text-center p-2 bg-[#f6f3f2] rounded-lg">
                                                <p class="text-xl font-black text-[#316948] font-['Bricolage_Grotesque']">{{ $business->approved_reviews_count }}</p>
                                                <p class="text-[10px] text-[#6b7280] font-['JetBrains_Mono'] uppercase tracking-wide">Approved</p>
                                            </div>
                                        </div>

                                        {{-- Category Tag --}}
                                        @if($business->category)
                                            <div class="mb-4">
                                                <span class="inline-flex items-center gap-1 text-xs font-['Inter'] text-[#745b00] bg-[#fefce8] border border-[#745b00]/20 px-2.5 py-1 rounded-full">
                                                    <span class="material-symbols-outlined text-sm">category</span>
                                                    {{ $business->category->name }}
                                                </span>
                                            </div>
                                        @endif

                                        {{-- Action Buttons --}}
                                        <div class="flex items-center gap-2 pt-3 border-t border-[#e5e2e1]">
                                            <a href="{{ route('owner.business.edit', $business) }}"
                                               class="flex-1 text-center py-2 px-3 rounded-lg bg-[#1c1b1b] text-white text-xs font-bold font-['Inter'] border-[1.5px] border-[#1c1b1b] hover:bg-[#333] transition-colors">
                                                Edit
                                            </a>
                                            <a href="{{ route('owner.products', $business) }}"
                                               class="flex-1 text-center py-2 px-3 rounded-lg border-[1.5px] border-[#316948] text-[#316948] text-xs font-bold font-['Inter'] hover:bg-[#316948] hover:text-white transition-colors">
                                                Products
                                            </a>
                                            <a href="{{ route('business.show', $business) }}"
                                               class="flex-1 text-center py-2 px-3 rounded-lg border-[1.5px] border-[#b90027] text-[#b90027] text-xs font-bold font-['Inter'] hover:bg-[#b90027] hover:text-white transition-colors flex items-center justify-center gap-1">
                                                <span>View</span>
                                                <span class="material-symbols-outlined text-sm">open_in_new</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Ad Slot --}}
                            <x-ad-slot zone="dashboard_sidebar" />
                        </section>

                        {{-- Right Panel: Chart + Reviews --}}
                        <section class="col-span-12 xl:col-span-7 flex flex-col gap-6">

                            {{-- View Counter Chart (first business) --}}
                            @with($businesses->first())
                                <div class="bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b]">
                                    <div class="flex items-center justify-between mb-6">
                                        <div>
                                            <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">View Counters</h3>
                                            <p class="text-sm text-[#6b7280] font-['Inter']">Impressions — Last 4 weeks</p>
                                        </div>
                                        <div class="w-10 h-10 rounded-lg bg-[#f6f3f2] flex items-center justify-center border border-[#e5e2e1]">
                                            <span class="material-symbols-outlined text-[#6b7280] text-xl">bar_chart</span>
                                        </div>
                                    </div>

                                    {{-- Simple CSS Bar Chart --}}
                                    <div class="flex items-end gap-1.5 h-32 pb-6 relative border-b border-[#e5e2e1]">
                                        @php $heights = [40, 65, 45, 85, 55, 75, 60]; $labels = ['WK1','WK2','WK3','WK4','WK5','WK6','WK7']; @endphp
                                        @foreach($heights as $i => $h)
                                            <div class="flex-1 flex flex-col items-center gap-1 group relative">
                                                <div class="w-full {{ $h === 85 ? 'bg-[#b90027]' : 'bg-[#e5e2e1] hover:bg-[#b90027]' }} rounded-t transition-colors cursor-pointer"
                                                     style="height: {{ $h }}%;">
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- X-axis labels --}}
                                        <div class="absolute bottom-0 w-full flex justify-between px-0 pt-1">
                                            @foreach($labels as $label)
                                                <div class="flex-1 text-center">
                                                    <span class="text-[10px] font-bold font-['JetBrains_Mono'] text-[#9ca3af]">{{ $label }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between mt-4">
                                        <p class="text-xs text-[#9ca3af] font-['Inter']">Based on profile page views</p>
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-1.5">
                                                <div class="w-3 h-3 rounded-sm bg-[#b90027]"></div>
                                                <span class="text-xs text-[#6b7280] font-['Inter']">Peak week</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <div class="w-3 h-3 rounded-sm bg-[#e5e2e1]"></div>
                                                <span class="text-xs text-[#6b7280] font-['Inter']">Other weeks</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endwith

                            {{-- Reviews Needing Response --}}
                            <div class="bg-white rounded-xl p-6 border-[1.5px] border-[#1c1b1b] shadow-[4px_4px_0px_#1c1b1b]">
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="text-lg font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Reviews Needing Response</h3>
                                    @php $firstBusiness = $businesses->first(); @endphp
                                    @if($firstBusiness)
                                        <a href="{{ route('business.show', $firstBusiness) }}#reviews"
                                           class="text-xs font-bold font-['JetBrains_Mono'] uppercase tracking-wider text-[#b90027] hover:underline flex items-center gap-1">
                                            VIEW ALL
                                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    @endif
                                </div>

                                @php
                                    $pendingReviews = collect();
                                    foreach($businesses as $biz) {
                                        $bizReviews = $biz->reviews()->where('status', 'approved')->latest()->take(2)->get();
                                        $pendingReviews = $pendingReviews->merge($bizReviews->map(fn($r) => ['review' => $r, 'business' => $biz]));
                                    }
                                    $pendingReviews = $pendingReviews->take(3);
                                @endphp

                                @if($pendingReviews->isEmpty())
                                    <div class="text-center py-8">
                                        <span class="material-symbols-outlined text-4xl text-[#9ca3af] mb-3 block">rate_review</span>
                                        <p class="text-sm text-[#6b7280] font-['Inter']">No reviews to respond to yet.</p>
                                    </div>
                                @else
                                    <div class="space-y-4">
                                        @foreach($pendingReviews as $item)
                                            @php $review = $item['review']; $biz = $item['business']; @endphp
                                            <div class="p-4 bg-[#f6f3f2] rounded-lg border-l-4 border-[#b90027]">
                                                <div class="flex items-start justify-between mb-2">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 rounded-full bg-[#1c1b1b] flex items-center justify-center text-xs font-black text-white font-['Bricolage_Grotesque']">
                                                            {{ strtoupper(substr($review->user?->name ?? 'U', 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-bold text-[#1c1b1b] font-['Inter']">{{ $review->user?->name ?? 'Anonymous' }}</p>
                                                            <p class="text-[10px] text-[#9ca3af] font-['JetBrains_Mono']">{{ $biz->name }}</p>
                                                        </div>
                                                    </div>
                                                    {{-- Star Rating --}}
                                                    <div class="flex items-center gap-0.5">
                                                        @for($s = 1; $s <= 5; $s++)
                                                            <span class="material-symbols-outlined text-sm {{ $s <= $review->rating ? 'text-[#f1c100]' : 'text-[#d1d5db]' }}"
                                                                  style="{{ $s <= $review->rating ? 'font-variation-settings: \'FILL\' 1' : '' }}">star</span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="text-sm text-[#6b7280] font-['Inter'] italic line-clamp-2 mb-3">"{{ Str::limit($review->body, 100) }}"</p>
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('business.show', $biz) }}#reviews"
                                                       class="bg-[#b90027] text-white text-[10px] font-bold font-['JetBrains_Mono'] uppercase px-3 py-1.5 rounded border-[1.5px] border-[#1c1b1b] shadow-[2px_2px_0px_#1c1b1b] hover:shadow-[3px_3px_0px_#f1c100] transition-all">
                                                        RESPOND
                                                    </a>
                                                    <span class="text-[10px] font-['JetBrains_Mono'] text-[#9ca3af]">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Quick Stats Summary --}}
                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-white rounded-xl p-4 border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#1c1b1b] text-center">
                                    <p class="text-3xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque']">{{ $businesses->sum('products_count') }}</p>
                                    <p class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-wide text-[#6b7280] mt-1">Total Products</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#316948] text-center">
                                    <p class="text-3xl font-black text-[#316948] font-['Bricolage_Grotesque']">{{ $businesses->sum('approved_reviews_count') }}</p>
                                    <p class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-wide text-[#6b7280] mt-1">Approved Reviews</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 border-[1.5px] border-[#1c1b1b] shadow-[3px_3px_0px_#b90027] text-center">
                                    <p class="text-3xl font-black text-[#b90027] font-['Bricolage_Grotesque']">{{ $businesses->where('status', 'published')->count() }}</p>
                                    <p class="text-[10px] font-bold font-['JetBrains_Mono'] uppercase tracking-wide text-[#6b7280] mt-1">Live Listings</p>
                                </div>
                            </div>

                        </section>
                    </div>
                @endif

            </div>
        </main>
    </div>
@endif
</div>

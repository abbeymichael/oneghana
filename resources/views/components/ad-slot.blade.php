@php
    $zoneModel = \App\Models\AdZone::where('key', $zone)->with('activeCampaign')->first();
@endphp
@if($zoneModel && $zoneModel->activeCampaign)
    @php $campaign = $zoneModel->activeCampaign; $campaign->incrementImpressions(); @endphp
    <div class="bg-[#FFF9E6] border-[1.5px] border-dashed border-tertiary p-md relative my-lg">
        <span class="absolute top-sm right-sm font-label-caps text-[10px] text-tertiary">SPONSORED</span>
        <div class="mt-lg flex flex-col gap-md">
            <a href="{{ route('ads.click', $campaign) }}" target="_blank" rel="noopener">
                @if($campaign->getFirstMediaUrl('creative'))
                    <img src="{{ $campaign->getFirstMediaUrl('creative') }}" alt="Ad" class="w-full border-[1.5px] border-on-surface">
                @else
                    <div class="w-full bg-surface-container-highest border-[1.5px] border-on-surface p-md text-center">
                        <h4 class="font-headline-sm text-headline-sm text-tertiary">{{ $campaign->advertiser_name }}</h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $campaign->link_url }}</p>
                    </div>
                @endif
            </a>
            @if($campaign->link_url)
                <a href="{{ route('ads.click', $campaign) }}" target="_blank" class="w-full bg-on-surface text-surface py-sm font-label-caps text-label-caps text-center border-[1.5px] border-on-surface hover:bg-primary hover:text-on-primary active:scale-95 transition-all flex items-center justify-center gap-xs">
                    <span>Learn More</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            @endif
        </div>
    </div>
@elseif($zoneModel && $zoneModel->network_fallback_code)
    <div class="bg-[#FFF9E6] border-[1.5px] border-dashed border-tertiary p-md relative my-lg">
        <span class="absolute top-sm right-sm font-label-caps text-[10px] text-tertiary">SPONSORED</span>
        {!! $zoneModel->network_fallback_code !!}
    </div>
@else
    <div class="bg-[#FFF9E6] border-[1.5px] border-dashed border-tertiary p-md relative my-lg">
        <span class="absolute top-sm right-sm font-label-caps text-[10px] text-tertiary">SPONSORED</span>
        <div class="mt-lg flex flex-col items-center justify-center py-lg">
            <span class="material-symbols-outlined text-tertiary text-[40px]">campaign</span>
            <p class="font-body-sm text-on-surface-variant mt-sm">Ad Space Available</p>
        </div>
    </div>
@endif

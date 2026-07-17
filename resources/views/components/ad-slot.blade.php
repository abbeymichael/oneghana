@php
    $zoneModel = \App\Models\AdZone::where('key', $zone)->with('activeCampaign')->first();
@endphp
@if($zoneModel && $zoneModel->activeCampaign)
    @php $campaign = $zoneModel->activeCampaign; $campaign->incrementImpressions(); @endphp
    <div class="ad-slot my-6 text-center">
        <a href="{{ route('ads.click', $campaign) }}" target="_blank" rel="noopener">
            @if($campaign->getFirstMediaUrl('creative'))
                <img src="{{ $campaign->getFirstMediaUrl('creative') }}" alt="Ad" class="mx-auto max-w-full" style="max-width: {{ $zoneModel->width ?? 728 }}px; max-height: {{ $zoneModel->height ?? 90 }}px;">
            @else
                <div class="bg-gray-100 border border-dashed border-gray-300 rounded-lg p-6 inline-block"><p class="text-gray-500 text-sm">{{ $campaign->advertiser_name }}</p></div>
            @endif
        </a>
    </div>
@elseif($zoneModel && $zoneModel->network_fallback_code)
    <div class="ad-slot my-6 text-center">{!! $zoneModel->network_fallback_code !!}</div>
@else
    <div class="ad-slot my-6 text-center bg-gray-50 border border-dashed border-gray-200 rounded-lg p-8"><p class="text-gray-400 text-sm">Ad Space</p></div>
@endif

@php use Illuminate\Support\Str; @endphp
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Browse Businesses</h1>
        @auth<a href="{{ route('business.register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Register Business</a>@endauth
    </div>

    <div class="bg-white p-4 rounded-lg shadow border border-gray-200 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div><label class="block text-sm font-medium text-gray-700">Search</label><input wire:model.live.debounce.300ms="search" type="text" placeholder="Search..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700">Category</label>
                <select wire:model.live="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All</option>
                    @foreach($categories as $cat)<option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @foreach($cat->children as $child)<option value="{{ $child->slug }}">-- {{ $child->name }}</option>@endforeach
                    @endforeach
                </select>
            </div>
            <div><label class="block text-sm font-medium text-gray-700">Region</label>
                <select wire:model.live="region" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Regions</option>@foreach($regions as $r)<option value="{{ $r->name }}">{{ $r->name }}</option>@endforeach
                </select>
            </div>
            <div><label class="block text-sm font-medium text-gray-700">District</label>
                <select wire:model.live="district" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Districts</option>
                    @if($selectedRegion)@foreach($selectedRegion->districts as $d)<option value="{{ $d->name }}">{{ $d->name }}</option>@endforeach @endif
                </select>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div><label class="block text-sm font-medium text-gray-700">Sort By</label>
                <select wire:model.live="sort" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="latest">Latest</option><option value="name">Name</option><option value="views">Most Viewed</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($businesses as $business)
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden hover:shadow-md transition">
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-900"><a href="{{ route('business.show', $business) }}" class="hover:text-indigo-600">{{ $business->name }}</a></h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $business->category?->name }} · {{ $business->region?->name }}</p>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ Str::limit($business->description, 120) }}</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @if($business->phone)<span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">📞 {{ $business->phone }}</span>@endif
                        @if($business->whatsapp_number)<span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">💬 WhatsApp</span>@endif
                    </div>
                </div>
            </div>
        @empty<p class="col-span-full text-gray-500 text-center py-12">No businesses found.</p>@endforelse
    </div>
    <div class="mt-6">{{ $businesses->links() }}</div>
    <x-ad-slot zone="search_sidebar" />
</div>

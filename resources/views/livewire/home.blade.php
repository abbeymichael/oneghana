@php use Illuminate\Support\Str; @endphp
<div class="space-y-12">
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-16 -mt-6 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Ghana Business Directory</h1>
            <p class="text-xl mb-8">Discover businesses across all 16 regions of Ghana. Find local services, products, and companies near you.</p>
            <div class="max-w-xl mx-auto">
                <a href="{{ route('business.search') }}" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Browse All Businesses</a>
                @auth<a href="{{ route('business.register') }}" class="inline-block ml-4 bg-indigo-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-900 transition">Register Your Business</a>
                @else<a href="{{ route('register') }}" class="inline-block ml-4 bg-indigo-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-900 transition">List Your Business</a>@endauth
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($featuredCategories as $category)
                <a href="{{ route('business.search', ['category' => $category->slug]) }}" class="block p-4 bg-white rounded-lg shadow hover:shadow-md transition border border-gray-200">
                    <div class="text-lg font-semibold text-gray-900">{{ $category->name }}</div>
                    @if($category->children->count())<p class="text-sm text-gray-500 mt-1">{{ $category->children->count() }} subcategories</p>@endif
                </a>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Recently Added Businesses</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($recentListings as $business)
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900"><a href="{{ route('business.show', $business) }}" class="hover:text-indigo-600">{{ $business->name }}</a></h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $business->category?->name }} · {{ $business->region?->name }}</p>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ Str::limit($business->description, 150) }}</p>
                        @if($business->phone)<p class="text-sm text-gray-500 mt-2">📞 {{ $business->phone }}</p>@endif
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500 text-center py-8">No businesses listed yet.</p>
            @endforelse
        </div>
    </section>
    <x-ad-slot zone="homepage_banner" />
</div>

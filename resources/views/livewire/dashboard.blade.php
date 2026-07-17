<div>
    @if($isAdmin)
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Total Businesses</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_businesses'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Published</p>
                <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['total_businesses_published'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pending Reviews</p>
                <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $stats['pending_reviews'] }}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('admin.moderation') }}" class="block bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-gray-900">Moderation Queue</h2>
                <p class="text-sm text-gray-500 mt-1">Approve or flag businesses and reviews</p>
            </a>
            <a href="{{ route('admin.categories') }}" class="block bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-gray-900">Categories</h2>
                <p class="text-sm text-gray-500 mt-1">Manage business categories and custom fields</p>
            </a>
            <a href="{{ route('admin.currencies') }}" class="block bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-gray-900">Currencies</h2>
                <p class="text-sm text-gray-500 mt-1">Manage supported currencies</p>
            </a>
            <a href="{{ route('admin.ad-campaigns') }}" class="block bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-gray-900">Ad Campaigns</h2>
                <p class="text-sm text-gray-500 mt-1">Manage advertising campaigns</p>
            </a>
        </div>
    @else
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">My Businesses</h1>
            <a href="{{ route('business.register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">Register New Business</a>
        </div>

        @if($businesses->isEmpty())
            <div class="bg-white rounded-lg shadow border border-gray-200 p-12 text-center">
                <p class="text-gray-500 text-lg">You haven't registered any businesses yet.</p>
                <a href="{{ route('business.register') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Register Your First Business</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($businesses as $business)
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $business->name }}</h3>
                                <div class="mt-1 flex items-center space-x-3 text-sm text-gray-500">
                                    <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full text-xs">{{ $business->category?->name ?? 'Uncategorized' }}</span>
                                    <span>{{ $business->products_count }} products</span>
                                    <span>{{ $business->reviews_count }} reviews</span>
                                    <span>{{ $business->approved_reviews_count }} approved</span>
                                    <span class="capitalize">{{ $business->status }}</span>
                                    <span class="text-xs text-gray-400">{{ $business->views_count }} views</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('owner.business.edit', $business) }}" class="text-sm text-indigo-600 hover:text-indigo-500">Edit</a>
                                <a href="{{ route('owner.products', $business) }}" class="text-sm text-indigo-600 hover:text-indigo-500">Products</a>
                                <a href="{{ route('business.show', $business) }}" class="text-sm text-green-600 hover:text-green-500">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

<div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Moderation Queue</h1>

    @if(session('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>
    @endif

    <div class="mb-6 border-b border-gray-200">
        <nav class="flex space-x-4">
            <button wire:click="$set('tab', 'businesses')" class="pb-3 px-1 text-sm font-medium {{ $tab === 'businesses' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                Published Businesses
            </button>
            <button wire:click="$set('tab', 'flagged')" class="pb-3 px-1 text-sm font-medium {{ $tab === 'flagged' ? 'text-red-600 border-b-2 border-red-600' : 'text-gray-500 hover:text-gray-700' }}">
                Flagged Businesses
            </button>
            <button wire:click="$set('tab', 'reviews')" class="pb-3 px-1 text-sm font-medium {{ $tab === 'reviews' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                Pending Reviews @if($pendingReviews->total() > 0)<span class="ml-1 bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs">{{ $pendingReviews->total() }}</span>@endif
            </button>
        </nav>
    </div>

    @if($tab === 'businesses')
        <div class="space-y-4">
            @forelse($pendingBusinesses as $business)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $business->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $business->category?->name }} · {{ $business->region?->name }} · by {{ $business->user?->name }}</p>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ \Illuminate\Support\Str::limit($business->description, 200) }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button wire:click="approveBusiness({{ $business->id }})" class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-lg hover:bg-green-200">✓ Approve</button>
                            <button wire:click="flagBusiness({{ $business->id }})" wire:confirm="Flag this business?" class="text-sm bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200">🚩 Flag</button>
                            <a href="{{ route('business.show', $business) }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-500">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No published businesses pending moderation.</p>
            @endforelse
            <div class="mt-4">{{ $pendingBusinesses->links() }}</div>
        </div>
    @elseif($tab === 'flagged')
        <div class="space-y-4">
            @forelse($flaggedBusinesses as $business)
                <div class="bg-white rounded-lg shadow border border-red-200 p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $business->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $business->category?->name }} · by {{ $business->user?->name }}</p>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ \Illuminate\Support\Str::limit($business->description, 200) }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button wire:click="approveBusiness({{ $business->id }})" class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-lg hover:bg-green-200">✓ Unflag & Approve</button>
                            <a href="{{ route('business.show', $business) }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-500">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No flagged businesses.</p>
            @endforelse
            <div class="mt-4">{{ $flaggedBusinesses->links() }}</div>
        </div>
    @elseif($tab === 'reviews')
        <div class="space-y-4">
            @forelse($pendingReviews as $review)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-900">{{ $review->user?->name }}</span>
                                <span class="text-yellow-500">★ {{ $review->rating }}/5</span>
                                <span class="text-xs text-gray-400">on <a href="{{ route('business.show', $review->business) }}" class="text-indigo-600 hover:text-indigo-500">{{ $review->business?->name }}</a></span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">{{ $review->body }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button wire:click="approveReview({{ $review->id }})" class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-lg hover:bg-green-200">✓ Approve</button>
                            <button wire:click="flagReview({{ $review->id }})" wire:confirm="Flag this review?" class="text-sm bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200">🚩 Flag</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No pending reviews.</p>
            @endforelse
            <div class="mt-4">{{ $pendingReviews->links() }}</div>
        </div>
    @endif
</div>

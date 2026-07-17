@php use Illuminate\Support\Str; @endphp
<div class="space-y-8">
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $business->name }}</h1>
                    <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                        @if($business->category)<span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">{{ $business->category->name }}</span>@endif
                        @if($business->region)<span>📍 {{ $business->region->name }}{{ $business->district ? ', '.$business->district->name : '' }}</span>@endif
                        @if($averageRating)<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">★ {{ number_format($averageRating,1) }} ({{ $reviewsCount }})</span>@endif
                    </div>
                    <p class="mt-4 text-gray-700 leading-relaxed">{{ $business->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Contact</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if($business->phone)<div><span class="text-sm text-gray-500">Phone</span><p class="text-gray-900"><a href="tel:{{ $business->phone }}" class="hover:text-indigo-600">{{ $business->phone }}</a></p></div>@endif
                    @if($business->whatsapp_number)<div><span class="text-sm text-gray-500">WhatsApp</span><p><a href="{{ $business->whatsappLink() }}" target="_blank" class="text-green-600 hover:text-green-700 font-medium">💬 Chat on WhatsApp</a></p></div>@endif
                    @if($business->email)<div><span class="text-sm text-gray-500">Email</span><p class="text-gray-900"><a href="mailto:{{ $business->email }}" class="hover:text-indigo-600">{{ $business->email }}</a></p></div>@endif
                    @if($business->website)<div><span class="text-sm text-gray-500">Website</span><p class="text-gray-900"><a href="{{ $business->website }}" target="_blank" class="hover:text-indigo-600">{{ $business->website }}</a></p></div>@endif
                    @if($business->address_text)<div class="sm:col-span-2"><span class="text-sm text-gray-500">Address</span><p class="text-gray-900">{{ $business->address_text }}</p></div>@endif
                    @if($business->ghanapost_gps)<div><span class="text-sm text-gray-500">GhanaPost GPS</span><p class="text-gray-900">{{ $business->ghanapost_gps }}</p></div>@endif
                </div>
            </div>

            @if($business->momo_mtn || $business->momo_vodafone || $business->momo_airteltigo)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Mobile Money</h2>
                    <div class="space-y-2">
                        @if($business->momo_mtn)<p class="text-gray-900"><span class="font-medium text-yellow-600">MTN MoMo:</span> {{ $business->momo_mtn }}</p>@endif
                        @if($business->momo_vodafone)<p class="text-gray-900"><span class="font-medium text-red-600">Vodafone/Telecel Cash:</span> {{ $business->momo_vodafone }}</p>@endif
                        @if($business->momo_airteltigo)<p class="text-gray-900"><span class="font-medium text-green-600">AirtelTigo Money:</span> {{ $business->momo_airteltigo }}</p>@endif
                    </div>
                </div>
            @endif

            @if($business->products->isNotEmpty())
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Products & Services</h2>
                    <div class="space-y-4">
                        @foreach($business->products as $product)
                            <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                <div class="flex justify-between items-start">
                                    <div><h3 class="font-medium text-gray-900">{{ $product->name }}</h3>@if($product->description)<p class="text-sm text-gray-600 mt-1">{{ $product->description }}</p>@endif @if($product->unit)<p class="text-xs text-gray-500 mt-1">Per {{ $product->unit }}</p>@endif</div>
                                    <div class="text-right"><p class="font-semibold text-gray-900">{{ $product->formattedPrice() }}</p>@if($business->whatsapp_number)<a href="{{ $business->whatsappLink($product->whatsappEnquiryText()) }}" target="_blank" class="text-sm text-green-600 hover:text-green-700">Enquire on WhatsApp</a>@endif</div>
                                </div>@if(!$product->is_available)<span class="text-xs text-red-600 font-medium">Unavailable</span>@endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Reviews</h2>
                    @auth<button wire:click="$toggle('showReviewForm')" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Write Review</button>
                    @else<a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Login to review</a>@endauth
                </div>
                @auth @if($showReviewForm) <livewire:review-form :business="$business" :key="'review-'.$business->id" /> @endif @endauth
                <div class="space-y-4">
                    @forelse($business->approvedReviews as $review)
                        <div class="border-b border-gray-100 pb-4 last:border-0">
                            <div class="flex justify-between items-start">
                                <div><div class="flex items-center space-x-2"><span class="font-medium text-gray-900">{{ $review->user->name }}</span><span class="text-yellow-500">★ {{ $review->rating }}/5</span></div><p class="text-sm text-gray-600 mt-2">{{ $review->body }}</p></div>
                                <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            @if($review->owner_response)<div class="ml-6 mt-3 pl-4 border-l-2 border-indigo-200"><p class="text-sm font-medium text-indigo-600">Response from business</p><p class="text-sm text-gray-600 mt-1">{{ $review->owner_response }}</p></div>@endif
                        </div>
                    @empty<p class="text-gray-500 text-center py-4">No reviews yet.</p>@endforelse
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-3">Quick Actions</h3>
                <div class="space-y-3">
                    @if($business->whatsapp_number)<a href="{{ $business->whatsappLink() }}" target="_blank" class="block w-full text-center bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">💬 WhatsApp</a>@endif
                    @if($business->phone)<a href="tel:{{ $business->phone }}" class="block w-full text-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">📞 Call</a>@endif
                </div>
            </div>
            <x-ad-slot zone="listing_sidebar" />
        </div>
    </div>
</div>

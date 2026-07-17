@php use Illuminate\Support\Str; @endphp
<div class="bg-gray-50 rounded-lg p-4 mb-6">
    <h3 class="font-semibold text-gray-900 mb-4">Write Your Review</h3>
    <form wire:submit="submit" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
            <div class="flex space-x-1">
                @for($i=1;$i<=5;$i++)<button type="button" wire:click="$set('rating',{{ $i }})" class="text-2xl focus:outline-none {{ $i<=$this->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</button>@endfor
            </div>@error('rating')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Your Review</label>
            <textarea wire:model="body" id="body" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Share your experience..."></textarea>
            @error('body')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Photos (optional, max 5)</label>
            <input type="file" wire:model="photos" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700">
            @error('photos.*')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div><button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-medium">Submit Review</button></div>
    </form>
</div>

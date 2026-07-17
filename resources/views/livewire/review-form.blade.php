<div>
    {{-- Review Form --}}
    <div class="bg-white rounded-xl p-6 pop-border-primary">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-[#f1c100]/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-[#f1c100] text-xl">rate_review</span>
            </div>
            <div>
                <h3 class="text-xl font-black text-[#1c1b1b] font-['Bricolage_Grotesque'] tracking-tight">Write a Review</h3>
                <p class="text-sm text-[#6b7280] font-['Inter']">Share your experience with this business</p>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-[#316948]">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#316948] text-lg">check_circle</span>
                    <p class="text-sm font-semibold text-[#316948] font-['Inter']">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-[#b90027]">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#b90027] text-lg">error</span>
                    <p class="text-sm font-semibold text-[#b90027] font-['Inter']">{{ $errors->first() }}</p>
                </div>
            </div>
        @endif

        <form wire:submit="submit" class="space-y-6">
            {{-- Star Rating --}}
            <div>
                <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-3">Your Rating</label>
                <div class="flex items-center gap-1" x-data="{ rating: {{ $rating ?? 0 }} }">
                    @for($i = 1; $i <= 5; $i++)
                        <button
                            type="button"
                            wire:click="$set('rating', {{ $i }})"
                            @mouseenter="rating = {{ $i }}"
                            @mouseleave="rating = {{ $rating ?? 0 }}"
                            class="p-1 transition-all duration-150 hover:scale-110 focus:outline-none"
                        >
                            <span class="material-symbols-outlined text-3xl transition-colors duration-150"
                                  :class="rating >= {{ $i }} ? 'text-[#f1c100]' : 'text-[#d1d5db]'"
                                  x-text="rating >= {{ $i }} ? 'star' : 'star'">
                                star
                            </span>
                        </button>
                    @endfor
                    @if($rating > 0)
                        <span class="ml-3 text-sm font-bold text-[#1c1b1b] font-['Inter']">{{ number_format($rating, 1) }}</span>
                    @endif
                </div>
                @error('rating') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
            </div>

            {{-- Review Body --}}
            <div>
                <label for="body" class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Your Review</label>
                <textarea
                    wire:model="body"
                    id="body"
                    rows="4"
                    placeholder="Tell others about your experience... What did you like? What could be improved?"
                    class="w-full px-4 py-3 rounded-lg border-2 border-[#d1d5db] bg-white text-[#1c1b1b] font-['Inter'] placeholder:text-[#9ca3af] focus:border-[#b90027] focus:ring-2 focus:ring-[#b90027]/20 outline-none transition-all duration-200 resize-none"
                ></textarea>
                <div class="flex justify-between mt-1.5">
                    @error('body') <p class="text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                    <p class="text-xs text-[#9ca3af] font-['Inter'] ml-auto">{{ strlen($body ?? '') }}/500</p>
                </div>
            </div>

            {{-- Photo Upload --}}
            <div>
                <label class="block text-sm font-semibold text-[#1c1b1b] font-['Inter'] mb-1.5">Add Photos (Optional)</label>
                <div class="relative">
                    <div class="border-2 border-dashed border-[#d1d5db] rounded-lg p-6 text-center hover:border-[#b90027] transition-colors cursor-pointer bg-[#fcf9f8]/50">
                        <input
                            type="file"
                            wire:model="photos"
                            multiple
                            accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        >
                        <div class="flex flex-col items-center gap-2">
                            <span class="material-symbols-outlined text-3xl text-[#9ca3af]">add_photo_alternate</span>
                            <p class="text-sm text-[#6b7280] font-['Inter']">
                                <span class="font-semibold text-[#b90027]">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-[#9ca3af] font-['Inter']">PNG, JPG up to 5MB each</p>
                        </div>
                    </div>
                </div>

                {{-- Preview Uploaded Photos --}}
                @if($photos)
                    <div class="flex gap-2 mt-3 flex-wrap">
                        @foreach($photos as $photo)
                            <div class="relative w-16 h-16 rounded-lg overflow-hidden border-2 border-[#d1d5db]">
                                <img src="{{ $photo->temporaryUrl() }}" alt="Upload preview" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
                @error('photos.*') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
                @error('photos') <p class="mt-1.5 text-sm text-[#b90027] font-['Inter']">{{ $message }}</p> @enderror
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-between pt-2">
                <p class="text-xs text-[#9ca3af] font-['Inter']">Your review will be visible after moderation</p>
                <button type="submit" class="bg-[#b90027] text-white font-bold font-['Inter'] py-2.5 px-6 rounded-lg hover:bg-[#9a0020] transition-all duration-200 flex items-center gap-2 shadow-[4px_4px_0px_#1a1a1a] hover:shadow-[6px_6px_0px_#f1c100] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none text-sm">
                    <span>Submit Review</span>
                    <span class="material-symbols-outlined text-lg">send</span>
                </button>
            </div>
        </form>
    </div>
</div>

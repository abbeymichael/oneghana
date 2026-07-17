<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6 sm:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Register Your Business</h1>
        <p class="text-gray-500 mb-6">List your business on the Ghana Business Directory. Complete all 4 steps.</p>

        <div class="mb-8">
            <div class="flex items-center justify-between">
                @foreach(range(1,4) as $stepNum)
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $step == $stepNum ? 'bg-indigo-600 text-white' : ($step > $stepNum ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600') }}">
                            {{ $stepNum }}
                        </div>
                        @if($stepNum < 4)<div class="h-1 w-16 sm:w-24 mx-2 rounded {{ $step > $stepNum ? 'bg-green-500' : 'bg-gray-200' }}"></div>@endif
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-500">
                <span>Details</span>
                <span>Location</span>
                <span>Contact</span>
                <span>Media</span>
            </div>
        </div>

        <form wire:submit="{{ $step < 4 ? 'nextStep' : 'submit' }}">
            @if($step === 1)
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Business Name *</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., Mama's Catering Services">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description *</label>
                        <textarea wire:model="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Describe your business, products, and services (at least 20 characters)"></textarea>
                        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category *</label>
                        <select wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @foreach($cat->children as $child)
                                    <option value="{{ $child->id }}">&nbsp;&nbsp;— {{ $child->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            @elseif($step === 2)
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Region *</label>
                        <select wire:model.change="region_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select a region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('region_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">District *</label>
                        <select wire:model="district_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select a district</option>
                            @if($selectedRegion)
                                @foreach($selectedRegion->districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('district_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address *</label>
                        <input type="text" wire:model="address_text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., 23 Oxford Street, Osu, Accra">
                        @error('address_text') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">GhanaPost GPS Code</label>
                        <input type="text" wire:model="ghanapost_gps" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., GA-123-4567">
                        @error('ghanapost_gps') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            @elseif($step === 3)
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number *</label>
                        <input type="text" wire:model="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., +233 20 123 4567">
                        @error('phone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                        <input type="text" wire:model="whatsapp_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., +233 20 123 4567">
                        @error('whatsapp_number') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="business@example.com">
                        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Website</label>
                        <input type="url" wire:model="website" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="https://example.com">
                        @error('website') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Mobile Money Numbers (optional)</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-yellow-700">MTN MoMo</label>
                                <input type="text" wire:model="momo_mtn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="MoMo number">
                                @error('momo_mtn') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-red-700">Vodafone/Telecel Cash</label>
                                <input type="text" wire:model="momo_vodafone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="MoMo number">
                                @error('momo_vodafone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-green-700">AirtelTigo Money</label>
                                <input type="text" wire:model="momo_airteltigo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="MoMo number">
                                @error('momo_airteltigo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($step === 4)
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Business Logo</label>
                        <input type="file" wire:model="logo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('logo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        @if($logo) <div class="mt-2"><img src="{{ $logo->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg border"></div> @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gallery Images (up to 10)</label>
                        <input type="file" wire:model="gallery" multiple accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('gallery.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        @if($gallery)
                            <div class="mt-2 grid grid-cols-4 gap-2">
                                @foreach($gallery as $img)<img src="{{ $img->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-lg border">@endforeach
                            </div>
                        @endif
                    </div>
                    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                        <h3 class="font-semibold text-indigo-800 mb-2">Almost done!</h3>
                        <p class="text-sm text-indigo-600">By submitting, you agree that your business listing will be published and visible to everyone on the Ghana Business Directory.</p>
                    </div>
                </div>
            @endif

            <div class="mt-8 flex justify-between">
                @if($step > 1)
                    <button type="button" wire:click="previousStep" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">← Back</button>
                @else
                    <div></div>
                @endif
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                    {{ $step < 4 ? 'Continue →' : 'Submit Listing' }}
                </button>
            </div>
        </form>
    </div>
</div>

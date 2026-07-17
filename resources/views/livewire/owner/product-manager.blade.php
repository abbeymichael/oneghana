<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-500">← Back to Dashboard</a>
    </div>

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Products & Services</h1>
            <p class="text-sm text-gray-500">{{ $business->name }}</p>
        </div>
        @if(!$showForm)
            <button wire:click="create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">+ Add Product/Service</button>
        @endif
    </div>

    @if(session('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ $editingProductId ? 'Edit' : 'Add' }} Product/Service</h2>
            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name *</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select wire:model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="product">Product</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Price (leave empty for "Contact for pricing")</label>
                        <input type="number" step="0.01" min="0" wire:model="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Currency</label>
                        <select wire:model="currency_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->code }} ({{ $currency->symbol }})</option>
                            @endforeach
                        </select>
                        @error('currency_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Unit (e.g., per piece, per hour)</label>
                        <input type="text" wire:model="unit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('unit') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="is_available" id="is_available" class="rounded border-gray-300">
                    <label for="is_available" class="text-sm text-gray-700">Available</label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" wire:model="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('photo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    @if($photo) <div class="mt-2"><img src="{{ $photo->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-lg border"></div> @endif
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" wire:click="$set('showForm', false)" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
                        {{ $editingProductId ? 'Update' : 'Add' }} Product
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                            @if($product->unit)<p class="text-xs text-gray-500">Per {{ $product->unit }}</p>@endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 capitalize">{{ $product->type }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $product->formattedPrice() }}</td>
                        <td class="px-6 py-4">
                            @if($product->is_available)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Available</span>
                            @else
                                <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">Unavailable</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <button wire:click="edit({{ $product->id }})" class="text-indigo-600 hover:text-indigo-500">Edit</button>
                            <button wire:click="delete({{ $product->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-500">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No products or services added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

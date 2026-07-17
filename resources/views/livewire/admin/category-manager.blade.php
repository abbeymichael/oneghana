@php use App\Models\Category; @endphp
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Category Manager</h1>
        @if(!$showForm)
            <button wire:click="create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">+ Add Category</button>
        @endif
    </div>

    @if(session('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">{{ session('error') }}</div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ $editingCategoryId ? 'Edit' : 'Add' }} Category</h2>
            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name *</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Parent Category</label>
                        <select wire:model="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">— Root Category —</option>
                            @foreach($parentCategories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Icon (emoji or icon class)</label>
                    <input type="text" wire:model="icon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., 🏥 or fas fa-hospital">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Custom Fields Schema (JSON)</label>
                    <textarea wire:model="custom_fields_schema" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm" placeholder='[{"key":"license_number","label":"License Number","type":"text","required":true},{"key":"years_in_business","label":"Years in Business","type":"number","required":false}]'></textarea>
                    @error('custom_fields_schema') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-400 mt-1">Define custom fields for businesses in this category. Must be a valid JSON array of field objects.</p>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" wire:click="$set('showForm', false)" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">{{ $editingCategoryId ? 'Update' : 'Create' }} Category</button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Businesses</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">—</td>
                        <td class="px-6 py-4 text-sm">{{ $category->icon }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $category->businesses_count ?? $category->businesses()->count() }}</td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <button wire:click="edit({{ $category->id }})" class="text-indigo-600 hover:text-indigo-500">Edit</button>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="Delete this category?" class="text-red-600 hover:text-red-500">Delete</button>
                        </td>
                    </tr>
                    @foreach($category->children as $child)
                        <tr class="hover:bg-gray-50 bg-gray-50/50">
                            <td class="px-6 py-4 text-sm text-gray-900 pl-12">— {{ $child->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $child->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $child->icon }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $child->businesses_count ?? $child->businesses()->count() }}</td>
                            <td class="px-6 py-4 text-right text-sm space-x-2">
                                <button wire:click="edit({{ $child->id }})" class="text-indigo-600 hover:text-indigo-500">Edit</button>
                                <button wire:click="delete({{ $child->id }})" wire:confirm="Delete this category?" class="text-red-600 hover:text-red-500">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No categories created yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

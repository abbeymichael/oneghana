@php use App\Models\Currency; @endphp
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Currency Manager</h1>
        @if(!$showForm)
            <button wire:click="create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">+ Add Currency</button>
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
            <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ $editingCurrencyId ? 'Edit' : 'Add' }} Currency</h2>
            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Code *</label>
                        <input type="text" wire:model="code" maxlength="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 uppercase" placeholder="GHS">
                        @error('code') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Symbol *</label>
                        <input type="text" wire:model="symbol" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="GH₵">
                        @error('symbol') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name *</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ghana Cedi">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="is_active" class="rounded border-gray-300">
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="is_default" class="rounded border-gray-300">
                        <span class="text-sm text-gray-700">Set as Default</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" wire:click="$set('showForm', false)" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">{{ $editingCurrencyId ? 'Update' : 'Add' }} Currency</button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Symbol</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Default</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($currencies as $currency)
                    <tr class="hover:bg-gray-50 {{ $currency->is_default ? 'bg-indigo-50/50' : '' }}">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $currency->code }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $currency->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $currency->symbol }}</td>
                        <td class="px-6 py-4 text-sm text-center">
                            <button wire:click="toggleActive({{ $currency->id }})" class="{{ $currency->is_active ? 'text-green-600 hover:text-green-500' : 'text-red-600 hover:text-red-500' }}">
                                {{ $currency->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm text-center">
                            @if($currency->is_default)
                                <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">Default</span>
                            @else
                                <button wire:click="setDefault({{ $currency->id }})" class="text-xs text-gray-500 hover:text-indigo-600">Set as Default</button>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <button wire:click="edit({{ $currency->id }})" class="text-indigo-600 hover:text-indigo-500">Edit</button>
                            <button wire:click="delete({{ $currency->id }})" wire:confirm="Delete this currency?" class="text-red-600 hover:text-red-500">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No currencies configured.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

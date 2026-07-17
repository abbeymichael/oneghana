@php use App\Models\AdCampaign; @endphp
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Ad Campaign Manager</h1>
        @if(!$showForm)
            <button wire:click="create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">+ New Campaign</button>
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
            <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ $editingCampaignId ? 'Edit' : 'New' }} Campaign</h2>
            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ad Zone *</label>
                        <select wire:model="ad_zone_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select zone</option>
                            @foreach($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }} ({{ $zone->key }})</option>
                            @endforeach
                        </select>
                        @error('ad_zone_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Advertiser Name *</label>
                        <input type="text" wire:model="advertiser_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('advertiser_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Link URL *</label>
                    <input type="url" wire:model="link_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="https://example.com">
                    @error('link_url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Creative Image</label>
                    <input type="file" wire:model="creative" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('creative') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    @if($creative) <div class="mt-2"><img src="{{ $creative->temporaryUrl() }}" class="h-24 object-cover rounded-lg border"></div> @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" wire:model="starts_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('starts_at') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" wire:model="ends_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('ends_at') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-gray-300">
                    <label for="is_active" class="text-sm text-gray-700">Active</label>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" wire:click="$set('showForm', false)" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">{{ $editingCampaignId ? 'Update' : 'Create' }} Campaign</button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Advertiser</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Range</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Impressions</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Clicks</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($campaigns as $campaign)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $campaign->zone?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $campaign->advertiser_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $campaign->starts_at?->toDateString() ?? 'Any' }} → {{ $campaign->ends_at?->toDateString() ?? 'Any' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-center">
                            <button wire:click="toggleActive({{ $campaign->id }})" class="{{ $campaign->is_active ? 'text-green-600 hover:text-green-500' : 'text-red-600 hover:text-red-500' }}">
                                {{ $campaign->is_active ? 'Active' : 'Paused' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm text-center text-gray-500">{{ number_format($campaign->impressions_count) }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-500">{{ number_format($campaign->clicks_count) }}</td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <button wire:click="edit({{ $campaign->id }})" class="text-indigo-600 hover:text-indigo-500">Edit</button>
                            <button wire:click="delete({{ $campaign->id }})" wire:confirm="Delete this campaign?" class="text-red-600 hover:text-red-500">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">No ad campaigns created yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

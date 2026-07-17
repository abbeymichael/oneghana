@php use Illuminate\Support\Str; @endphp
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Reset Password</h1>
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <form wire:submit="resetPassword" class="space-y-6">
            @if(session('message'))<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>@endif
            <input type="hidden" wire:model="token">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model="email" id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm" disabled>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input wire:model="password" id="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required autofocus>
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <div><button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">Reset Password</button></div>
        </form>
    </div>
</div>

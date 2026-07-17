@php use Illuminate\Support\Str; @endphp
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Forgot Password</h1>
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <div class="mb-4 text-sm text-gray-600">Forgot your password? Enter your email and we'll send you a reset link.</div>
        <form wire:submit="sendResetLink" class="space-y-6">
            @if(session('message'))<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>@endif
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input wire:model="email" id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required autofocus>
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div><button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">Send Reset Link</button></div>
            <div class="text-center"><a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Back to login</a></div>
        </form>
    </div>
</div>

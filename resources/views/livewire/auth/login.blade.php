@php use Illuminate\Support\Str; @endphp
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Sign In</h1>
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <form wire:submit="login" class="space-y-6">
            @error('email')<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">{{ $message }}</div>@enderror
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input wire:model="email" id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required autofocus>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input wire:model="password" id="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center"><input wire:model="remember" id="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"><label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label></div>
                <div class="text-sm"><a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a></div>
            </div>
            <div><button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">Sign In</button></div>
            <div class="text-center"><p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Create one</a></p></div>
        </form>
    </div>
</div>

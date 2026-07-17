@php use Illuminate\Support\Str; @endphp
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Verify Email</h1>
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
        <div class="mb-4 text-sm text-gray-600">Thanks for signing up! Please verify your email using the link we sent you.</div>
        @if(session('message'))<div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>@endif
        <div class="flex items-center justify-between">
            <button wire:click="resend" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Resend Verification Email</button>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">Log Out</button></form>
        </div>
    </div>
</div>

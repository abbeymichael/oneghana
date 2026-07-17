<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Ghana Business Directory'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:{50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81'}}}}}</script>
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">🇬🇭 Ghana Business Directory</a>
                        <div class="ml-10 hidden md:flex space-x-4">
                            <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="{{ route('business.search') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Browse</a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                                <a href="{{ route('business.register') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">List Business</a>
                            @endauth
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <span class="text-sm text-gray-500 hidden md:inline">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->isAdmin())<span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">Admin</span>@endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="text-sm text-gray-500 hover:text-gray-700">Logout</button></form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-600">Login</a>
                            <a href="{{ route('register') }}" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Register</a>
                        @endauth
                    </div>
                    <div class="flex items-center md:hidden">
                        <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="text-gray-700 hover:text-indigo-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">Home</a>
                    <a href="{{ route('business.search') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">Browse</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">Dashboard</a>
                        <a href="{{ route('business.register') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">List Business</a>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @if(session('message'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">{{ session('message') }}</div>
            @endif
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Ghana Business Directory</h3>
                        <p class="mt-2 text-sm text-gray-500">Connecting you with businesses across all 16 regions of Ghana.</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Quick Links</h3>
                        <ul class="mt-2 space-y-2">
                            <li><a href="{{ route('business.search') }}" class="text-sm text-gray-500 hover:text-indigo-600">Browse Businesses</a></li>
                            @auth<li><a href="{{ route('business.register') }}" class="text-sm text-gray-500 hover:text-indigo-600">List Your Business</a></li>
                            @else<li><a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-indigo-600">List Your Business</a></li>@endauth
                        </ul>
                    </div>
                    <div><h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Contact</h3><p class="mt-2 text-sm text-gray-500">Via WhatsApp: wa.me/233...</p></div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-6 text-center"><p class="text-sm text-gray-400">&copy; {{ date('Y') }} Ghana Business Directory.</p></div>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>
</html>

<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GhanaDirect - Local Business Directory')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@700;800&family=Inter:wght@400;600&family=JetBrains+Mono:wght@600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@100..900&family=Inter:wght@100..900&family=JetBrains+Mono:wght@100..900&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .pop-shadow {
            box-shadow: 4px 4px 0px 0px #1A1A1A;
        }
        .pop-shadow-yellow:hover {
            box-shadow: 4px 4px 0px 0px #d1a600;
        }
        .kente-border {
            border-left: 6px solid;
            border-image: repeating-linear-gradient(45deg, #b90027 0, #b90027 10px, #745b00 10px, #745b00 20px, #316948 20px, #316948 30px) 1;
        }
        .market-shadow {
            box-shadow: 4px 4px 0px 0px #1A1A1A;
        }
        .market-shadow-hover:hover {
            box-shadow: 6px 6px 0px 0px #f1c100;
            transform: translate(-2px, -2px);
        }
        .active-nav-link {
            color: #b90027;
            border-bottom: 2px solid #b90027;
            font-weight: 700;
        }
        [type='checkbox'] {
            border-radius: 0 !important;
        }
        [type='checkbox']:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "error-container": "#ffdad6",
                        "primary-container": "#e31937",
                        "inverse-on-surface": "#f3f0ef",
                        "background": "#fcf9f8",
                        "surface-container-lowest": "#ffffff",
                        "on-error": "#ffffff",
                        "surface-container-low": "#f6f3f2",
                        "surface-container": "#f0eded",
                        "on-secondary-fixed-variant": "#165132",
                        "surface-dim": "#dcd9d9",
                        "surface-bright": "#fcf9f8",
                        "primary": "#b90027",
                        "on-secondary-container": "#356e4c",
                        "on-secondary": "#ffffff",
                        "tertiary": "#745b00",
                        "secondary": "#316948",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#ffdad8",
                        "on-tertiary-container": "#4f3e00",
                        "outline": "#916e6d",
                        "tertiary-fixed-dim": "#f1c100",
                        "on-secondary-fixed": "#002110",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#b1edc4",
                        "on-primary-container": "#fffaf9",
                        "inverse-surface": "#313030",
                        "secondary-fixed": "#b4f0c7",
                        "surface-container-highest": "#e5e2e1",
                        "on-primary-fixed": "#410007",
                        "on-tertiary-fixed-variant": "#584400",
                        "inverse-primary": "#ffb3b1",
                        "error": "#ba1a1a",
                        "secondary-fixed-dim": "#98d4ac",
                        "surface-container-high": "#eae7e7",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#ffe08b",
                        "outline-variant": "#e6bdbb",
                        "surface-variant": "#e5e2e1",
                        "on-surface": "#1c1b1b",
                        "surface": "#fcf9f8",
                        "primary-fixed-dim": "#ffb3b1",
                        "tertiary-container": "#d1a600",
                        "on-background": "#1c1b1b",
                        "on-surface-variant": "#5d3f3e",
                        "surface-tint": "#bf0028",
                        "on-primary-fixed-variant": "#92001c",
                        "on-tertiary-fixed": "#241a00"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "xl": "40px",
                        "lg": "24px",
                        "xs": "4px",
                        "md": "16px",
                        "container-margin": "16px",
                        "sm": "8px",
                        "unit": "4px",
                        "gutter": "12px"
                    },
                    "fontFamily": {
                        "headline-sm": ["Bricolage Grotesque"],
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "display-lg": ["Bricolage Grotesque"],
                        "headline-md": ["Bricolage Grotesque"],
                        "body-lg": ["Inter"],
                        "label-caps": ["JetBrains Mono"],
                        "display-lg-mobile": ["Bricolage Grotesque"]
                    },
                    "fontSize": {
                        "headline-sm": ["20px", {"lineHeight": "26px", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "display-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "headline-md": ["24px", {"lineHeight": "30px", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "38px", "letterSpacing": "-0.01em", "fontWeight": "800"}]
                    }
                },
            },
        }
    </script>
    @livewireStyles
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    <!-- TopNavBar -->
    <nav class="bg-background border-b-[1.5px] border-on-surface sticky top-0 z-50">
        <div class="flex justify-between items-center w-full px-container-margin py-sm max-w-7xl mx-auto">
            <a href="{{ route('home') }}" class="font-display-lg text-display-lg text-primary tracking-tighter">GhanaDirect</a>
            <div class="hidden md:flex items-center gap-lg">
                <a href="{{ route('business.search') }}" class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:border-b-2 hover:border-primary px-xs py-unit transition-colors duration-200">Browse</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:border-b-2 hover:border-primary px-xs py-unit transition-colors duration-200">Dashboard</a>
                    <a href="{{ route('business.register') }}" class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:border-b-2 hover:border-primary px-xs py-unit transition-colors duration-200">List a Business</a>
                    <div class="h-6 w-px bg-outline-variant"></div>
                    <span class="font-body-sm text-on-surface-variant">{{ auth()->user()->name }}</span>
                    @if(auth()->user()->isAdmin())
                        <span class="font-label-caps text-[10px] bg-primary text-on-primary px-sm py-unit border-[1px] border-on-surface">ADMIN</span>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="font-label-caps text-label-caps bg-primary text-on-primary px-lg py-sm border-[1.5px] border-on-surface pop-shadow hover:pop-shadow-yellow active:scale-95 transition-all">Logout</button></form>
                @else
                    <a href="{{ route('register') }}" class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary px-xs py-unit transition-colors duration-200">List a Business</a>
                    <div class="h-6 w-px bg-outline-variant"></div>
                    <a href="{{ route('login') }}" class="font-label-caps text-label-caps bg-primary text-on-primary px-lg py-sm border-[1.5px] border-on-surface pop-shadow hover:pop-shadow-yellow active:scale-95 transition-all">Login</a>
                @endauth
            </div>
            <button class="md:hidden" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <span class="material-symbols-outlined text-primary">menu</span>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden border-t-[1.5px] border-on-surface bg-background">
            <div class="px-container-margin py-md space-y-md">
                <a href="{{ route('business.search') }}" class="block font-body-md text-on-surface-variant hover:text-primary">Browse</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block font-body-md text-on-surface-variant hover:text-primary">Dashboard</a>
                    <a href="{{ route('business.register') }}" class="block font-body-md text-on-surface-variant hover:text-primary">List a Business</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="font-body-md text-primary">Logout</button></form>
                @else
                    <a href="{{ route('register') }}" class="block font-body-md text-on-surface-variant hover:text-primary">Register</a>
                    <a href="{{ route('login') }}" class="block font-body-md text-primary">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('message') || session('status'))
        <div class="max-w-7xl mx-auto w-full px-container-margin pt-md">
            <div class="bg-secondary-container text-on-secondary-container px-md py-sm border-[1.5px] border-on-surface font-body-md flex items-center gap-sm">
                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                {{ session('message') ?? session('status') }}
            </div>
        </div>
    @endif

    <main class="flex-1 w-full">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container-highest border-t-[1.5px] border-on-surface">
        <div class="flex flex-col md:flex-row justify-between items-start w-full px-container-margin py-lg gap-gutter max-w-7xl mx-auto">
            <div class="space-y-md">
                <div class="font-headline-sm text-headline-sm text-primary">GhanaDirect</div>
                <p class="font-body-sm text-on-surface-variant max-w-xs">Connecting Ghanaian industry to the world. Building the digital infrastructure for local growth.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-xl w-full md:w-auto">
                <div class="space-y-sm">
                    <p class="font-label-caps text-label-caps text-on-surface uppercase border-b-[1.5px] border-primary pb-unit inline-block">Directory</p>
                    <ul class="space-y-xs">
                        <li><a href="{{ route('business.search') }}" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Browse Businesses</a></li>
                        <li><a href="{{ route('business.search', ['sort' => 'views']) }}" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">Top Rated</a></li>
                    </ul>
                </div>
                <div class="space-y-sm">
                    <p class="font-label-caps text-label-caps text-on-surface uppercase border-b-[1.5px] border-primary pb-unit inline-block">Company</p>
                    <ul class="space-y-xs">
                        <li><span class="font-body-sm text-on-surface-variant">Accra, Ghana</span></li>
                        <li><span class="font-body-sm text-on-surface-variant">wa.me/233...</span></li>
                    </ul>
                </div>
                <div class="space-y-sm">
                    <p class="font-label-caps text-label-caps text-on-surface uppercase border-b-[1.5px] border-primary pb-unit inline-block">For Business</p>
                    <ul class="space-y-xs">
                        @auth
                            <li><a href="{{ route('business.register') }}" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">List Your Business</a></li>
                        @else
                            <li><a href="{{ route('register') }}" class="font-body-sm text-on-surface-variant hover:text-primary transition-colors">List Your Business</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="space-y-sm">
                    <p class="font-label-caps text-label-caps text-on-surface uppercase border-b-[1.5px] border-primary pb-unit inline-block">Connect</p>
                    <div class="flex gap-sm">
                        <div class="w-8 h-8 border-[1.5px] border-on-surface flex items-center justify-center bg-white hover:bg-primary hover:text-on-primary transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">share</span>
                        </div>
                        <div class="w-8 h-8 border-[1.5px] border-on-surface flex items-center justify-center bg-white hover:bg-primary hover:text-on-primary transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-container-margin py-md border-t-[1px] border-outline-variant">
            <p class="font-label-caps text-body-sm text-on-surface-variant">&copy; {{ date('Y') }} GhanaDirect Directory. All rights reserved.</p>
        </div>
    </footer>

    @livewireScripts
    <script>
        document.querySelectorAll('button, .btn-market').forEach(btn => {
            btn.addEventListener('mousedown', () => { btn.style.transform = 'scale(0.96)'; });
            btn.addEventListener('mouseup', () => { btn.style.transform = ''; });
            btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
        });
    </script>
</body>
</html>

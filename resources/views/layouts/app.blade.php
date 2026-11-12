<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Grand Mirage Luxury Resort & Casino')</title>

    <!-- Google Fonts: Cinzel & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS v3 CDN for instant luxury rendering without build dependencies -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            100: '#fef9c3',
                            200: '#fef08a',
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                            700: '#a16207',
                            800: '#854d0e',
                            900: '#713f12',
                        },
                        onyx: {
                            950: '#07090e',
                            900: '#0d111a',
                            850: '#121824',
                            800: '#172033',
                            700: '#1f2b45',
                        }
                    },
                    fontFamily: {
                        serif: ['Cinzel', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFF6D1 0%, #E5B842 50%, #B8860B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gold-border-gradient {
            border-image: linear-gradient(135deg, #e5b842, #78520b) 1;
        }
        .luxury-card {
            background: linear-gradient(145deg, rgba(18, 24, 36, 0.85) 0%, rgba(13, 17, 26, 0.95) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(229, 184, 66, 0.15);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.7);
        }
        .luxury-card-hover:hover {
            border-color: rgba(229, 184, 66, 0.4);
            box-shadow: 0 15px 35px -5px rgba(229, 184, 66, 0.15);
            transform: translateY(-2px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="min-h-full flex flex-col bg-onyx-950 font-sans selection:bg-amber-500 selection:text-black">

    <!-- Top Tester Bar (Simulador de Portero Virtual) -->
    <header class="bg-onyx-900 border-b border-amber-500/20 text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"></path>
                    </svg>
                    Simulador de Accesos (Middleware Tester)
                </span>
                <span class="text-slate-400 hidden sm:inline">Haz clic para alternar usuarios y probar los porteros virtuales:</span>
            </div>

            <div class="flex items-center space-x-2 overflow-x-auto pb-1 sm:pb-0">
                <a href="{{ route('quick.login', 'admin') }}" title="Carlos Admin: 45 años, is_admin=true"
                   class="px-2.5 py-1 rounded transition flex items-center gap-1.5 {{ Auth::check() && Auth::user()->is_admin ? 'bg-purple-600 text-white ring-1 ring-purple-300 font-bold' : 'bg-onyx-800 text-purple-300 hover:bg-onyx-700 border border-purple-500/30' }}">
                    <span>👑 Director (Admin 45a)</span>
                </a>
                <a href="{{ route('quick.login', 'adulto') }}" title="Valeria Adulta: 26 años, is_admin=false"
                   class="px-2.5 py-1 rounded transition flex items-center gap-1.5 {{ Auth::check() && !Auth::user()->is_admin && Auth::user()->age >= 18 ? 'bg-emerald-600 text-white ring-1 ring-emerald-300 font-bold' : 'bg-onyx-800 text-emerald-300 hover:bg-onyx-700 border border-emerald-500/30' }}">
                    <span>🍸 Adulta (26a)</span>
                </a>
                <a href="{{ route('quick.login', 'menor') }}" title="Mateo Menor: 16 años, is_admin=false"
                   class="px-2.5 py-1 rounded transition flex items-center gap-1.5 {{ Auth::check() && !Auth::user()->is_admin && Auth::user()->age < 18 ? 'bg-amber-600 text-white ring-1 ring-amber-300 font-bold' : 'bg-onyx-800 text-amber-300 hover:bg-onyx-700 border border-amber-500/30' }}">
                    <span>🧒 Menor (16a)</span>
                </a>
                @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-2.5 py-1 rounded bg-rose-950/60 text-rose-300 hover:bg-rose-900 border border-rose-500/40 transition">
                        🚪 Cerrar sesión
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Navigation Bar -->
    <nav class="sticky top-0 z-40 bg-onyx-950/90 backdrop-blur-md border-b border-amber-500/15">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-11 h-11 rounded-lg bg-gradient-to-br from-amber-400 via-amber-600 to-amber-800 p-0.5 shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform">
                            <div class="w-full h-full bg-onyx-950 rounded-[7px] flex items-center justify-center">
                                <span class="text-xl">⚜️</span>
                            </div>
                        </div>
                        <div>
                            <span class="font-serif text-lg font-bold tracking-wider gold-gradient-text block leading-none">GRAND MIRAGE</span>
                            <span class="text-[10px] tracking-[0.25em] text-amber-400/80 uppercase font-medium">Resort & Casino de Lujo</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('home') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('home') ? 'text-amber-400 bg-amber-500/10 border-b-2 border-amber-400' : 'text-slate-300 hover:text-amber-300 hover:bg-onyx-850' }}">
                        🏝️ Inicio
                    </a>

                    <a href="{{ route('panel') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium transition flex items-center gap-1.5 {{ request()->routeIs('panel') ? 'text-amber-400 bg-amber-500/10 border-b-2 border-amber-400' : 'text-slate-300 hover:text-amber-300 hover:bg-onyx-850' }}">
                        <span>🛎️ Habitación</span>
                        <span class="text-[10px] px-1.5 py-0.2 rounded bg-slate-800 text-slate-400 border border-slate-700">Auth</span>
                    </a>

                    <a href="{{ route('casino') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium transition flex items-center gap-1.5 {{ request()->routeIs('casino') ? 'text-amber-400 bg-amber-500/10 border-b-2 border-amber-400' : 'text-slate-300 hover:text-amber-300 hover:bg-onyx-850' }}">
                        <span>🎲 Casino VIP</span>
                        <span class="text-[10px] px-1.5 py-0.2 rounded bg-amber-950/80 text-amber-300 border border-amber-500/40 font-semibold">+18</span>
                    </a>

                    <a href="{{ route('admin') }}" 
                       class="px-3 py-2 rounded-md text-sm font-medium transition flex items-center gap-1.5 {{ request()->routeIs('admin') ? 'text-amber-400 bg-amber-500/10 border-b-2 border-amber-400' : 'text-slate-300 hover:text-amber-300 hover:bg-onyx-850' }}">
                        <span>🏛️ Dirección</span>
                        <span class="text-[10px] px-1.5 py-0.2 rounded bg-purple-950/80 text-purple-300 border border-purple-500/40 font-semibold">Admin</span>
                    </a>
                </div>

                <!-- User status / Auth buttons -->
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="flex items-center space-x-3 bg-onyx-850/90 border border-amber-500/20 rounded-full py-1.5 pl-3 pr-2">
                            <div class="text-right">
                                <div class="text-xs font-semibold text-slate-200">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] flex items-center justify-end gap-1.5">
                                    <span class="text-slate-400">{{ Auth::user()->age }} años</span>
                                    <span class="text-slate-600">•</span>
                                    @if(Auth::user()->is_admin)
                                        <span class="text-purple-400 font-bold uppercase tracking-wider">Dirección</span>
                                    @elseif(Auth::user()->age >= 18)
                                        <span class="text-emerald-400 font-medium">Adulto</span>
                                    @else
                                        <span class="text-amber-400 font-medium">Menor de edad</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr {{ Auth::user()->is_admin ? 'from-purple-600 to-indigo-500' : (Auth::user()->age >= 18 ? 'from-emerald-600 to-teal-400' : 'from-amber-600 to-yellow-400') }} flex items-center justify-center text-xs font-bold text-white shadow">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" title="Cerrar sesión" class="p-2 rounded-full text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-amber-300 px-3 py-2 transition">
                            Acceder
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 font-bold hover:from-amber-400 hover:to-amber-500 shadow-md shadow-amber-500/20 transition">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="md:hidden border-t border-slate-800 bg-onyx-900/95 px-4 py-2 flex justify-around text-xs">
            <a href="{{ route('home') }}" class="py-1.5 {{ request()->routeIs('home') ? 'text-amber-400 font-bold' : 'text-slate-400' }}">🏝️ Inicio</a>
            <a href="{{ route('panel') }}" class="py-1.5 {{ request()->routeIs('panel') ? 'text-amber-400 font-bold' : 'text-slate-400' }}">🛎️ Habitación</a>
            <a href="{{ route('casino') }}" class="py-1.5 {{ request()->routeIs('casino') ? 'text-amber-400 font-bold' : 'text-slate-400' }}">🎲 Casino</a>
            <a href="{{ route('admin') }}" class="py-1.5 {{ request()->routeIs('admin') ? 'text-amber-400 font-bold' : 'text-slate-400' }}">🏛️ Dirección</a>
        </div>
    </nav>

    <!-- Flash Alerts (Portero Notifications) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-950/70 border border-rose-500/50 text-rose-200 flex items-start space-x-3 shadow-lg shadow-rose-950/50 animate-fade-in">
                <div class="p-2 rounded-lg bg-rose-900/60 text-rose-300 shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-serif font-bold text-rose-100 text-sm tracking-wide">ACCESO DENEGADO POR EL PORTERO</h4>
                    <p class="text-sm text-rose-200/90 mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-950/70 border border-emerald-500/50 text-emerald-200 flex items-start space-x-3 shadow-lg shadow-emerald-950/50">
                <div class="p-2 rounded-lg bg-emerald-900/60 text-emerald-300 shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-serif font-bold text-emerald-100 text-sm tracking-wide">OPERACIÓN EXITOSA</h4>
                    <p class="text-sm text-emerald-200/90 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content Container -->
    <main class="flex-1 py-8">
        @yield('content')
    </main>

    <!-- Luxury Footer -->
    <footer class="bg-onyx-950 border-t border-amber-500/10 py-8 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 space-y-3">
            <div class="flex items-center justify-center space-x-2 text-amber-500/60">
                <span>⚜️</span>
                <span class="font-serif tracking-widest font-semibold uppercase">Grand Mirage Luxury Resort & Casino</span>
                <span>⚜️</span>
            </div>
            <p class="text-slate-400">
                Sistema de Navegación y Control de Accesos con Middlewares de Laravel.
            </p>
            <div class="flex justify-center gap-4 text-[11px] text-slate-500 pt-2">
                <span>🛡️ Portero de Autenticación: <span class="text-slate-300">CheckAuth</span></span>
                <span>•</span>
                <span>🎂 Portero de Edad: <span class="text-slate-300">CheckAge (18+)</span></span>
                <span>•</span>
                <span>👑 Portero de Roles: <span class="text-slate-300">CheckAdmin</span></span>
            </div>
        </div>
    </footer>

</body>
</html>


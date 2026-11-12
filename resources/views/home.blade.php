@extends('layouts.app')

@section('title', 'Bienvenido a Grand Mirage Resort & Casino')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

    <!-- Hero Section -->
    <div class="relative rounded-3xl overflow-hidden border border-amber-500/30 p-8 sm:p-14 bg-gradient-to-r from-onyx-900 via-onyx-850 to-onyx-900 shadow-2xl">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-semibold tracking-wider uppercase">
                <span>✦</span> Experiencia 5 Estrellas & Gran Lujo <span>✦</span>
            </div>

            <h1 class="text-4xl sm:text-6xl font-serif font-bold tracking-tight text-white leading-tight">
                Bienvenido al <br>
                <span class="gold-gradient-text">Grand Mirage Resort</span>
            </h1>

            <p class="text-slate-300 text-base sm:text-lg leading-relaxed font-light">
                Un oasis digital exclusivo donde el confort supremo se encuentra con la alta emoción del juego. 
                Cada rincón de nuestro resort cuenta con porteros virtuales que garantizan una experiencia segura, 
                privada y adaptada a cada visitante.
            </p>

            <div class="flex flex-wrap gap-4 pt-2">
                @auth
                    <a href="{{ route('panel') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-600 text-slate-950 font-bold hover:shadow-lg hover:shadow-amber-500/25 transition flex items-center gap-2">
                        <span>🛎️ Ir a mi Habitación</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-600 text-slate-950 font-bold hover:shadow-lg hover:shadow-amber-500/25 transition flex items-center gap-2">
                        <span>🔑 Check-in / Iniciar Sesión</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3.5 rounded-xl bg-onyx-800 border border-amber-500/30 text-amber-300 hover:bg-onyx-700 font-semibold transition">
                        Registrarse como Huésped
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Zonas del Complejo (Interactive Test Cards) -->
    <div>
        <div class="text-center max-w-2xl mx-auto mb-10 space-y-2">
            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
                Zonas del Complejo y Control de Acceso
            </h2>
            <p class="text-slate-400 text-sm">
                Pon a prueba a los <span class="text-amber-400 font-medium">porteros virtuales (Middlewares)</span> intentando acceder a las distintas estancias del resort:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1: Habitación Privada -->
            <div class="luxury-card rounded-2xl p-7 flex flex-col justify-between luxury-card-hover border-t-4 border-t-sky-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-sky-950/70 border border-sky-500/30 flex items-center justify-center text-2xl">
                            🛎️
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-sky-950/80 text-sky-400 border border-sky-500/30">
                            CheckAuth
                        </span>
                    </div>

                    <div>
                        <h3 class="font-serif text-xl font-bold text-white">Habitaciones Privadas</h3>
                        <p class="text-xs text-sky-300 font-medium mt-0.5">Ruta: <code class="bg-onyx-950 px-1.5 py-0.5 rounded text-sky-400">/panel</code></p>
                    </div>

                    <p class="text-slate-300 text-sm leading-relaxed">
                        Suites de lujo reservadas exclusivamente para huéspedes con sesión activa. Aquí podrás consultar tu información de estancia y relajarte.
                    </p>

                    <div class="p-3 rounded-lg bg-onyx-950/60 border border-slate-800 text-xs space-y-1">
                        <div class="text-slate-400 font-medium">🛡️ Portero a cargo:</div>
                        <div class="text-slate-200">Verifica si el huésped ha iniciado sesión. Si no, lo envía a recepción (login).</div>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('panel') }}" class="w-full py-2.5 px-4 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-semibold text-center block transition shadow-md shadow-sky-900/30">
                        Entrar a la Habitación &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 2: Casino Royal -->
            <div class="luxury-card rounded-2xl p-7 flex flex-col justify-between luxury-card-hover border-t-4 border-t-amber-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-amber-950/70 border border-amber-500/30 flex items-center justify-center text-2xl">
                            🎲
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-amber-950/80 text-amber-400 border border-amber-500/30">
                            CheckAuth + CheckAge
                        </span>
                    </div>

                    <div>
                        <h3 class="font-serif text-xl font-bold text-white">Casino VIP "Le Diamant"</h3>
                        <p class="text-xs text-amber-300 font-medium mt-0.5">Ruta: <code class="bg-onyx-950 px-1.5 py-0.5 rounded text-amber-400">/casino</code></p>
                    </div>

                    <p class="text-slate-300 text-sm leading-relaxed">
                        Exclusiva sala de ruleta, blackjack y póker de altas apuestas. El acceso está estrictamente reservado a mayores de 18 años.
                    </p>

                    <div class="p-3 rounded-lg bg-onyx-950/60 border border-slate-800 text-xs space-y-1">
                        <div class="text-slate-400 font-medium">🛡️ Porteros a cargo:</div>
                        <div class="text-slate-200">Requiere estar autenticado y tener al menos 18 años. Los menores son rebotados a su habitación.</div>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('casino') }}" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-500 hover:to-yellow-500 text-slate-950 font-bold text-center block transition shadow-md shadow-amber-900/30">
                        Entrar al Casino (+18) &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 3: Oficina de Dirección -->
            <div class="luxury-card rounded-2xl p-7 flex flex-col justify-between luxury-card-hover border-t-4 border-t-purple-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-purple-950/70 border border-purple-500/30 flex items-center justify-center text-2xl">
                            🏛️
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-purple-950/80 text-purple-400 border border-purple-500/30">
                            CheckAuth + CheckAdmin
                        </span>
                    </div>

                    <div>
                        <h3 class="font-serif text-xl font-bold text-white">Oficina de Dirección</h3>
                        <p class="text-xs text-purple-300 font-medium mt-0.5">Ruta: <code class="bg-onyx-950 px-1.5 py-0.5 rounded text-purple-400">/admin</code></p>
                    </div>

                    <p class="text-slate-300 text-sm leading-relaxed">
                        Despacho de presidencia y centro de mandos del resort. Solo el personal directivo con privilegios de administrador puede cruzar esta puerta.
                    </p>

                    <div class="p-3 rounded-lg bg-onyx-950/60 border border-slate-800 text-xs space-y-1">
                        <div class="text-slate-400 font-medium">🛡️ Porteros a cargo:</div>
                        <div class="text-slate-200">Requiere estar autenticado y poseer el rol <code class="text-purple-300">is_admin = true</code>.</div>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('admin') }}" class="w-full py-2.5 px-4 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-semibold text-center block transition shadow-md shadow-purple-900/30">
                        Entrar a Dirección &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Guía de Prueba Rápida de los Middlewares -->
    <div class="luxury-card rounded-2xl p-6 sm:p-8 border border-amber-500/20">
        <h3 class="font-serif text-xl font-bold text-amber-300 flex items-center gap-2">
            <span>📋</span> Casos de Prueba para la Evaluación
        </h3>
        <p class="text-slate-400 text-xs mt-1 mb-4">Utiliza los botones de la barra superior o las credenciales siguientes para validar cada middleware:</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
            <div class="p-4 rounded-xl bg-onyx-900/80 border border-purple-500/20">
                <div class="flex items-center gap-2 font-bold text-purple-300 text-sm">
                    <span>👑</span> Carlos Mendoza (Admin)
                </div>
                <div class="text-slate-400 mt-1">Email: <span class="text-slate-200">admin@resort.com</span> | Pass: <span class="text-slate-200">password</span></div>
                <div class="text-slate-400">Edad: <span class="text-slate-200">45 años</span> | Admin: <span class="text-emerald-400">Sí</span></div>
                <div class="mt-2 text-emerald-400 font-medium">✅ Puede acceder a todas las zonas: Habitación, Casino y Dirección.</div>
            </div>

            <div class="p-4 rounded-xl bg-onyx-900/80 border border-emerald-500/20">
                <div class="flex items-center gap-2 font-bold text-emerald-300 text-sm">
                    <span>🍸</span> Valeria Castillo (Adulta)
                </div>
                <div class="text-slate-400 mt-1">Email: <span class="text-slate-200">adulto@resort.com</span> | Pass: <span class="text-slate-200">password</span></div>
                <div class="text-slate-400">Edad: <span class="text-slate-200">26 años</span> | Admin: <span class="text-rose-400">No</span></div>
                <div class="mt-2 text-emerald-400 font-medium">✅ Entra a Habitación y Casino. ❌ Rechazada en Dirección (403/Redirige).</div>
            </div>

            <div class="p-4 rounded-xl bg-onyx-900/80 border border-amber-500/20">
                <div class="flex items-center gap-2 font-bold text-amber-300 text-sm">
                    <span>🧒</span> Mateo Fernández (Menor)
                </div>
                <div class="text-slate-400 mt-1">Email: <span class="text-slate-200">menor@resort.com</span> | Pass: <span class="text-slate-200">password</span></div>
                <div class="text-slate-400">Edad: <span class="text-slate-200">16 años</span> | Admin: <span class="text-rose-400">No</span></div>
                <div class="mt-2 text-amber-400 font-medium">✅ Entra a Habitación. ❌ Rechazado en Casino (+18) y en Dirección.</div>
            </div>
        </div>
    </div>

</div>
@endsection


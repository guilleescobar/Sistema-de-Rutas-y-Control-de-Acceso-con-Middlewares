@extends('layouts.app')

@section('title', 'Habitación Privada del Huésped | Grand Mirage')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Suite Header / Welcome Card -->
    <div class="luxury-card rounded-3xl p-8 sm:p-10 border border-sky-500/30 relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-950/70 border border-sky-500/30 text-sky-300 text-xs font-semibold tracking-wider">
                    <span>🛎️</span> ZONA PRIVADA DEL HUÉSPED • PROTEGIDA POR CHECKAUTH
                </div>

                <h1 class="text-3xl sm:text-4xl font-serif font-bold text-white">
                    ¡Bienvenido a tu Suite Privada, <span class="text-amber-400">{{ Auth::user()->name }}</span>!
                </h1>

                <p class="text-slate-300 text-sm max-w-2xl leading-relaxed">
                    Esta es tu estancia privada en el Grand Mirage. Has superado el filtro del portero de autenticación 
                    (<code class="text-sky-400 bg-onyx-950 px-1 py-0.5 rounded">CheckAuth</code>). Desde aquí puedes relajarte 
                    o explorar otras zonas exclusivas del complejo.
                </p>
            </div>

            <!-- Suite Badge -->
            <div class="flex items-center gap-4 bg-onyx-950/80 p-5 rounded-2xl border border-slate-800 shrink-0">
                <div class="w-14 h-14 rounded-xl bg-sky-600/20 border border-sky-500/30 flex items-center justify-center text-3xl">
                    🚪
                </div>
                <div>
                    <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Suite Asignada</div>
                    <div class="text-xl font-serif font-bold text-white">#{{ 300 + Auth::id() }} Real</div>
                    <div class="text-xs text-sky-400">Piso {{ 3 + (int)(Auth::id() / 10) }} • Vista al Océano</div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Dossier / Ficha del Huésped -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Ficha de Datos -->
        <div class="luxury-card rounded-2xl p-6 border border-slate-800 space-y-4">
            <h3 class="font-serif text-lg font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                <span>📋</span> Datos de tu Acreditación
            </h3>

            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-xs text-slate-400 uppercase tracking-wider block">Nombre</span>
                    <span class="text-slate-100 font-semibold">{{ Auth::user()->name }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-400 uppercase tracking-wider block">Correo Electrónico</span>
                    <span class="text-slate-100">{{ Auth::user()->email }}</span>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div>
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Edad Registrada</span>
                        <span class="text-base font-bold {{ Auth::user()->age >= 18 ? 'text-emerald-400' : 'text-amber-400' }}">
                            {{ Auth::user()->age }} años
                        </span>
                    </div>
                    <div>
                        @if(Auth::user()->age >= 18)
                            <span class="px-2 py-1 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 text-xs font-semibold">
                                ✓ Mayor de edad (+18)
                            </span>
                        @else
                            <span class="px-2 py-1 rounded bg-amber-950 text-amber-300 border border-amber-500/30 text-xs font-semibold">
                                ⚠ Menor de edad
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div>
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Rango / Rol</span>
                        <span class="text-sm font-semibold {{ Auth::user()->is_admin ? 'text-purple-400' : 'text-slate-300' }}">
                            {{ Auth::user()->is_admin ? 'Personal Directivo' : 'Huésped Registrado' }}
                        </span>
                    </div>
                    <div>
                        @if(Auth::user()->is_admin)
                            <span class="px-2 py-1 rounded bg-purple-950 text-purple-300 border border-purple-500/30 text-xs font-bold">
                                Administrador
                            </span>
                        @else
                            <span class="px-2 py-1 rounded bg-slate-800 text-slate-300 border border-slate-700 text-xs">
                                Estándar
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Services / Confort de la Suite -->
        <div class="luxury-card rounded-2xl p-6 border border-slate-800 space-y-4">
            <h3 class="font-serif text-lg font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                <span>🥂</span> Servicios de la Habitación
            </h3>

            <ul class="space-y-3 text-xs text-slate-300">
                <li class="flex items-center justify-between p-2 rounded-lg bg-onyx-950/60 border border-slate-800">
                    <span class="flex items-center gap-2"><span>🍾</span> Cava de Bienvenida</span>
                    <button type="button" onclick="alert('🍾 ¡Tu botella de Cava Brut Reserva ha sido enviada a tu Suite #{{ 300 + Auth::id() }}!')" 
                            class="text-xs px-2.5 py-1 rounded bg-amber-500/10 text-amber-400 hover:bg-amber-500/20 font-semibold transition border border-amber-500/30">
                        Pedir a Suite
                    </button>
                </li>
                <li class="flex items-center justify-between p-2 rounded-lg bg-onyx-950/60 border border-slate-800">
                    <span class="flex items-center gap-2"><span>📶</span> Wi-Fi Ultra Rápido</span>
                    <button type="button" onclick="alert('📶 Conexión VIP activada: GrandMirage_Suite_{{ 300 + Auth::id() }} (Velocidad: 1 Gbps)')" 
                            class="text-xs px-2.5 py-1 rounded bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 font-semibold transition border border-emerald-500/30">
                        Conectar
                    </button>
                </li>
                <li class="flex items-center justify-between p-2 rounded-lg bg-onyx-950/60 border border-slate-800">
                    <span class="flex items-center gap-2"><span>🧖‍♂️</span> Spa & Termas Privadas</span>
                    <button type="button" onclick="alert('🧖‍♂️ Cita reservada en el circuito termal para {{ Auth::user()->name }} a las 20:00h.')" 
                            class="text-xs px-2.5 py-1 rounded bg-sky-500/10 text-sky-400 hover:bg-sky-500/20 font-semibold transition border border-sky-500/30">
                        Reservar
                    </button>
                </li>
                <li class="flex items-center justify-between p-2 rounded-lg bg-onyx-950/60 border border-slate-800">
                    <span class="flex items-center gap-2"><span>🛎️</span> Mayordomo 24/7</span>
                    <button type="button" onclick="alert('🛎️ El Mayordomo Principal se pondrá en contacto contigo en los próximos 2 minutos.')" 
                            class="text-xs px-2.5 py-1 rounded bg-purple-500/10 text-purple-400 hover:bg-purple-500/20 font-semibold transition border border-purple-500/30">
                        Llamar
                    </button>
                </li>
            </ul>
        </div>

        <!-- Próximos Destinos / Probar Porteros -->
        <div class="luxury-card rounded-2xl p-6 border border-slate-800 space-y-4 flex flex-col justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                    <span>🚪</span> Salir de la Habitación
                </h3>
                <p class="text-xs text-slate-400 mt-2">
                    Pon a prueba los otros porteros saliendo hacia las áreas restringidas:
                </p>

                <div class="space-y-2.5 mt-4">
                    <a href="{{ route('casino') }}" 
                       class="flex items-center justify-between p-3 rounded-xl bg-amber-950/40 border border-amber-500/30 hover:bg-amber-900/40 transition group">
                        <div class="flex items-center gap-2.5">
                            <span class="text-lg">🎲</span>
                            <div>
                                <div class="text-xs font-bold text-amber-300">Ir al Casino VIP (+18)</div>
                                <div class="text-[10px] text-slate-400">Comprueba CheckAge ({{ Auth::user()->age }} años)</div>
                            </div>
                        </div>
                        <span class="text-xs text-amber-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>

                    <a href="{{ route('admin') }}" 
                       class="flex items-center justify-between p-3 rounded-xl bg-purple-950/40 border border-purple-500/30 hover:bg-purple-900/40 transition group">
                        <div class="flex items-center gap-2.5">
                            <span class="text-lg">🏛️</span>
                            <div>
                                <div class="text-xs font-bold text-purple-300">Ir a Dirección</div>
                                <div class="text-[10px] text-slate-400">Comprueba CheckAdmin</div>
                            </div>
                        </div>
                        <span class="text-xs text-purple-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>

            <div class="pt-2 border-t border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 px-3 rounded-lg bg-onyx-950 border border-slate-700 text-slate-300 hover:text-rose-300 hover:border-rose-500/50 text-xs font-medium transition">
                        Devolver llave y Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection

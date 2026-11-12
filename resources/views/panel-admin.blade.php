@extends('layouts.app')

@section('title', 'Oficina de Dirección General | Grand Mirage')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Admin Suite Header -->
    <div class="luxury-card rounded-3xl p-8 sm:p-10 border border-purple-500/40 relative overflow-hidden bg-gradient-to-r from-purple-950/40 via-onyx-900 to-indigo-950/40">
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-purple-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/15 border border-purple-500/40 text-purple-300 text-xs font-semibold tracking-wider">
                    <span>👑</span> ZONA RESTRINGIDA • FILTRADA POR CHECKAUTH + CHECKADMIN
                </div>

                <h1 class="text-3xl sm:text-5xl font-serif font-bold text-white">
                    Oficina de <span class="gold-gradient-text">Dirección General</span>
                </h1>

                <p class="text-slate-300 text-sm max-w-2xl leading-relaxed">
                    Acceso autorizado a <strong class="text-purple-300">{{ Auth::user()->name }}</strong>. 
                    El middleware <code class="text-purple-300 bg-onyx-950 px-1 py-0.5 rounded">CheckAdmin</code> 
                    ha verificado que tu credencial cuenta con el permiso <code class="text-emerald-400 bg-onyx-950 px-1 py-0.5 rounded">is_admin = true</code>.
                </p>
            </div>

            <!-- Security Badge -->
            <div class="flex items-center gap-4 bg-onyx-950/90 p-5 rounded-2xl border border-purple-500/40 shrink-0">
                <div class="w-14 h-14 rounded-xl bg-purple-600/20 border border-purple-500/40 flex items-center justify-center text-3xl">
                    🏛️
                </div>
                <div>
                    <div class="text-[10px] uppercase font-bold text-purple-300/80 tracking-wider">Nivel de Seguridad</div>
                    <div class="text-xl font-serif font-bold text-white">Directorio Máximo</div>
                    <div class="text-xs text-purple-400">Control de Accesos 100% Activo</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resort Metrics Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="luxury-card rounded-2xl p-5 border border-slate-800">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Ocupación del Complejo</div>
            <div class="text-3xl font-serif font-bold text-white mt-2">87.5%</div>
            <div class="text-xs text-emerald-400 mt-1 flex items-center gap-1">
                <span>↑ 4.2%</span> <span class="text-slate-500">vs semana anterior</span>
            </div>
        </div>

        <div class="luxury-card rounded-2xl p-5 border border-slate-800">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Huéspedes Registrados</div>
            <div class="text-3xl font-serif font-bold text-amber-400 mt-2">{{ \App\Models\User::count() }}</div>
            <div class="text-xs text-slate-400 mt-1">Usuarios en base de datos</div>
        </div>

        <div class="luxury-card rounded-2xl p-5 border border-slate-800">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Filtro CheckAge (Casino)</div>
            <div class="text-3xl font-serif font-bold text-emerald-400 mt-2">Activo</div>
            <div class="text-xs text-slate-400 mt-1">Bloqueo automático a menores de 18</div>
        </div>

        <div class="luxury-card rounded-2xl p-5 border border-slate-800">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Filtro CheckAdmin (Dirección)</div>
            <div class="text-3xl font-serif font-bold text-purple-400 mt-2">Blindado</div>
            <div class="text-xs text-slate-400 mt-1">Rebote a usuarios sin is_admin</div>
        </div>
    </div>

    <!-- Lista de Huéspedes en la Base de Datos con Controles Interactivos -->
    <div class="luxury-card rounded-2xl p-6 sm:p-8 border border-slate-800 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800 pb-4">
            <div>
                <h3 class="font-serif text-xl font-bold text-white">Panel de Control de Huéspedes y Permisos</h3>
                <p class="text-xs text-slate-400 mt-0.5">Puedes alternar roles o modificar edades directamente para poner a prueba los porteros virtuales:</p>
            </div>
            <span class="text-xs px-3 py-1 rounded-full bg-onyx-950 border border-slate-700 text-slate-300">
                Total: {{ \App\Models\User::count() }} usuarios
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider text-[10px]">
                        <th class="py-3 px-4">Huésped</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Edad</th>
                        <th class="py-3 px-4">Rol Admin</th>
                        <th class="py-3 px-4 text-center">Permiso Casino (+18)</th>
                        <th class="py-3 px-4 text-center">Acciones de Prueba</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @foreach(\App\Models\User::all() as $u)
                        <tr class="hover:bg-onyx-850/60 transition">
                            <td class="py-3.5 px-4 font-semibold text-slate-100 flex items-center gap-2">
                                <span>{{ $u->is_admin ? '👑' : ($u->age >= 18 ? '🍸' : '🧒') }}</span>
                                <span>{{ $u->name }}</span>
                                @if(Auth::id() == $u->id)
                                    <span class="text-[9px] px-1.5 py-0.2 rounded bg-purple-500/20 text-purple-300 border border-purple-500/40">Tú</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-400 font-mono">{{ $u->email }}</td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold {{ $u->age >= 18 ? 'text-emerald-400' : 'text-amber-400' }}">
                                    {{ $u->age }} años
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                @if($u->is_admin)
                                    <span class="px-2 py-0.5 rounded bg-purple-950 text-purple-300 border border-purple-500/40 font-bold">✓ Admin</span>
                                @else
                                    <span class="px-2 py-0.5 rounded bg-slate-800 text-slate-400 border border-slate-700">Huésped</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($u->age >= 18)
                                    <span class="text-emerald-400 font-bold">✓ Permitido</span>
                                @else
                                    <span class="text-rose-400 font-bold">✗ Denegado</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Toggle Admin -->
                                    <form action="{{ route('admin.users.toggle-admin', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Alternar Rol Administrador" 
                                                class="px-2 py-1 rounded text-[11px] font-semibold border transition {{ $u->is_admin ? 'bg-purple-950 text-purple-300 border-purple-500/40 hover:bg-purple-900' : 'bg-slate-800 text-slate-300 border-slate-700 hover:bg-purple-950 hover:text-purple-300' }}">
                                            {{ $u->is_admin ? 'Quitar Admin' : 'Hacer Admin' }}
                                        </button>
                                    </form>

                                    <!-- Toggle Age (Mayor / Menor) -->
                                    <form action="{{ route('admin.users.set-age', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="age" value="{{ $u->age >= 18 ? 16 : 25 }}">
                                        <button type="submit" title="Alternar Edad (Mayor/Menor)" 
                                                class="px-2 py-1 rounded text-[11px] font-semibold border transition {{ $u->age >= 18 ? 'bg-amber-950/60 text-amber-300 border-amber-500/30 hover:bg-amber-900' : 'bg-emerald-950/60 text-emerald-300 border-emerald-500/30 hover:bg-emerald-900' }}">
                                            {{ $u->age >= 18 ? 'Poner 16a (Menor)' : 'Poner 25a (Adulto)' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

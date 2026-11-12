@extends('layouts.app')

@section('title', 'Acceso Denegado (403) | Grand Mirage Resort')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-16 text-center space-y-8">
    <div class="luxury-card rounded-3xl p-10 sm:p-14 border border-rose-500/40 relative overflow-hidden">
        <div class="w-20 h-20 mx-auto rounded-2xl bg-rose-950/80 border border-rose-500/40 flex items-center justify-center text-4xl shadow-xl shadow-rose-950/50">
            🚫
        </div>

        <div class="space-y-3 mt-6">
            <span class="text-xs uppercase font-bold tracking-widest text-rose-400">Error 403 • Prohibido el Paso</span>
            <h1 class="text-3xl sm:text-4xl font-serif font-bold text-white">
                Zona de Acceso Restringido
            </h1>
            <p class="text-slate-300 text-sm max-w-md mx-auto leading-relaxed">
                El portero virtual <code class="text-rose-300 bg-onyx-950 px-1 py-0.5 rounded">CheckAdmin</code> 
                ha bloqueado tu entrada a la Oficina de Dirección porque tu credencial no cuenta con privilegios directivos 
                (<code class="text-amber-400 bg-onyx-950 px-1 py-0.5 rounded">is_admin = false</code>).
            </p>
        </div>

        <div class="pt-8 flex flex-wrap justify-center gap-4">
            <a href="{{ route('panel') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 font-bold hover:shadow-lg hover:shadow-amber-500/20 transition">
                🛎️ Volver a mi Habitación
            </a>
            <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-slate-300 hover:text-white transition">
                🏝️ Ir al Vestíbulo Principal
            </a>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('title', 'Registro de Nuevos Huéspedes | Grand Mirage')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    
    <div class="luxury-card rounded-3xl p-8 sm:p-10 border border-amber-500/30">
        <!-- Header -->
        <div class="text-center space-y-2 mb-8">
            <div class="inline-flex p-3 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-400 text-2xl mb-2">
                ✍️
            </div>
            <h1 class="text-3xl font-serif font-bold text-white tracking-wide">
                Registro de Nuevo Huésped
            </h1>
            <p class="text-slate-400 text-sm">
                Completa tus datos para emitir tu tarjeta de acceso virtual del resort.
            </p>
        </div>

        <!-- Formulario de Registro -->
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Nombre Completo
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
                       placeholder="Ej. Rodrigo Santoro">
                @error('name')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Correo Electrónico
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
                       placeholder="huesped@resort.com">
                @error('email')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="age" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5 flex items-center justify-between">
                        <span>Edad (Años)</span>
                        <span class="text-[10px] text-amber-400 font-normal lowercase">Determina el acceso al Casino</span>
                    </label>
                    <input type="number" id="age" name="age" value="{{ old('age', 21) }}" min="1" max="120" required
                           class="w-full px-4 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
                           placeholder="Ej. 25">
                    @error('age')
                        <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Contraseña
                    </label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
                           placeholder="••••••••">
                    @error('password')
                        <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-600 text-slate-950 font-bold hover:shadow-lg hover:shadow-amber-500/25 transition">
                    Crear Cuenta y Recibir Llave
                </button>
            </div>
        </form>

        <div class="text-center mt-6 text-xs text-slate-400">
            ¿Ya tienes tu reserva registrada? 
            <a href="{{ route('login') }}" class="text-amber-400 hover:underline font-semibold">Inicia sesión</a>
        </div>
    </div>

</div>
@endsection


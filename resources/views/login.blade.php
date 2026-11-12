@extends('layouts.app')

@section('title', 'Check-In de Huéspedes | Grand Mirage')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    
    <div class="luxury-card rounded-3xl p-8 sm:p-10 border border-amber-500/30">
        <!-- Header -->
        <div class="text-center space-y-2 mb-8">
            <div class="inline-flex p-3 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-400 text-2xl mb-2">
                🔑
            </div>
            <h1 class="text-3xl font-serif font-bold text-white tracking-wide">
                Recepción & Check-in
            </h1>
            <p class="text-slate-400 text-sm">
                Identifícate con tu credencial del resort para acceder a tus áreas reservadas.
            </p>
        </div>

        <!-- Formulario de Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Correo Electrónico
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', 'admin@resort.com') }}" required
                       class="w-full px-4 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
                       placeholder="tu-correo@resort.com">
                @error('email')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                    Contraseña
                </label>
                <input type="password" id="password" name="password" value="password" required
                       class="w-full px-4 py-3 rounded-xl bg-onyx-950 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
                       placeholder="••••••••">
                @error('password')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-600 text-slate-950 font-bold hover:shadow-lg hover:shadow-amber-500/25 transition">
                    Entrar al Resort
                </button>
            </div>
        </form>

        <!-- Divisor -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-800"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-onyx-900 px-3 text-slate-500 font-semibold tracking-wider">O selecciona una llave de prueba rápida</span>
            </div>
        </div>

        <!-- Quick Switcher Buttons -->
        <div class="space-y-2.5">
            <a href="{{ route('quick.login', 'admin') }}" 
               class="flex items-center justify-between p-3 rounded-xl bg-onyx-950/80 border border-purple-500/30 hover:border-purple-500 hover:bg-purple-950/30 transition group">
                <div class="flex items-center gap-3">
                    <span class="text-xl">👑</span>
                    <div>
                        <div class="text-sm font-semibold text-purple-300 group-hover:text-purple-200">Director General (Admin)</div>
                        <div class="text-[11px] text-slate-400">admin@resort.com • 45 años • Acceso total</div>
                    </div>
                </div>
                <span class="text-xs text-purple-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>

            <a href="{{ route('quick.login', 'adulto') }}" 
               class="flex items-center justify-between p-3 rounded-xl bg-onyx-950/80 border border-emerald-500/30 hover:border-emerald-500 hover:bg-emerald-950/30 transition group">
                <div class="flex items-center gap-3">
                    <span class="text-xl">🍸</span>
                    <div>
                        <div class="text-sm font-semibold text-emerald-300 group-hover:text-emerald-200">Valeria Castillo (Huésped Adulta)</div>
                        <div class="text-[11px] text-slate-400">adulto@resort.com • 26 años • Acceso a Casino</div>
                    </div>
                </div>
                <span class="text-xs text-emerald-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>

            <a href="{{ route('quick.login', 'menor') }}" 
               class="flex items-center justify-between p-3 rounded-xl bg-onyx-950/80 border border-amber-500/30 hover:border-amber-500 hover:bg-amber-950/30 transition group">
                <div class="flex items-center gap-3">
                    <span class="text-xl">🧒</span>
                    <div>
                        <div class="text-sm font-semibold text-amber-300 group-hover:text-amber-200">Mateo Fernández (Huésped Menor)</div>
                        <div class="text-[11px] text-slate-400">menor@resort.com • 16 años • Restringido en Casino</div>
                    </div>
                </div>
                <span class="text-xs text-amber-400 group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>
        </div>

        <div class="text-center mt-6 text-xs text-slate-400">
            ¿No tienes cuenta de huésped? 
            <a href="{{ route('register') }}" class="text-amber-400 hover:underline font-semibold">Regístrate aquí</a>
        </div>
    </div>

</div>
@endsection


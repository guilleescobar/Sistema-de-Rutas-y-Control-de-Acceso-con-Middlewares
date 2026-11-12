@extends('layouts.app')

@section('title', 'Casino VIP Le Diamant (+18) | Grand Mirage')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8" x-data="casinoApp()">

    <!-- Casino Header -->
    <div class="luxury-card rounded-3xl p-8 sm:p-10 border border-amber-500/40 relative overflow-hidden bg-gradient-to-r from-red-950/40 via-onyx-900 to-amber-950/40">
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-semibold tracking-wider">
                    <span>🎲</span> SALA DE JUEGOS EXCLUSIVA • FILTRADA POR CHECKAUTH + CHECKAGE
                </div>

                <h1 class="text-3xl sm:text-5xl font-serif font-bold text-white">
                    Casino VIP <span class="gold-gradient-text">"Le Diamant"</span>
                </h1>

                <p class="text-slate-300 text-sm max-w-2xl leading-relaxed">
                    ¡Bienvenido, <strong class="text-amber-300">{{ Auth::user()->name }}</strong>! Has superado el control de edad del portero 
                    (<code class="text-amber-400 bg-onyx-950 px-1 py-0.5 rounded">CheckAge</code>) con tus <strong class="text-emerald-400">{{ Auth::user()->age }} años</strong>. 
                    Disfruta de la mejor ruleta francesa, blackjack high-roller y coctelería selecta.
                </p>
            </div>

            <!-- Fichas VIP -->
            <div class="flex items-center gap-4 bg-onyx-950/90 p-5 rounded-2xl border border-amber-500/30 shrink-0">
                <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-amber-600 via-yellow-500 to-amber-300 p-1 flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <div class="w-full h-full rounded-full bg-onyx-950 flex items-center justify-center text-xl font-black text-amber-400">
                        ♠
                    </div>
                </div>
                <div>
                    <div class="text-[10px] uppercase font-bold text-amber-400/80 tracking-wider">Crédito de Juego</div>
                    <div class="text-2xl font-serif font-bold text-white" id="vip-chips">$ 10,000 VIP</div>
                    <div class="text-xs text-emerald-400">Acceso a Salón Privé concedido</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mesas de Juego & Salones Interactivos -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Mesa 1: Ruleta Francesa -->
        <div class="luxury-card rounded-2xl p-6 border border-slate-800 space-y-4 hover:border-amber-500/40 transition">
            <div class="flex items-center justify-between">
                <span class="text-3xl">🎰</span>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-rose-950 text-rose-300 border border-rose-500/40">Mesa 01</span>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-white">Ruleta Francesa Grand Royal</h3>
                <p class="text-xs text-slate-400 mt-1">Cilindro de caoba con crupieres en vivo. Apuesta mínima 50€.</p>
            </div>
            <div class="p-3 rounded-xl bg-onyx-950/80 border border-slate-800 flex justify-between items-center text-xs">
                <span class="text-slate-400">Resultado de la bola:</span>
                <span class="font-mono text-amber-300 font-bold" id="roulette-result">17 Negro (Impar)</span>
            </div>
            <button type="button" onclick="spinRoulette()" class="w-full py-2.5 px-3 rounded-lg bg-onyx-900 hover:bg-amber-500 hover:text-slate-950 text-amber-400 border border-amber-500/30 text-xs font-bold transition flex items-center justify-center gap-2">
                <span>🎡 Girar la Ruleta Real</span>
            </button>
        </div>

        <!-- Mesa 2: Blackjack High Roller -->
        <div class="luxury-card rounded-2xl p-6 border border-slate-800 space-y-4 hover:border-amber-500/40 transition">
            <div class="flex items-center justify-between">
                <span class="text-3xl">🃏</span>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-950 text-emerald-300 border border-emerald-500/40">Mesa 02</span>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-white">Blackjack Privé 21</h3>
                <p class="text-xs text-slate-400 mt-1">Reglas europeas, 6 barajas, crupier se planta en 17.</p>
            </div>
            <div class="p-3 rounded-xl bg-onyx-950/80 border border-slate-800 flex justify-between items-center text-xs">
                <span class="text-slate-400">Tus cartas en mano:</span>
                <span class="font-mono text-emerald-400 font-bold" id="blackjack-hand">A♠ + K♦ (21)</span>
            </div>
            <button type="button" onclick="dealBlackjack()" class="w-full py-2.5 px-3 rounded-lg bg-onyx-900 hover:bg-amber-500 hover:text-slate-950 text-amber-400 border border-amber-500/30 text-xs font-bold transition flex items-center justify-center gap-2">
                <span>🎴 Repartir Nueva Mano</span>
            </button>
        </div>

        <!-- Mesa 3: Texas Hold'em VIP -->
        <div class="luxury-card rounded-2xl p-6 border border-slate-800 space-y-4 hover:border-amber-500/40 transition">
            <div class="flex items-center justify-between">
                <span class="text-3xl">🍸</span>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-purple-950 text-purple-300 border border-purple-500/40">Lounge</span>
            </div>
            <div>
                <h3 class="font-serif text-lg font-bold text-white">Coctelería & Bar de Jugadores</h3>
                <p class="text-xs text-slate-400 mt-1">Martinis secos, whisky single malt y cócteles de autor cortesía del resort.</p>
            </div>
            <div class="p-3 rounded-xl bg-onyx-950/80 border border-slate-800 flex justify-between items-center text-xs">
                <span class="text-slate-400">Última consumición:</span>
                <span class="text-slate-200 font-semibold" id="cocktail-name">Dry Martini Royal</span>
            </div>
            <button type="button" onclick="orderCocktail()" class="w-full py-2.5 px-3 rounded-lg bg-onyx-900 hover:bg-amber-500 hover:text-slate-950 text-amber-400 border border-amber-500/30 text-xs font-bold transition flex items-center justify-center gap-2">
                <span>🍸 Pedir Cóctel a la Mesa</span>
            </button>
        </div>

    </div>

    <!-- Security Check Stamp / Nota del Portero -->
    <div class="p-4 rounded-2xl bg-onyx-900/90 border border-emerald-500/30 flex items-center justify-between text-xs">
        <div class="flex items-center space-x-3">
            <span class="text-2xl">🛡️</span>
            <div>
                <span class="text-emerald-400 font-bold uppercase tracking-wider">Control de Portería Superado con Éxito:</span>
                <p class="text-slate-400 mt-0.5">El middleware <code class="text-emerald-300 font-semibold">CheckAge</code> confirmó que tu edad (<span class="text-white font-bold">{{ Auth::user()->age }}</span> años) cumple con la condición de ser mayor o igual a 18 años.</p>
            </div>
        </div>
        <a href="{{ route('panel') }}" class="px-4 py-2 rounded-lg bg-onyx-950 text-slate-300 hover:text-white border border-slate-700 transition shrink-0 hidden sm:inline-block">
            Volver a mi Suite &rarr;
        </a>
    </div>

</div>

<!-- Interactive Casino JavaScript -->
<script>
    let chips = 10000;

    function spinRoulette() {
        const numbers = [0, 32, 15, 19, 4, 21, 2, 25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23, 10, 5, 24, 16, 33, 1, 20, 14, 31, 9, 22, 18, 29, 7, 28, 12, 35, 3, 26];
        const colors = ['Rojo', 'Negro'];
        const randomNum = numbers[Math.floor(Math.random() * numbers.length)];
        const color = randomNum === 0 ? 'Verde (Banca)' : colors[Math.floor(Math.random() * colors.length)];
        const parity = randomNum === 0 ? '' : (randomNum % 2 === 0 ? 'Par' : 'Impar');

        const el = document.getElementById('roulette-result');
        el.innerText = 'Girando cilindro...';
        el.classList.add('animate-pulse');

        setTimeout(() => {
            el.classList.remove('animate-pulse');
            el.innerText = `${randomNum} ${color} ${parity ? '('+parity+')' : ''}`;
            const won = Math.random() > 0.5;
            if (won) {
                chips += 500;
                alert(`¡Ganaste en la Ruleta! Salió el número ${randomNum} ${color}. +$500 fichas añadidas.`);
            } else {
                chips = Math.max(0, chips - 100);
                alert(`Resultado: Número ${randomNum} ${color}. La banca toma 100 fichas.`);
            }
            document.getElementById('vip-chips').innerText = `$ ${chips.toLocaleString()} VIP`;
        }, 600);
    }

    function dealBlackjack() {
        const cards = [
            { name: 'A♠', val: 11 }, { name: 'K♦', val: 10 }, { name: 'Q♣', val: 10 }, 
            { name: 'J♥', val: 10 }, { name: '10♠', val: 10 }, { name: '9♦', val: 9 }, 
            { name: '8♣', val: 8 }, { name: '7♥', val: 7 }
        ];
        const c1 = cards[Math.floor(Math.random() * cards.length)];
        const c2 = cards[Math.floor(Math.random() * cards.length)];
        const total = c1.val + c2.val;
        const resultText = total === 21 ? `${c1.name} + ${c2.name} = ¡BLACKJACK! (21)` : `${c1.name} + ${c2.name} = Total ${total}`;

        document.getElementById('blackjack-hand').innerText = resultText;
        if (total === 21) {
            chips += 1500;
            alert(`¡BLACKJACK NATURAL! Pago 3 a 2. +$1,500 en fichas.`);
        } else {
            alert(`Mano repartida: ${c1.name} y ${c2.name} (Puntuación: ${total}).`);
        }
        document.getElementById('vip-chips').innerText = `$ ${chips.toLocaleString()} VIP`;
    }

    function orderCocktail() {
        const cocktails = [
            'Negroni Imperial con ginebra botánica',
            'Dry Martini Royal con aceituna gordal',
            'Old Fashioned con bourbon añejo 12 años',
            'Champagne Vintage Rosé Gran Reserva'
        ];
        const choice = cocktails[Math.floor(Math.random() * cocktails.length)];
        document.getElementById('cocktail-name').innerText = choice;
        alert(`🍸 El maître Jean-Luc ha preparado tu consumición: ${choice}. ¡Cortesía de la casa!`);
    }
</script>
@endsection

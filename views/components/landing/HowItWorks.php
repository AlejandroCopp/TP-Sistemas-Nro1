<?php
function LandingHowItWorks(){
?>
<!-- How It Works Section -->
<section id="como-funciona" class="py-20 sm:py-28 bg-[#161B22]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">Jugar nunca fue tan fácil</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center relative">
            <!-- Dashed line for desktop -->
            <div class="hidden md:block absolute top-1/2 left-0 right-0 h-px -translate-y-1/2">
                <svg width="100%" height="2"><line x1="0" y1="1" x2="100%" y2="1" stroke="#30363D" stroke-width="2" stroke-dasharray="8 8"/></svg>
            </div>

            <div class="relative z-10">
                <div class="mx-auto w-16 h-16 flex items-center justify-center bg-gray-800 border-2 border-green-500 rounded-full text-2xl font-bold text-green-500 mb-4">1</div>
                <h3 class="text-xl font-semibold text-white">Publica o Busca</h3>
                <p class="mt-2 text-gray-400">Como organizador, crea tu partido. Como jugador, explora el feed y encuentra partidos cerca de ti.</p>
            </div>
             <div class="relative z-10">
                <div class="mx-auto w-16 h-16 flex items-center justify-center bg-gray-800 border-2 border-green-500 rounded-full text-2xl font-bold text-green-500 mb-4">2</div>
                <h3 class="text-xl font-semibold text-white">Arma o Súmate</h3>
                <p class="mt-2 text-gray-400">Gestiona tu lista de postulantes y confirma a tus jugadores, o postúlate y espera la confirmación.</p>
            </div>
             <div class="relative z-10">
                <div class="mx-auto w-16 h-16 flex items-center justify-center bg-gray-800 border-2 border-green-500 rounded-full text-2xl font-bold text-green-500 mb-4">3</div>
                <h3 class="text-xl font-semibold text-white">¡A Jugar!</h3>
                <p class="mt-2 text-gray-400">Con el equipo completo, solo queda disfrutar. Al finalizar, el organizador carga el resultado y listo.</p>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
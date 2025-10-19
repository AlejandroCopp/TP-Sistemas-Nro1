<?php
function LandingCTA(){
?>
<!-- Final CTA Section -->
<section id="cta-final" class="bg-[#161B22]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
         <h2 class="text-3xl sm:text-5xl font-extrabold text-white">El fútbol amateur está a punto de cambiar para siempre.</h2>
         <p class="mt-4 text-lg text-gray-400">No te quedes afuera de la cancha. Únete a nuestra comunidad y sé el primero en saber cuándo lanzamos.</p>
         <form class="mt-10 max-w-lg mx-auto">
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Tu correo electrónico" required class="w-full px-5 py-3 rounded-lg bg-[#0D1117] border border-gray-700 text-white focus:ring-2 focus:ring-green-500 focus:outline-none">
                <button type="submit" class="cta-button w-full sm:w-auto flex-shrink-0 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">
                    🏆 ¡Avísenme para el Lanzamiento!
                </button>
            </div>
         </form>
    </div>
</section>
<?php
}
?>
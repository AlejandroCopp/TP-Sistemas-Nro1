<?php
function LandingHeader(){
?>
<!-- Header -->
<header class="sticky top-0 z-50 w-full backdrop-blur-md bg-opacity-70 border-b border-gray-700">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="#" class="flex items-center space-x-2">
                    
                    <span class="font-bold text-xl text-white">⚽ FutMatch</span>
                </a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="#problema" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">El Problema</a>
                    <a href="#solucion" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">La Solución</a>
                    <a href="#como-funciona" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">¿Cómo funciona?</a>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <a href="#cta-final" class="cta-button bg-green-600 hover:bg-green-300 text-white font-bold py-2 px-4 rounded-lg text-sm">
                    ¡Quiero Acceso Anticipado!
                </a>
                <a href="/login" class="cta-button bg-blue-600 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded-lg text-sm">
                    Iniciar sesion
                </a>
                <a href="/register" class="cta-button bg-cyan-600 hover:bg-cyan-300 text-white font-bold py-2 px-4 rounded-lg text-sm">
                    Registrarse
                </a>
            </div>
        </div>
    </nav>
</header>
<?php
}
?>
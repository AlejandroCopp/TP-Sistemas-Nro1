<?php
require_once __DIR__ . '/components/Table.php';
function Home(){

  // logica del componente



?>



<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Apuestas del Potrero | Apuestas Claras, Amistades Largas</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-gray-900 bg-opacity-80 backdrop-blur-sm text-sm py-3 sm:py-0 fixed top-0">
        <nav class="relative max-w-7xl w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold text-white" href="#" aria-label="Brand">⚽ Gestor Potrero</a>
            </div>
            <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:ps-7">
                    <a class="font-medium text-gray-400 hover:text-gray-200 sm:py-6" href="#problema">El Problema</a>
                    <a class="font-medium text-gray-400 hover:text-gray-200 sm:py-6" href="#como-funciona">¿Cómo Funciona?</a>
                    <a class="font-medium text-gray-400 hover:text-gray-200 sm:py-6" href="#faq">FAQ</a>
                    <a class="flex items-center gap-x-2 font-medium text-gray-400 hover:text-white" href="#">
                        <button type="button" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                            Crear Apuesta
                        </button>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- Hero -->
        <div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
            <div class="bg-slate-900">
              <div class="bg-gradient-to-b from-violet-600/[.15] via-transparent">
                <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8 pt-40">
                  <!-- Announcement Banner -->
                  <div class="flex justify-center">
                    <a class="group inline-block bg-white/[.05] hover:bg-white/[.1] border border-white/[.05] p-1 ps-4 rounded-full shadow-md" href="#">
                      <p class="me-2 inline-block text-white text-sm">
                        La app para el fútbol amateur.
                      </p>
                      <span class="group-hover:bg-white/[.1] py-2 px-3 inline-flex justify-center items-center gap-x-2 rounded-full bg-white/[.075] font-semibold text-white text-sm">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                      </span>
                    </a>
                  </div>
                  <!-- End Announcement Banner -->
            
                  <!-- Title -->
                  <div class="max-w-3xl text-center mx-auto">
                    <h1 class="block font-medium text-gray-200 text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
                        Apuestas Claras, Amistades Largas.
                    </h1>
                  </div>
                  <!-- End Title -->
            
                  <div class="max-w-3xl text-center mx-auto">
                    <p class="text-lg text-gray-400">Se acabaron las discusiones por las apuestas del partido. La app para gestionar las apuestas del potrero de forma fácil, rápida y transparente. Registra todo, paga al instante y cuida lo más importante: la amistad.</p>
                  </div>
            
                  <!-- Buttons -->
                  <div class="text-center">
                    <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-green-600 to-lime-400 hover:from-lime-400 hover:to-green-600 border border-transparent text-white text-sm font-medium rounded-md py-3 px-4" href="#">
                      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12h.01"/><path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><path d="M18 8.7A2 2 0 0 1 20 10.7V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10.7A2 2 0 0 1 6 8.7L12 3l6 5.7Z"/><path d="M8 16v-5a2 2 0 1 1 4 0v5"/><path d="M12 22v-2"/></svg>
                      CREAR MI PRIMERA APUESTA GRATIS
                    </a>
                  </div>
                  <!-- End Buttons -->
                </div>
              </div>
            </div>
        </div>
        <!-- End Hero -->

        <!-- Problem Section -->
        <div id="problema" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-white">El que apuesta de palabra, pierde la memoria (y a veces, la plata).</h2>
                <p class="mt-1 text-gray-400">¿Te suenan estas situaciones?</p>
            </div>
        
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 items-center gap-6 md:gap-10">
                <!-- Card -->
                <div class="size-full bg-gray-800 shadow-lg rounded-lg p-5">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-gray-700 bg-gray-800">
                            <svg class="flex-shrink-0 size-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-white">Deudas "Olvidadas"</h3>
                        </div>
                    </div>
                    <p class="text-gray-400">Cansado de tener que recordarles a tus amigos las apuestas que "no se acuerdan".</p>
                </div>
                <!-- End Card -->
        
                <!-- Card -->
                <div class="size-full bg-gray-800 shadow-lg rounded-lg p-5">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-gray-700 bg-gray-800">
                            <svg class="flex-shrink-0 size-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-white">Cuentas Confusas</h3>
                        </div>
                    </div>
                    <p class="text-gray-400">Dificultad para llevar un registro claro de quién pagó, quién debe y cuánto hay en el pozo.</p>
                </div>
                <!-- End Card -->
        
                <!-- Card -->
                <div class="size-full bg-gray-800 shadow-lg rounded-lg p-5">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-gray-700 bg-gray-800">
                            <svg class="flex-shrink-0 size-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 16.2a6.3 6.3 0 0 0-8.4 0l-1.6 1.6a6.3 6.3 0 0 0-8.4 0L2.8 16.2a6.3 6.3 0 0 1 0-8.4l1.6-1.6a6.3 6.3 0 0 1 8.4 0l1.6 1.6a6.3 6.3 0 0 1 0 8.4l-1.6 1.6a6.3 6.3 0 0 0 0 8.4z"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-white">Desconfianza</h3>
                        </div>
                    </div>
                    <p class="text-gray-400">Esas pequeñas discusiones por dinero que terminan generando un mal ambiente en el grupo.</p>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="size-full bg-gray-800 shadow-lg rounded-lg p-5">
                    <div class="flex items-center gap-x-4 mb-3">
                        <div class="inline-flex justify-center items-center size-[62px] rounded-full border-4 border-gray-700 bg-gray-800">
                            <svg class="flex-shrink-0 size-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-white">Injusticia</h3>
                        </div>
                    </div>
                    <p class="text-gray-400">Falta de un sistema transparente que asegure que todo se gestione de forma justa para todos.</p>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Problem Section -->
        
        <!-- How it Works Section -->
        <div id="como-funciona" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-white">Tan fácil como hacer un gol sin arquero.</h2>
            </div>
        
            <!-- Grid -->
            <div class="grid md:grid-cols-3 gap-10 lg:gap-16">
                <!-- Step -->
                <div class="flex flex-col items-center text-center">
                    <div class="flex justify-center items-center size-24 bg-gray-800 rounded-full mb-4 border-4 border-gray-700">
                        <span class="text-4xl font-bold text-green-500">1</span>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Crea la Apuesta</h3>
                    <p class="mt-1 text-gray-400">El organizador define el monto, el criterio para ganar y genera un código QR único.</p>
                </div>
                <!-- End Step -->
        
                <!-- Step -->
                <div class="flex flex-col items-center text-center">
                    <div class="flex justify-center items-center size-24 bg-gray-800 rounded-full mb-4 border-4 border-gray-700">
                        <span class="text-4xl font-bold text-green-500">2</span>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Escanean y se Unen</h3>
                    <p class="mt-1 text-gray-400">Cada participante escanea el QR. El monto se descuenta de su saldo precargado. ¡Adiós al efectivo!</p>
                </div>
                <!-- End Step -->
        
                <!-- Step -->
                <div class="flex flex-col items-center text-center">
                    <div class="flex justify-center items-center size-24 bg-gray-800 rounded-full mb-4 border-4 border-gray-700">
                        <span class="text-4xl font-bold text-green-500">3</span>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Se Carga el Resultado y ¡Listo!</h3>
                    <p class="mt-1 text-gray-400">El organizador ingresa el resultado y la app distribuye el pozo a los ganadores al instante.</p>
                </div>
                <!-- End Step -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End How it Works Section -->


        <!-- Features -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-white">Más que una app, es la tranquilidad para el equipo.</h2>
            </div>
            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card -->
                <div class="p-5 md:p-8 bg-gray-800 rounded-xl">
                    <h3 class="text-xl font-bold text-white mb-2">Transparencia Total</h3>
                    <p class="text-gray-400">Cada apuesta, participante y resultado queda registrado. Se acabaron los "yo no dije eso" o "te pagué la semana pasada".</p>
                </div>
                <!-- End Card -->
        
                <!-- Card -->
                <div class="p-5 md:p-8 bg-gray-800 rounded-xl">
                    <h3 class="text-xl font-bold text-white mb-2">Amistad Blindada</h3>
                    <p class="text-gray-400">Elimina el factor humano (la memoria, la falta de honestidad) y evita discusiones innecesarias por dinero.</p>
                </div>
                <!-- End Card -->
        
                <!-- Card -->
                <div class="p-5 md:p-8 bg-gray-800 rounded-xl">
                    <h3 class="text-xl font-bold text-white mb-2">Gestión Centralizada</h3>
                    <p class="text-gray-400">Ideal para el que organiza los partidos. Ten un panel de control para ver en tiempo real quién se sumó y el estado de las apuestas.</p>
                </div>
                <!-- End Card -->
                 <!-- Card -->
                <div class="p-5 md:p-8 bg-gray-800 rounded-xl lg:col-span-3">
                    <h3 class="text-xl font-bold text-white mb-2">Tu Historial Financiero</h3>
                    <p class="text-gray-400">Cada jugador puede ver su saldo, el historial de apuestas y cuánto ha ganado o perdido, llevando un control claro de su dinero.</p>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Features -->


        <!-- Testimonials -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card -->
            <div class="flex flex-col bg-gray-800 border border-gray-700 shadow-sm rounded-xl">
                <div class="flex-auto p-4 md:p-6">
                <p class="text-base italic md:text-xl text-gray-200">
                    "Antes, el tercer tiempo era para discutir por quién debía plata. Ahora es solo para la cerveza. Un golazo esta app."
                </p>
                </div>

                <div class="p-4 rounded-b-xl md:px-6">
                <h3 class="text-sm font-semibold text-gray-200">
                    El Colo
                </h3>
                <p class="text-sm text-gray-500">
                    Capitán de "Los Mismos de Siempre FC"
                </p>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="flex flex-col bg-gray-800 border border-gray-700 shadow-sm rounded-xl">
                <div class="flex-auto p-4 md:p-6">
                <p class="text-base italic md:text-xl text-gray-200">
                    "Soy el que siempre organiza y era una pesadilla cobrarle a todos. Con el QR y el sistema de saldo, es un trámite de 10 segundos. Me salvó la vida."
                </p>
                </div>

                <div class="p-4 rounded-b-xl md:px-6">
                <h3 class="text-sm font-semibold text-gray-200">
                    Lucho
                </h3>
                <p class="text-sm text-gray-500">
                    Organizador de los partidos del sábado
                </p>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="flex flex-col bg-gray-800 border border-gray-700 shadow-sm rounded-xl">
                <div class="flex-auto p-4 md:p-6">
                <p class="text-base italic md:text-xl text-gray-200">
                    "¡Increíble! Ahora hasta apostamos quién llega tarde. Todo queda registrado y es súper transparente. ¡Recomendadísimo!"
                </p>
                </div>

                <div class="p-4 rounded-b-xl md:px-6">
                <h3 class="text-sm font-semibold text-gray-200">
                    Mati
                </h3>
                <p class="text-sm text-gray-500">
                    Delantero estrella
                </p>
                </div>
            </div>
            <!-- End Card -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Testimonials -->
        
        <!-- FAQ -->
        <div id="faq" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Grid -->
            <div class="grid md:grid-cols-5 gap-10">
            <div class="md:col-span-2">
                <div class="max-w-xs">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-white">Preguntas Frecuentes</h2>
                <p class="mt-1 hidden md:block text-gray-400">Respuestas a las dudas más comunes sobre el Gestor de Apuestas del Potrero.</p>
                </div>
            </div>
            <!-- End Col -->
        
            <div class="md:col-span-3">
                <!-- Accordion -->
                <div class="hs-accordion-group divide-y divide-gray-700">
                <div class="hs-accordion pb-3 active" id="hs-basic-with-title-and-arrow-stretched-heading-one">
                    <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-200 rounded-lg" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                    ¿Cómo se carga saldo en la cuenta?
                    <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                    </button>
                    <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                    <p class="text-gray-400">
                        Es muy simple. Dentro de tu cuenta tienes una opción para "recargar saldo". Funciona como cargar crédito a una tarjeta SIM prepaga, y tu saldo se actualiza de forma inmediata.
                    </p>
                    </div>
                </div>
        
                <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-two">
                    <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-200 rounded-lg" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                    ¿Tiene algún costo utilizar la plataforma?
                    <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                    </button>
                    <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                    <p class="text-gray-400">
                        Registrarse y usar la app es gratis. Para mantener la plataforma, la app se queda con un pequeño porcentaje (10%) del pozo total de cada apuesta ganadora.
                    </p>
                    </div>
                </div>
        
                <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-three">
                    <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-200 rounded-lg" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                    ¿Qué pasa si nadie apuesta por una de las dos opciones?
                    <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                    </button>
                    <div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                    <p class="text-gray-400">
                        Si una apuesta no tiene participantes de ambos lados, se cancela automáticamente y se devuelve el dinero al saldo de los que habían participado.
                    </p>
                    </div>
                </div>
        
                <div class="hs-accordion pt-6 pb-3" id="hs-basic-with-title-and-arrow-stretched-heading-four">
                    <button class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-200 rounded-lg" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
                        ¿Quién es el "Creador de la Apuesta"?
                    <svg class="hs-accordion-active:hidden block flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    <svg class="hs-accordion-active:block hidden flex-shrink-0 size-5 text-gray-400 group-hover:text-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                    </button>
                    <div id="hs-basic-with-title-and-arrow-stretched-collapse-four" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
                    <p class="text-gray-400">
                        Es una persona del grupo que actúa como coordinador imparcial. Esta persona crea la apuesta, ingresa el resultado, pero no participa con su dinero en ese evento en particular.
                    </p>
                    </div>
                </div>
                </div>
                <!-- End Accordion -->
            </div>
            <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End FAQ -->


        <!-- CTA -->
        <div class="bg-gray-800">
            <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <div class="text-center">
                    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-white mb-2">¿Listos para jugar sin discusiones?</h2>
                    <p class="text-lg text-gray-400 mb-6">Deja las dudas y los problemas afuera de la cancha. Regístrate gratis, crea tu primer partido y descubre la forma más fácil y segura de gestionar las apuestas con tus amigos.</p>
                    <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-green-600 to-lime-400 hover:from-lime-400 hover:to-green-600 border border-transparent text-white text-sm font-medium rounded-md py-3 px-4" href="#">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12h.01"/><path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><path d="M18 8.7A2 2 0 0 1 20 10.7V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10.7A2 2 0 0 1 6 8.7L12 3l6 5.7Z"/><path d="M8 16v-5a2 2 0 1 1 4 0v5"/><path d="M12 22v-2"/></svg>
                        EMPEZAR A USARLA GRATIS
                    </a>
                </div>
            </div>
        </div>
        <!-- End CTA -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    <footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Grid -->
        <div class="text-center">
          <div>
            <a class="flex-none text-xl font-semibold text-white" href="#" aria-label="Brand">⚽ Gestor Potrero</a>
          </div>
          <!-- End Col -->
    
          <div class="mt-3">
            <p class="text-gray-500">Apuestas Claras, Amistades Largas.</p>
            <p class="text-gray-500">© 2024. Todos los derechos reservados.</p>
          </div>
        </div>
        <!-- End Grid -->
      </footer>
    <!-- ========== END FOOTER ========== -->


<?php ;}?>
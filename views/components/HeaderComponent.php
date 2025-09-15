<?php
function HeaderComponent(){
?>
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
<?php }?>
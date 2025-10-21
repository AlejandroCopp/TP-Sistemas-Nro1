<?php
// require_once __DIR__ . '/components/Table.php';
// require_once __DIR__ . '/components/HeaderComponent.php';
function Layout($content){

  // logica del componente


 ?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Partido. Tus Reglas. Cero Estrés. | La App para Futbol Amateur</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
      tailwind.config = {
        darkMode: 'class'
      }
    </script>
    
   

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>


    <script>
      if (localStorage.getItem('hs_theme') === 'dark' || (!('hs_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(90deg, #30C55A, #28a745);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        .hero-bg {
            background-image: linear-gradient(to top, rgba(13, 17, 23, 1) 0%, rgba(13, 17, 23, 0.7) 50%, rgba(13, 17, 23, 0.4) 100%), url('https://placehold.co/1920x1080/000000/FFFFFF?text=Jugadores+Celebrando+un+Gol');
            background-size: cover;
            background-position: center;
        }
        .cta-button {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(48, 197, 90, 0.2);
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(48, 197, 90, 0.3);
        }
        .card-bg {
            background-color: #161B22; /* Un color de tarjeta ligeramente más claro */
            border: 1px solid #30363D;
        }
    </style>
</head>

<body class="antialiased bg-gray-100 dark:bg-neutral-900 text-neutral-800 dark:text-neutral-200">

    <?php echo $content; ?>

    <script src="/public/lib/preline.min.js"></script>
    <script>
      // Initialize components on page load
      document.addEventListener('DOMContentLoaded', () => {
        HSStaticMethods.autoInit();
      });
    </script>
</body>
</html>


<?php ;}?>
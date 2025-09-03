<?php
echo "hola mundo";
// ----------------------------------------------------
// PASO 1: ANALIZAR LA RUTA
// ----------------------------------------------------

// Obtiene la ruta de la solicitud, ej: /posts/mi-primer-post
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = ltrim($request_uri, '/');
$segments = explode('/', $request_uri);

// Definimos la carpeta raíz de nuestras "páginas".
$base_pages_dir = 'pages/';

// ----------------------------------------------------
// PASO 2: MAPEO DE LA RUTA Y BÚSQUEDA DEL ARCHIVO
// ----------------------------------------------------

// Un array para mapear nuestras rutas dinámicas.
// La clave es la ruta base (sin la parte dinámica) y el valor es el nombre de la variable dinámica.
// Por ejemplo, 'posts' en la URL /posts/[slug] se mapea a la variable 'postSlug'.
$routes_map = [
    'posts' => 'postSlug',
    // Puedes añadir más rutas dinámicas aquí, ej:
    // 'users' => 'userId',
];

// Inicialmente, asumimos que no hay un archivo de página.
$page_file_path = null;

// Si no hay segmentos, estamos en la página de inicio.
if (empty($segments[0])) {
    $page_file_path = $base_pages_dir . 'index.php';
} else {
    // Si la URL tiene segmentos, intentamos construir la ruta al archivo.
    
    // Primero, verificamos si la primera parte de la URL es una ruta dinámica mapeada.
    $first_segment = $segments[0];
    if (array_key_exists($first_segment, $routes_map)) {
        
        // Si es una ruta dinámica, construimos la ruta al archivo.
        // Ejemplo: `pages/posts/[postSlug]/index.php`
        $page_file_path = $base_pages_dir . '[' . $routes_map[$first_segment] . ']' . '/index.php';
        
        // Asignamos el valor dinámico a una variable que la página incluida podrá usar.
        // El segundo segmento de la URL, ej: 'mi-primer-post', se asigna a la variable `$postSlug`.
        $dynamic_variable_name = $routes_map[$first_segment];
        $$dynamic_variable_name = $segments[1] ?? null; // Usa `$$` para una variable variable.
        
    } else {
        
        // Si no es una ruta dinámica, construimos la ruta a un archivo de página estática.
        // Ejemplo: `pages/about/index.php`
        $page_file_path = $base_pages_dir . $first_segment . '/index.php';
    }
}

// ----------------------------------------------------
// PASO 3: INCLUIR LA PÁGINA O MOSTRAR ERROR
// ----------------------------------------------------
// Verificamos si la ruta de archivo que construimos realmente existe en el disco.
if ($page_file_path && file_exists($page_file_path)) {
    // Si el archivo existe, lo incluimos. La ejecución del código pasará a ese archivo.
    include $page_file_path;
} else {
    // Si el archivo no se encuentra, mostramos un error 404.
    http_response_code(404);
    include $base_pages_dir . '404/index.php'; // Es buena práctica tener una página 404 dedicada.
}
?>

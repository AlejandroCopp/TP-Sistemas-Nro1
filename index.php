<?php
// Muestra todos los errores de PHP para facilitar la depuración.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Incluir el archivo del Router
// __DIR__ es una constante de PHP que devuelve la ruta del directorio donde se encuentra este archivo (index.php).
require_once __DIR__ . '/views/Layout.php';
require_once __DIR__ . '/lib/router.php';

// 2. Definir el "base path" de tu proyecto.
// Esto es necesario si tu proyecto no está en la raíz de tu dominio (ej. http://localhost/)
// En este caso, está en http://localhost/
$basePath = '';

// 3. Crear una instancia del Router, pasándole el base path.
$router = new Router($basePath);

// 4. Definir las rutas para el CRUD de Usuarios.
// Para este ejemplo, cada ruta utiliza una función anónima (closure) como manejador.
// En una aplicación real, aquí podrías usar un controlador, por ejemplo: 'UserController@index'.

// --- RUTAS DEL CRUD ---

// GET /  (landing page)
$router->get('/', function() {
    require_once __DIR__ . '/views/Home.php';
    Layout(Home());
});

// GET /login 
$router->get('/login', function() {
    require_once __DIR__ .'/views/Login.php';
    Layout(Login());
});

// GET /registrarse
$router->get('/registrarse', function() {
    require_once __DIR__ . '/views/Registrarse.php';
    Layout(Registrarse());
});

// GET /admin/usuarios  (Read - Leer todos los usuarios)
$router->get('/admin/usuarios', function() {
    require_once __DIR__ . '/views/GestionarUsuarios.php';
    Layout(GestionarUsuarios());
});

// GET /usuarios/[id]  (Read - Leer un usuario específico)
$router->get('/admin/usuarios/[id]', function($id) {
    // htmlspecialchars() se usa para prevenir ataques XSS al mostrar datos que vienen de la URL.
    echo "<h1>Mostrando perfil del usuario con ID: " . htmlspecialchars($id) . "</h1>";
    // Aquí iría tu lógica para buscar en la BD un usuario con el $id proporcionado.
});

// POST /usuarios  (Create - Crear un nuevo usuario)
// Esta ruta no se accede desde el navegador directamente, sino a través de un formulario HTML o una petición API.
$router->post('/api/admin/usuarios', function() {
    // La información del nuevo usuario normalmente vendría en la variable superglobal $_POST.
    // Ejemplo: $nombre = $_POST['nombre'];
    
    echo "<h1>Creando un nuevo usuario</h1>";
    // Aquí iría la lógica para validar los datos de $_POST y guardarlos en la base de datos.
    http_response_code(201); // 201 Created es un código de estado apropiado.
});

// PATCH /usuarios/[id]  (Update - Actualizar un usuario existente)
// También se accedería por formulario o API. PATCH se usa para actualizaciones parciales.
$router->patch('/admin/usuarios/[id]', function($id) {
    // Los nuevos datos vendrían en el cuerpo de la petición.
    echo "<h1>Actualizando usuario con ID: " . htmlspecialchars($id) . "</h1>";
    // Aquí iría la lógica para buscar el usuario por $id y actualizarlo con los datos recibidos.
});

// DELETE /usuarios/[id]  (Delete - Borrar un usuario)
// También se accedería por formulario o API.
$router->delete('/admin/usuarios/[id]', function($id) {
    echo "<h1>Borrando usuario con ID: " . htmlspecialchars($id) . "</h1>";
    // Aquí iría la lógica para buscar y eliminar el usuario con ese $id de la base de datos.
});


// 5. Ejecutar el router.
// Esta es la línea más importante. Procesa la URL solicitada por el navegador
// y llama al manejador (la función anónima en este caso) que corresponda a la ruta.
$router->dispatch();

?>
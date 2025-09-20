<?php
// Muestra todos los errores de PHP para facilitar la depuración.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Incluir el archivo del Router
// __DIR__ es una constante de PHP que devuelve la ruta del directorio donde se encuentra este archivo (index.php).
require_once __DIR__ . '/views/Layout.php';
require_once __DIR__ . '/lib/Router.php';

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

 // GET /Pagina de Ale
 $router->get('/Ale', function() {
    require_once __DIR__ . '/views/Ale.php';
    Layout(Ale());
});

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
$router->get('/register', function() {
    require_once __DIR__ . '/views/register.php';
    Layout(register());
});

// GET /admin/usuarios  (Read - Leer todos los usuarios)
$router->get('/admin/usuarios', function() {
    require_once __DIR__ . '/views/GestionarUsuarios.php';
    Layout(GestionarUsuarios());
});


$router->post('/api/auth/login', 'AuthController@login');
$router->post('/api/auth/register', 'AuthController@register');

$router->get('/api/admin/users', 'AdminController@getAllUsers');
$router->post('/api/admin/changeUserName', 'AdminController@changeUserName');
$router->post('/api/admin/changeUserEmail', 'AdminController@changeUserEmail');
$router->post('/api/admin/changeUserRole', 'AdminController@changeUserRole');
$router->post('/api/admin/resetUserPassword', 'AdminController@resetUserPassword');


// 5. Ejecutar el router.
// Esta es la línea más importante. Procesa la URL solicitada por el navegador
// y llama al manejador (la función anónima en este caso) que corresponda a la ruta.
$router->dispatch();

?>
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

// Auth System
$router->get('/login', 'AuthController@LoginPage' );
$router->get('/register', 'AuthController@RegisterPage');
$router->post('/api/auth/login', 'AuthController@login');
$router->post('/api/auth/register', 'AuthController@register');
$router->post('/api/auth/logout', 'AuthController@logout');

// Admin System
$router->get('/admin/usuarios', 'AdminController@AdminPage');
$router->get('/api/admin/users', 'AdminController@getAllUsers');
$router->post('/api/admin/changeUserName', 'AdminController@changeUserName');
$router->post('/api/admin/changeUserEmail', 'AdminController@changeUserEmail');
$router->post('/api/admin/changeUserRole', 'AdminController@changeUserRole');
$router->post('/api/admin/resetUserPassword', 'AdminController@resetUserPassword');

// Application
$router->get('/', 'AppController@MainPage');


// 5. Ejecutar el router.
// Esta es la línea más importante. Procesa la URL solicitada por el navegador
// y llama al manejador (la función anónima en este caso) que corresponda a la ruta.
$router->dispatch();

?>
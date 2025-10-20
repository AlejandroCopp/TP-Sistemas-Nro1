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

// Auth System
# TODO: agregar validador de datos en el tercer parámetro
$router->get('/login', 'AuthController@LoginPage');
$router->get('/register', 'AuthController@RegisterPage');
$router->get('/logout', 'AuthController@logout');
$router->post('/api/auth/login', 'AuthController@login');
$router->post('/api/auth/register', 'AuthController@register');

//matches
$router->get('/api/matches', 'MatchesController@getMatches', 'jugador');
$router->post('/api/match', 'MatchesController@createMatch', 'jugador');

$router->post('/api/match/players', 'MatchesController@getPlayers', 'jugador');
$router->post('/api/match/players/mgmt', 'MatchesController@getManagerPlayers', 'jugador');

$router->post('/api/match/request', 'MatchesController@userMatchRequest', 'jugador');
$router->post('/api/match/request/accept', 'MatchesController@userMatchRequest', 'jugador');
$router->post('/api/match/request/decline', 'MatchesController@userMatchRequest', 'jugador');

// Admin System
$router->get('/admin/usuarios', 'AdminController@AdminPage', 'admin');
$router->get('/api/admin/users', 'AdminController@getAllUsers', 'admin');
$router->put('/api/admin/user/[id]', 'AdminController@updateUser', 'admin');
$router->delete('/api/admin/user/[id]', 'AdminController@deleteUser', 'admin');
$router->delete('/api/admin/users', 'AdminController@deleteUsers', 'admin');

// Application
$router->get('/', 'AppController@MainPage');
$router->get('/match/[match_id]', 'AppController@MatchPage');
// // GET /registrarse
// $router->get('/register', function() {
//     require_once __DIR__ . '/views/register.php';
//     Layout(register());
// });

// // GET /admin/usuarios  (Read - Leer todos los usuarios)
// $router->get('/admin/usuarios', function() {
//     require_once __DIR__ . '/views/GestionarUsuarios.php';
//     Layout(GestionarUsuarios());
// });

session_start();
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'guest';
} 

// session_set_cookie_params([
//     'httponly' => true,
//     //'secure' => true,
//     'samesite' => 'Lax' // 'Strict',
// ]);

// 5. Ejecutar el router.
// Esta es la línea más importante. Procesa la URL solicitada por el navegador
// y llama al manejador (la función anónima en este caso) que corresponda a la ruta.
$router->dispatch();

?>
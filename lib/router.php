<?php

/**
 *
 * Clase Router
 *
 * Se encarga de manejar las peticiones web que llegan a la aplicación.
 * Funciona como un GPS para las URLs: toma la dirección que el usuario solicita
 * y la dirige al controlador o función PHP correspondiente.
 * Permite crear "rutas dinámicas", que son como direcciones con comodines
 * (por ejemplo, /usuarios/[id] donde [id] puede ser cualquier número).
 */
class Router {
    /**
     * @var array Almacena todas las rutas que la aplicación conoce.
     * Es como una libreta de direcciones donde se anota cada URL y qué hacer con ella.
     */
    private $routes = [];

    /**
     * @var string Es una parte inicial de la URL que se puede ignorar.
     * Útil si el proyecto no está en la raíz del dominio (ej: http://localhost/mi-proyecto/).
     */
    private $basePath = '';

    /**
     * Constructor de la clase Router.
     *
     * @param string $basePath La parte de la URL base que se debe ignorar al buscar rutas.
     */
    public function __construct($basePath = '') {
        $this->basePath = $basePath;
    }

    /**
     * Registra una nueva ruta para peticiones de tipo GET.
     * GET se usa generalmente para solicitar datos (ej: ver una página o un perfil de usuario).
     *
     * @param string $path La dirección URL que se quiere registrar. Puede contener partes dinámicas como /usuarios/[id].
     * @param mixed $handler La acción a realizar. Puede ser una función directa o un texto como 'NombreControlador@nombreMetodo'.
     */
    public function get(...$args) {
        $this->addRoute('GET', $args);
    }

    /**
     * Registra una nueva ruta para peticiones de tipo POST.
     * POST se usa para enviar datos nuevos para ser creados (ej: registrar un nuevo usuario).
     *
     * @param string $path La dirección URL.
     * @param mixed $handler La acción a realizar.
     */
    public function post(...$args) {
        $this->addRoute('POST', $args);
    }

    /**
     * Registra una nueva ruta para peticiones de tipo PUT.
     * PUT se usa para actualizar parcialmente datos que ya existen (ej: cambiar solo el email de un usuario).
     *
     * @param string $path La dirección URL.
     * @param mixed $handler La acción a realizar.
     */
    public function PUT(...$args) {
        $this->addRoute('PUT', $args);
    }

    /**
     * Registra una nueva ruta para peticiones de tipo DELETE.
     * DELETE se usa para eliminar datos existentes (ej: borrar una publicación).
     *
     * @param string $path La dirección URL.
     * @param mixed $handler La acción a realizar.
     */
    public function delete(...$args) {
        $this->addRoute('DELETE', $args);
    }

    public function checkRole($role) {
        session_start();

        $userRole = $_SESSION["role"];
        
        if (is_array($role)) {
            foreach ($role as $item) {
                if ($item === $userRole) {
                    return true;
                }
            }
            return false;
        } else {
            return $role === $userRole;
        }
    }

    /**
     * Método interno para añadir una ruta a la "libreta de direcciones".
     * Convierte las rutas dinámicas (ej: /usuarios/[id]) en un formato técnico (expresión regular)
     * que PHP puede entender para hacer coincidencias.
     *
     * @param string $method El tipo de petición (GET, POST, etc.).
     * @param string $path La dirección URL.
     * @param mixed $handler La acción a realizar.
     */
    private function addRoute($method, $path, $handler, $role) {
        // Este método convierte de forma segura una ruta con partes dinámicas y estáticas en una expresión regular.
        // Por ejemplo, la ruta '/user/(test)/[id]' se convertirá en una regex que busca literalmente '/user/(test)/'
        // y luego captura cualquier caracter hasta la siguiente barra para el [id].

        // 1. Dividimos la ruta en partes estáticas y dinámicas.
        // Usamos preg_split con PREG_SPLIT_DELIM_CAPTURE para conservar tanto las partes que coinciden (delimitadores) como las que no.
        // El patrón '/(\[\w+\])/' busca cualquier cosa como '[id]', '[nombre]', etc.

        if($role && !checkRole($role)){
            header('Location: /no-autorizado.php'); // o renderizar una vista - TODO: custom messages errors
            exit;
        }
        
        $regexParts = preg_split('/(\[\w+\])/', $path, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        
        $regex = '';
        foreach ($regexParts as $part) {
            // 2. Verificamos si la parte es dinámica o estática.
            if (strpos($part, '[') === 0 && strpos($part, ']') === strlen($part) - 1) {
                // 2a. Si es una parte dinámica (empieza con '[' y termina con ']'), la reemplazamos con una captura de regex.
                // '([^/]+)' significa: captura un grupo de uno o más caracteres que no sean una barra '/'.
                $regex .= '([^/]+)';
            } else {
                // 2b. Si es una parte estática, la escapamos para que los caracteres especiales de regex (como '(', ')', '.', etc.)
                // se traten como texto literal. Usamos '#' como delimitador para la regex final.
                $regex .= preg_quote($part, '#');
            }
        }

        // 3. Almacenamos la ruta final, completamente ensamblada y segura.
        $this->routes[] = [
            'method' => $method,
            // Se construye la expresión regular final que se usará para comparar con la URL del navegador.
            // - #: Delimitador de la expresión regular.
            // - ^: "Ancla" de inicio. Asegura que la coincidencia debe empezar al principio de la URL.
            // - $: "Ancla" de fin. Asegura que la coincidencia debe terminar al final de la URL.
            'path' => '#^' . $this->basePath . $regex . '$#',
            'handler' => $handler
        ];
    }

    /**
     * Es el motor del router. Se ejecuta para atender la petición actual del usuario.
     * Revisa la URL y el tipo de petición (GET, POST, etc.) y busca en su "libreta de direcciones"
     * una ruta que coincida. Si la encuentra, ejecuta la acción correspondiente.
     */
    public function dispatch() {
        // $_SERVER es una variable "superglobal" de PHP que contiene información sobre la petición, el servidor, etc.
        // $_SERVER['REQUEST_METHOD'] nos da el tipo de petición: 'GET', 'POST', etc.
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // $_SERVER['REQUEST_URI'] contiene la URL completa solicitada por el usuario, incluyendo parámetros.
        // Ejemplo: Si la URL es "http://localhost/usuarios/123?page=2", REQUEST_URI será "/usuarios/123?page=2".
        //
        // parse_url() es una función de PHP que descompone una URL en sus partes (protocolo, dominio, path, query string, etc.).
        //
        // PHP_URL_PATH es una constante que le dice a parse_url() que solo nos interesa la parte de la ruta de la URL.
        // Para "/usuarios/123?page=2", nos devolvería "/usuarios/123".
        // Esto es crucial para que los parámetros de la query string (como ?page=2) no interfieran con el emparejamiento de rutas.
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Normalizar la URI: eliminar la barra final si existe (y no es la ruta raíz).
        // Esto hace que /usuarios y /usuarios/ se traten como la misma ruta.
        if (strlen($requestUri) > 1) {
            $requestUri = rtrim($requestUri, '/');
        }
        
        foreach ($this->routes as $route) {
            // preg_match() intenta hacer coincidir la URL del navegador ($requestUri) con el patrón de la ruta que guardamos.
            // Si coinciden, $matches se llenará con los resultados.
            // $matches[0] siempre es la coincidencia completa (la URL entera).
            // $matches[1], $matches[2], etc., son los valores capturados por los grupos (...) en nuestra regex.
            // Por ejemplo, para la ruta '/usuarios/([^/]+)' y la URL '/usuarios/123', $matches será ['/usuarios/123', '123'].
            $matches = [];
            if ($route['method'] === $requestMethod && preg_match($route['path'], $requestUri, $matches)) {
                // Quita el primer elemento de $matches (la coincidencia completa),
                // para quedarnos solo con los parámetros dinámicos ('123').
                array_shift($matches);
         
                $handler = $route['handler'];

                // Si el manejador es una función, la llama directamente.
                if (is_callable($handler)) {
                    call_user_func_array($handler, $matches);
                    return; // Termina la ejecución para no seguir buscando.
                }

                // Si el manejador es un texto como 'Controlador@metodo'.
                if (is_string($handler) && strpos($handler, '@') !== false) {
                    list($controller, $method) = explode('@', $handler);

                    // Arma la ruta al archivo del controlador.
                    $controllerFile = __DIR__ . '/../controllers/' . $controller . '.php';

                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;
                        if (class_exists($controller)) {
                            $controllerInstance = new $controller();
                            if (method_exists($controllerInstance, $method)) {
                                // Llama al método del controlador y le pasa los valores de la URL dinámica.
                                call_user_func_array([$controllerInstance, $method], $matches);
                                return; // Termina la ejecución.
                            }
                        }
                    }
                }
            }
        }

        // Si después de revisar todas las rutas no se encontró ninguna coincidencia.
        http_response_code(404); // Envía el código de error 404: No Encontrado.
        
        // Incluye la vista personalizada para el error 404.
        // __DIR__ es una "constante mágica" de PHP que contiene la ruta al directorio del archivo actual (en este caso, 'lib').
        // Por lo tanto, __DIR__ . '/../404.php' construye la ruta correcta al archivo 404.php en la raíz del proyecto.
        $notFoundView = __DIR__ . '/../404.php';
        if (file_exists($notFoundView)) {
            require_once $notFoundView;
        } else {
            echo '404 Página No Encontrada'; // Fallback por si el archivo 404.php no existe.
        }
    }
}

<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';
require_once 'lib/Logger.php';

/**
 * Define la estructura de un Rol.
 * Pensado para ser escalable y poder ser almacenado en una base de datos a futuro.
 */
class Role {
    public string $name;
    /** @var Role[] */
    public array $children;

    public function __construct(string $name, array $children = []) {
        $this->name = $name;
        $this->children = $children;
    }
}

class AuthController {
    private $userModel;
    private $logger;

    /**
     * Almacena los roles definidos en el sistema.
     * @var Role[]
     */
    private static $roles;

    /**
     * Inicializa los roles del sistema de forma harcodeada.
     * A futuro, esto podría leer los roles desde una base de datos.
     */
    private static function initializeRoles() {
        if (isset(self::$roles)) {
            return;
        }

        // Definición de roles
        $jugador = new Role('jugador');
        $admin = new Role('admin', [$jugador]); // El admin hereda los permisos de jugador

        self::$roles = [
            'admin' => $admin,
            'jugador' => $jugador,
        ];
    }

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
        $this->logger = Logger::getInstance();
        self::initializeRoles();
    }

    /**
     * Verifica si un rol de usuario cumple con un rol requerido, considerando la jerarquía.
     * Es una función auxiliar recursiva.
     *
     * @param Role $userRole El objeto Rol del usuario.
     * @param string $requiredRoleName El nombre del rol que se requiere.
     * @return bool
     */
    private static function hasPermission(Role $userRole, string $requiredRoleName): bool {
        // Si el nombre del rol del usuario es el requerido, tiene permiso.
        if ($userRole->name === $requiredRoleName) {
            return true;
        }

        // Se revisa recursivamente en los roles que hereda (hijos).
        foreach ($userRole->children as $childRole) {
            if (self::hasPermission($childRole, $requiredRoleName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Punto de entrada para la verificación de roles desde el Router.
     * Implementa un sistema RBAC simple (Role-Based Access Control).
     *
     * @param string|string[] $requiredRole El rol o roles requeridos por la ruta.
     * @return bool
     */
    public static function checkRole($requiredRole): bool {
        self::initializeRoles(); // Asegura que los roles estén cargados.
        
        $userRoleName = $_SESSION['role'] ?? null;

        // Si el usuario no tiene un rol o el rol no es válido, no tiene acceso.
        if (!$userRoleName || !isset(self::$roles[$userRoleName])) {
            return false;
        }

        $userRole = self::$roles[$userRoleName];
        
        // Se convierte el rol requerido a un array para manejar tanto strings como arrays.
        $requiredRoles = is_array($requiredRole) ? $requiredRole : [$requiredRole];

        // Se comprueba si el usuario tiene al menos uno de los roles requeridos.
        foreach ($requiredRoles as $reqRole) {
            if (self::hasPermission($userRole, $reqRole)) {
                return true; // Conceder acceso si cumple con al menos un rol.
            }
        }

        return false; // Denegar acceso si no cumple con ninguno.
    }

    public function LoginPage(){
        // This method renders a page, so it doesn't return JSON.
        // Session logic is still needed for page access control.
        if(isset($_SESSION["user_id"])){
            header("location:/");
        }else{
            require_once 'views/Login.php';
            Layout(Login());
        }
    }

    public function RegisterPage(){
        // This method renders a page, so it doesn't return JSON.
        if(isset($_SESSION["user_id"])){
            header("location:/");
        }else{
            require_once 'views/register.php';
            Layout(register());
        }
    }

    public function register() {
        header('Content-Type: application/json');
        $this->logger->info('Request: POST /api/auth/register', ['body' => $_POST]);

        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $role = 'jugador';

        if (empty($name) || empty($email) || empty($password)) {
            http_response_code(400);
            $response = ["message" => "Name, email, and password are required."];
            $this->logger->error('Response: 400 Bad Request', ['body' => $response]);
            echo json_encode($response);
            return;
        }

        if ($this->userModel->getUserByEmail($email)) {
            http_response_code(409);
            $response = ["message" => "El usuario con este correo electrónico ya existe."];
            $this->logger->error('Response: 409 Conflict', ['body' => $response]);
            echo json_encode($response);
            return;
        }
        
        if ($this->userModel->createUser($name, $email, $password, $role)) {
            $_SESSION["id"] = $this->userModel->getUserByEmail($email);
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role; 
            
            http_response_code(201);
            $response = ["message" => "Usuario registrado con éxito."];
            $this->logger->info('Response: 201 Created', ['body' => $response]);
            echo json_encode($response);
        } else {
            http_response_code(500);
            $response = ["message" => "Error al registrar el usuario."];
            $this->logger->error('Response: 500 Internal Server Error', ['body' => $response]);
            echo json_encode($response);
        }
    }
    
    public function login() {
        header('Content-Type: application/json');
        $this->logger->info('Request: POST /api/auth/login', ['body' => $_POST]);
        
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        
        $user = $this->userModel->getUserByEmail($email, "id, name, email, role, password_hash");
        
        if ($user && password_verify($password, $user['password_hash'])) {
            // Note: In a stateless API, you would generate and return a token (e.g., JWT) here.
            // For now, we return user data and a success message.
            // var_dump($user);
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            // $this->logger->info('Response: 200 OK', ['body' => $response]);
            
            header("Location:/");
        } else {
            http_response_code(401);
            $response = ["message" => "Credenciales invalidas."];
            $this->logger->error('Response: 401 Unauthorized', ['body' => $response, 'email' => $email]);
            echo json_encode($response);
        }
    }

    public function logout(){
        header('Content-Type: application/json');
        $this->logger->info('Request: POST /api/auth/logout');
        

        session_unset();
        session_destroy();
        // In a stateless API, the client is responsible for destroying the token.
        // The server just confirms the logout action.
        header("location: /");
        http_response_code(302);
        // $response = ["message" => "Logout successful."];
        // $this->logger->info('Response: 200 OK', ['body' => $response]);
        // echo json_encode($response);
    }
}


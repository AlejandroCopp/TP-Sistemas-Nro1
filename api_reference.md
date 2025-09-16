

# Api Reference

### **Autenticación y Perfil de Usuario**

-----

Esta sección cubre los endpoints para la autenticación de usuarios y la gestión de perfiles.

#### `POST /api/auth/login`

  - **Descripción**: Permite que un usuario registrado inicie sesión y obtenga un token de autenticación.
  - **Cuerpo de la Solicitud**:
    ```json
    {
      "email": "string",
      "password": "string"
    }
    ```
  - **Respuesta**:
      - `200 OK`: Inicio de sesión exitoso.
        ```json
        {
          "token": "string",
          "user_id": "integer"
        }
        ```
      - `401 Unauthorized`: Credenciales inválidas.

#### `POST /api/auth/register`

  - **Descripción**: Crea una nueva cuenta de usuario.
  - **Cuerpo de la Solicitud**:
    ```json
    {
      "name": "string",
      "email": "string",
      "password": "string",
      "position": "string"
    }
    ```
  - **Respuesta**:
      - `201 Created`: Usuario registrado con éxito.
        ```json
        {
          "user_id": "integer",
          "message": "User registered successfully."
        }
        ```
      - `409 Conflict`: Ya existe un usuario con ese correo electrónico.

#### `GET /api/users/{user_id}`

  - **Descripción**: Recupera la información básica del perfil de un usuario.
  - **Parámetros**:
      - `user_id`: El ID del usuario cuyo perfil se solicita.
  - **Encabezados**:
      - `Authorization: Bearer <token>`
  - **Respuesta**:
      - `200 OK`: Datos del perfil de usuario.
        ```json
        {
          "user_id": "integer",
          "name": "string",
          "photo_url": "string",
          "position": "string",
          "created_matches": ["integer", "integer"],
          "postulations": ["integer", "integer"]
        }
        ```
      - `404 Not Found`: Usuario no encontrado.

-----

### **Administración de Usuarios**

-----

Estos endpoints son para tareas administrativas, como la gestión de usuarios y su acceso.

#### `GET /api/admin/users`

  - **Descripción**: Recupera una lista de todos los usuarios. Este endpoint es solo para administradores.
  - **Encabezados**:
      - `Authorization: Bearer <token>` (Token de administrador)
  - **Respuesta**:
      - `200 OK`: Una lista de objetos de usuario.
        ```json
        [
          { "id": "integer", "name": "string", "email": "string", "status": "active" },
          { "id": "integer", "name": "string", "email": "string", "status": "suspended" }
        ]
        ```
      - `403 Forbidden`: El usuario no es un administrador.

#### `POST /api/admin/users`

  - **Descripción**: Crea un nuevo usuario desde el panel de administrador.
  - **Encabezados**:
      - `Authorization: Bearer <token>` (Token de administrador)
  - **Cuerpo de la Solicitud**:
    ```json
    {
      "name": "string",
      "email": "string",
      "password": "string"
    }
    ```
  - **Respuesta**:
      - `201 Created`: Usuario creado con éxito.

#### `PUT /api/admin/users/{user_id}`

  - **Descripción**: Modifica los datos de un usuario existente.
  - **Parámetros**:
      - `user_id`: El ID del usuario a modificar.
  - **Encabezados**:
      - `Authorization: Bearer <token>` (Token de administrador)
  - **Cuerpo de la Solicitud**:
    ```json
    {
      "name": "string",
      "email": "string",
      "status": "string"
    }
    ```
  - **Respuesta**:
      - `200 OK`: Usuario actualizado con éxito.

#### `DELETE /api/admin/users/{user_id}`

  - **Descripción**: Elimina una cuenta de usuario.
  - **Parámetros**:
      - `user_id`: El ID del usuario a eliminar.
  - **Encabezados**:
      - `Authorization: Bearer <token>` (Token de administrador)
  - **Respuesta**:
      - `204 No Content`: Usuario eliminado con éxito.


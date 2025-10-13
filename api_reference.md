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
    "password": "string"
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

#### `PUT /api/admin/user/{id}`

- **Descripción**: Modifica los datos de un usuario existente.
- **Parámetros**:
  - `id`: El ID del usuario a modificar.
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

#### `DELETE /api/admin/user/{id}`

- **Descripción**: Elimina una cuenta de usuario.
- **Parámetros**:
  - `id`: El ID del usuario a eliminar.
- **Encabezados**:
  - `Authorization: Bearer <token>` (Token de administrador)
- **Respuesta**:
  - `204 No Content`: Usuario eliminado con éxito.

#### `DELETE /api/admin/users`

- **Descripción**: Elimina varias cuentas de usuario.
- **Encabezados**:
  - `Authorization: Bearer <token>` (Token de administrador)
- **Cuerpo de la Solicitud**:
  
  ```json
  {
    "ids": ["integer", "integer"]
  }
  ```
- **Respuesta**:
  - `204 No Content`: Usuarios eliminados con éxito.







# API Reference: Sistema de Gestión de Partidos (v3)

## Resumen General

Esta API RESTful está diseñada para gestionar la creación, descubrimiento y participación en partidos deportivos. La arquitectura está optimizada para que las respuestas de listas sean ligeras y las vistas de detalle sean completas.

**URL Base:** `/api`

## Autenticación

Todos los endpoints protegidos requieren un `Bearer Token` (JWT) en el header de autorización.

`Authorization: Bearer <your_jwt_token>`

Los endpoints bajo la ruta `/admin` requieren un rol de administrador.

## Endpoints de Partidos

### 1. Obtener un Partido Aleatorio

Redirige al usuario al partido más cercano geográficamente, próximo a empezar y con cupos disponibles.

- **Endpoint:** `GET /random_match`

- **Autenticación:** Opcional

- **Respuestas:**
  
  - `302 Found`: Redirección al endpoint `/matches/{id}`. El header `Location` contendrá la URL del partido.
  
  - `404 Not Found`: Si no hay partidos que cumplan los criterios.

### 2. Listar Partidos Disponibles

Devuelve una lista **ligera** de todos los partidos disponibles, ideal para mostrar en un mapa o una lista principal. No incluye la lista detallada de jugadores para optimizar la velocidad de respuesta.

- **Endpoint:** `GET /matches`

- **Autenticación:** Opcional

- **Parámetros de Query:**
  
  - `lat` (number, **requerido**): Latitud actual del usuario.
  
  - `lon` (number, **requerido**): Longitud actual del usuario.

- **Respuesta Exitosa (`200 OK`):**
  
  ```
  [    
    {        
      "id_partido": "uuid_partido_1",
      "fecha_partido": "2025-11-15",        
      "hora_partido": "18:00:00",        
      "lugar_partido": "Cancha 5, Parque Norte, CABA",        
      "cupos_disponibles_partido": 2,        
      "distancia_km": 1.5    
    },    
    {        
      "id_partido": "uuid_partido_2",        
      "fecha_partido": "2025-11-16",        "hora_partido": "20:00:00",        "lugar_partido": "Estadio Monumental, CABA",        "cupos_disponibles_partido": 5,        "distancia_km": 3.2    }]
  ```

- **Respuesta de Error (`400 Bad Request`):**
  
  ```
  {    "error": "Missing required query parameters: lat, lon"}
  ```

### 3. Obtener Detalles de un Partido

Recupera los detalles completos de un partido específico, incluyendo la lista de todos los jugadores confirmados y el equipo al que pertenecen.

- **Endpoint:** `GET /matches/{id}`

- **Autenticación:** Opcional

- **Parámetros de Path:**
  
  - `id` (string, **requerido**): El `ID_partido` del partido.

- **Respuesta Exitosa (`200 OK`):**
  
  ```
  {    "id_partido": "uuid_partido_1",    "id_usuario_org": "uuid_organizador_1",    "fecha_partido": "2025-11-15",    "hora_partido": "18:00:00",    "lugar_partido": "Cancha 5, Parque Norte, CABA",    "cupos_disponibles_partido": 2,    "estado_partido": "abierto",    "jugadores": [        {            "id_usuario": "uuid_jugador_1",            "nombre_usuario": "carlostevez",            "equipo": "A"        },        {            "id_usuario": "uuid_jugador_2",            "nombre_usuario": "romanriquelme",            "equipo": "A"        },        {            "id_usuario": "uuid_jugador_3",            "nombre_usuario": "martinpalermo",            "equipo": "B"        }    ]}
  ```

- **Respuesta de Error (`404 Not Found`):**
  
  ```
  {    "error": "Match not found"}
  ```

## Endpoints de Jugador (Requiere Autenticación)

### 4. Lista de Espera (Solicitudes de Juego)

#### 4.1. Ver Solicitudes Pendientes

Obtiene las solicitudes de juego pendientes para los partidos que el usuario autenticado organiza.

- **Endpoint:** `GET /wait_list`

#### 4.2. Aceptar una Solicitud

Acepta la solicitud de un jugador para unirse a un partido. El usuario autenticado debe ser el organizador.

- **Endpoint:** `POST /wait_list/accept`

- **Body (JSON):**
  
  ```
  {    "id_match": "uuid_partido_1",    "id_user": "uuid_usuario_solicitante"}
  ```

- **Respuestas:** `200 OK`, `403 Forbidden`, `404 Not Found`, `409 Conflict`.

#### 4.3. Rechazar una Solicitud

Rechaza la solicitud de un jugador. El usuario autenticado debe ser el organizador.

- **Endpoint:** `POST /wait_list/deny`

- **Body (JSON):**
  
  ```
  {    "id_match": "uuid_partido_1",    "id_user": "uuid_usuario_solicitante"}
  ```

- **Respuestas:** `200 OK`, `403 Forbidden`, `404 Not Found`.

### 5. Notificaciones

Obtiene las notificaciones para el usuario autenticado. Se recomienda implementar con WebSockets o SSE para actualizaciones en tiempo real.

- **Endpoint:** `GET /notifications`

### 6. Historial de Partidos

Devuelve el historial de partidos jugados por el usuario autenticado.

- **Endpoint:** `GET /history`

## Endpoints de Administración (Requiere Rol de Admin)

### 7. Gestión de Usuarios

#### 7.1. Crear Usuario

- **Endpoint:** `POST /admin/users`

- **Body (JSON):**
  
  ```
  {    "id_rol": "uuid_rol_a_asignar",    "nombre_usuario": "nuevousuario",    "email_usuario": "nuevo@example.com",    "contraseña_usuario": "supersecretpassword"}
  ```

- **Respuestas:** `201 Created`, `409 Conflict`.

#### 7.2. Actualizar Usuario

- **Endpoint:** `PUT /admin/users/{id}`

- **Body (JSON):** Campos a actualizar.
  
  ```
  {    "email_usuario": "updated.email@example.com"}
  ```

- **Respuestas:** `200 OK`, `404 Not Found`.

#### 7.3. Eliminar Usuario

- **Endpoint:** `DELETE /admin/users/{id}`

- **Respuestas:** `204 No Content`, `404 Not Found`.
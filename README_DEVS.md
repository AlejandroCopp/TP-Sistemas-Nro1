# Guía de Onboarding y Desarrollo

Este documento describe el proceso completo para que un nuevo desarrollador se incorpore al proyecto, configure su entorno y contribuya al código.

## 1. Proceso de Onboarding y Puesta en Marcha

### Paso 1: Prerrequisitos de Software

Necesitarás Git y un entorno Docker funcional. La forma más sencilla de empezar es instalando [Docker Desktop](https://www.docker.com/products/docker-desktop/) para Windows o macOS. Para Linux, puedes seguir la [guía oficial](https://docs.docker.com/engine/install/).

### Paso 2: Solicitar Acceso al Repositorio

**Acción requerida:** Contacta al líder del proyecto y envíale tu **nombre de usuario de GitHub** para que te añada como colaborador.

### Paso 3: Clonar el Repositorio

Una vez que tengas acceso, abre tu terminal y clona el proyecto.

```bash
git clone <URL-del-repositorio>
cd <nombre-del-repositorio>
```

### Paso 4: Iniciar el Entorno de Desarrollo

Con Docker funcionando y ubicado en la raíz del proyecto, ejecuta el siguiente comando para construir y levantar los contenedores.

```bash
docker-compose up
```

### Paso 5: Acceder a la Aplicación

Abre tu navegador web y visita: [**http://localhost:8080**](http://localhost:8080)

## 2. Comandos Útiles de Docker Compose

- **Iniciar en segundo plano:** `docker-compose up -d`
- **Detener el entorno:** `docker-compose down`
- **Ver logs en tiempo real:** `docker-compose logs -f web`
- **Forzar reconstrucción:** `docker-compose up --build`

## 3. Flujo de Trabajo con Git

Se recomienda usar la interfaz gráfica de Visual Studio Code para una gestión más intuitiva, pero los comandos de Git siempre están disponibles.

### Paso 1: Sincronizar (Pull)

Antes de empezar a trabajar, trae siempre los últimos cambios del repositorio para evitar conflictos.

```bash
git pull
```

### Paso 2: Realizar y Preparar Cambios (Add/Stage)

Modifica tu código y luego añade los archivos que quieres incluir en tu próximo commit.

```bash
# Para añadir un archivo específico
git add ruta/al/archivo.php

# Para añadir todos los cambios
git add .
```

### Paso 3: Confirmar Cambios (Commit)

Confirma tus cambios con un mensaje descriptivo que explique el *qué* y el *porqué*.

```bash
git commit -m "Agrega la validación del formulario de contacto"
```

### Paso 4: Subir Cambios (Push)

Sube tus commits al repositorio remoto para que otros los vean.

```bash
git push
```

## 4. Arquitectura y Desarrollo

### Cómo Crear una Nueva Página

Sigue estos pasos para añadir una nueva página a la aplicación:

1.  **Crear el Archivo de la Vista:**
    Crea un nuevo archivo PHP en el directorio `views/`. El nombre del archivo debe ser descriptivo y en formato `PascalCase`.
    *Ejemplo:* `views/MiPagina.php`

2.  **Definir la Función de la Vista:**
    Dentro del nuevo archivo, crea una función PHP que coincida con el nombre del archivo. Esta función contendrá todo el HTML de tu página.

    ```php
    <?php
    function MiPagina() {
        # la logica de tu componente aquí
    ?>
        <!-- Tu HTML aquí -->
        <h1>Hola, esta es Mi Página</h1>
    <?php
    }
    ?>
    ```

3.  **Registrar la Ruta:**
    Abre el archivo `index.php` en la raíz del proyecto. Añade una nueva ruta para tu página usando el objeto `$router`.

    ```php
    // GET /mi-pagina
    $router->get('/mi-pagina', function() {
        require_once __DIR__ . '/views/MiPagina.php';
        Layout(MiPagina());
    });
    ```
    - El primer argumento de `$router->get()` es la URL (ej: `/mi-pagina`).
    - La función anónima se encarga de incluir el archivo de la vista y renderizarla dentro del `Layout`.

4.  **Verificar:**
    Inicia la aplicación y navega a `http://localhost:8080/mi-pagina` para ver tu nueva página.

### Cómo Crear un Nuevo Componente

Los componentes son piezas de UI reutilizables que puedes incluir en cualquier página.

1.  **Crear el Archivo del Componente:**
    Crea un nuevo archivo PHP en el directorio `views/components/`.
    *Ejemplo:* `views/components/MiComponente.php`

2.  **Definir la Función del Componente:**
    Dentro del archivo, define una función con el mismo nombre que el archivo. Esta función debe contener el HTML del componente.

    ```php
    <?php
    function MiComponente($texto) {
    ?>
        <div class="mi-componente">
            <p><?php echo htmlspecialchars($texto); ?></p>
        </div>
    <?php
    }
    ?>
    ```

3.  **Usar el Componente en una Vista:**
    Abre el archivo de la vista donde quieres usar el componente (ej: `views/Home.php`).
    - **Incluye el archivo** del componente en la parte superior de la vista.
    - **Llama a la función** del componente en el lugar donde deseas que aparezca.

    ```php
    <?php
    require_once __DIR__ . '/components/MiComponente.php'; // 1. Incluir

    function Home() {
    ?>
        <!-- Otro HTML de la página -->
        
        <?php MiComponente("Este es un texto de ejemplo"); // 2. Llamar ?>

        <!-- Más HTML -->
    <?php
    }
    ?>
    ```

## 5. Uso de Gemini CLI en el Proyecto

Gemini CLI es una herramienta de línea de comandos que utiliza inteligencia artificial para ayudarte a escribir, modificar y entender el código de este proyecto. Puedes usarlo para automatizar tareas, refactorizar, crear nuevos componentes y más.

### Cómo Interactuar con Gemini

Interactúas con Gemini directamente en tu terminal, dándole instrucciones en lenguaje natural.

1.  **Inicia la herramienta:** Asegúrate de tener Gemini CLI instalado y activo en la raíz del proyecto.

2.  **Realiza una petición:** Sé claro y específico en lo que necesitas. Puedes hacer referencia a archivos y carpetas usando el símbolo `@`.

    **Ejemplo 1: Crear un nuevo componente**
    ```
    > gemini crea un nuevo componente en @views/components/backend/ llamado MiBoton.php que renderice un botón con un texto personalizable
    ```

    **Ejemplo 2: Refactorizar código JavaScript**
    ```
    > gemini refactoriza la función fetchMatches en @public/js/api.js para que maneje los errores con un bloque try/catch
    ```

    **Ejemplo 3: Añadir una nueva ruta**
    ```
    > gemini agrega una nueva ruta GET en @index.php llamada /perfil que renderice la vista Profile.php
    ```

3.  **Revisa y Aprueba los Cambios:**
    Gemini no modificará tus archivos directamente. En su lugar, te propondrá una serie de "llamadas a herramientas" (tool calls), como `write_file` o `replace`. **Es tu responsabilidad revisar estas propuestas y aprobarlas** para que los cambios se apliquen. Esto te da control total sobre el código.

### Buenas Prácticas

-   **Sé específico:** Cuanto más detallada sea tu petición, mejor será el resultado. Incluye nombres de archivos, funciones y la lógica que esperas.
-   **Empieza con tareas pequeñas:** Para familiarizarte, comienza con cambios pequeños y aislados.
-   **Supervisa siempre:** Usa Gemini como un asistente. Revisa el código generado y asegúrate de que cumple con los estándares y la lógica del proyecto antes de aprobar.
# Guía de Onboarding y Desarrollo con Docker

Este documento describe el proceso completo para que un nuevo desarrollador se incorpore al proyecto, configure su entorno y ejecute la aplicación utilizando Docker.

## 1. Prerrequisitos de Software

Necesitarás Git y un entorno Docker funcional. Elige la opción que mejor se adapte a tu sistema operativo.

### Opción A: Docker Desktop (Recomendado para Windows y macOS)

La forma más sencilla de empezar es instalando [Docker Desktop](https://www.docker.com/products/docker-desktop/). Este paquete gestiona todo lo necesario (motor de Docker, CLI y `docker-compose`) en una sola aplicación.

### Opción B: Docker Engine + Compose (Para Linux)

En entornos Linux, puedes instalar el motor de Docker y el plugin de Compose directamente. Para **Debian/Ubuntu**, sigue estos pasos en tu terminal:

```bash
# 1. Actualizar e instalar dependencias
sudo apt-get update
sudo apt-get install ca-certificates curl

# 2. Añadir la clave GPG y el repositorio de Docker
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# 3. Instalar Docker Engine y Compose
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```
Para otras distribuciones, consulta la [guía oficial de instalación de Docker](https://docs.docker.com/engine/install/).

### Opción C: Windows con WSL 2 + Docker Engine (Avanzado)

Si no puedes o no deseas instalar Docker Desktop en Windows, puedes configurar un entorno Docker manually usando el Subsistema de Windows para Linux (WSL 2).

> **Advertencia:** Esta es una configuración avanzada. Se recomienda Docker Desktop para la mayoría de los usuarios de Windows por su simplicidad.

**Pasos de instalación:**

1.  **Instalar WSL 2 y una distribución de Linux (Ubuntu):**
    Abre una terminal de PowerShell **como Administrador** y ejecuta:
    ```powershell
    wsl --install
    ```
    Este comando habilitará las características necesarias, instalará WSL 2 y descargará la última versión de Ubuntu. Reinicia tu máquina si se te solicita.

2.  **Abrir la terminal de Ubuntu:**
    Una vez instalado, busca "Ubuntu" en tu menú de inicio y abre la terminal. La primera vez, te pedirá que crees un nombre de usuario y una contraseña. **Esta contraseña se usará para los comandos `sudo`**.

3.  **Instalar Docker Engine y Compose dentro de Ubuntu:**
    Dentro de la terminal de Ubuntu que acabas de abrir, sigue los mismos pasos descritos en la **Opción B** para Linux.

4.  **¡Importante! Trabajar dentro de WSL:**
    Para que todo funcione correctamente y con el mejor rendimiento, debes clonar el repositorio y ejecutar los comandos `docker-compose` **dentro del entorno de WSL**, no desde PowerShell o CMD. Accede a tu directorio de usuario con `cd ~` y trabaja desde ahí.

## 2. Proceso de Onboarding y Puesta en Marcha

### Paso 1: Solicitar Acceso al Repositorio

**Acción requerida:** Contacta al líder del proyecto y envíale tu **nombre de usuario de GitHub** para que te añada como colaborador.

### Paso 2: Clonar el Repositorio

Una vez que tengas acceso, abre tu terminal (o la terminal de Ubuntu si usas WSL) y clona el proyecto.

```bash
git clone <URL-del-repositorio>
cd <nombre-del-repositorio>
```

### Paso 3: Iniciar el Entorno de Desarrollo

Con Docker funcionando y ubicado en la raíz del proyecto, ejecuta el siguiente comando:

```bash
docker-compose up
```

### Paso 4: Acceder a la Aplicación

Abre tu navegador web y visita: [**http://localhost:8080**](http://localhost:8080)

## 3. Comandos Útiles de Docker Compose

- **Iniciar en segundo plano:** `docker-compose up -d`
- **Detener el entorno:** `docker-compose down`
- **Ver logs en tiempo real:** `docker-compose logs -f web`
- **Forzar reconstrucción:** `docker-compose up --build`

## 4. Flujo de Trabajo con Git en Visual Studio Code

Aunque siempre puedes usar la línea de comandos de Git, VS Code ofrece una interfaz gráfica muy intuitiva para las operaciones del día a día.

### Paso 1: Sincronizar (Pull)

Antes de empezar a trabajar, siempre es buena práctica traer los últimos cambios del repositorio.

1.  Abre la vista de **Control de código fuente** (el ícono con tres puntos y ramas).
2.  Haz clic en los tres puntos (`...`) en la parte superior de la vista.
3.  Selecciona **"Extraer" (Pull)** en el menú desplegable. Esto traerá los cambios de la rama remota a tu copia local.

Alternativamente, puedes usar el botón **"Sincronizar Cambios"** en la barra de estado azul en la parte inferior izquierda, si está disponible.

### Paso 2: Realizar y Preparar Cambios (Add/Stage)

1.  Modifica tu código como lo harías normalmente.
2.  En la vista de **Control de código fuente**, verás una lista de todos los archivos que has modificado bajo la sección **"Cambios"**.
3.  Para preparar un archivo para el commit (equivalente a `git add`), simplemente haz clic en el ícono `+` que aparece al lado del nombre del archivo. El archivo se moverá a la sección **"Cambios preparados"**.

### Paso 3: Confirmar Cambios (Commit)

1.  Una vez que tengas tus cambios preparados, ve al cuadro de texto en la parte superior de la vista de **Control de código fuente** que dice "Mensaje".
2.  Escribe un mensaje de commit descriptivo (ej: "Agrega la validación del formulario de contacto").
3.  Haz clic en el ícono de la marca de verificación (✓) para confirmar el commit.

### Paso 4: Subir Cambios (Push)

Después de hacer uno o varios commits, necesitas subirlos al repositorio remoto.

1.  Abre la vista de **Control de código fuente**.
2.  Haz clic en los tres puntos (`...`) y selecciona **"Insertar" (Push)**.

También puedes usar el botón **"Sincronizar Cambios"** en la barra de estado, que intentará hacer un `pull` seguido de un `push`, asegurando que no tengas conflictos antes de subir tus cambios.
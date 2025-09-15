# Guía de Despliegue Rápido para el Profesor

Este documento describe los pasos para levantar la aplicación y visualizarla en un navegador.

## 1. Prerrequisitos

Solo se necesita tener **Docker** instalado y en ejecución en su sistema.

- **Windows/macOS:** Se recomienda instalar [Docker Desktop](https://www.docker.com/products/docker-desktop/).
- **Linux:** Puede instalar Docker Engine siguiendo la [guía oficial](https://docs.docker.com/engine/install/).

## 2. Pasos para Iniciar

Siga estos pasos desde una terminal o línea de comandos.

### Paso 1: Abrir la Terminal en el Directorio del Proyecto

Asegúrese de que su terminal esté ubicada en la carpeta raíz de este proyecto (la misma carpeta donde se encuentra este archivo).

### Paso 2: Iniciar el Entorno

Ejecute el siguiente comando. Docker comenzará a descargar las imágenes necesarias y a construir el contenedor de la aplicación. Este proceso puede tardar unos minutos la primera vez.

```bash
docker-compose up
```

Si desea ejecutarlo en segundo plano (sin bloquear la terminal), puede usar:

```bash
docker-compose up -d
```

### Paso 3: Acceder a la Aplicación

Una vez que el comando anterior haya finalizado, abra su navegador web y visite la siguiente dirección:

[**http://localhost:8080**](http://localhost:8080)

La aplicación debería estar visible y funcionando.

## Comandos Adicionales

- **Para detener la aplicación:**
  ```bash
  docker-compose down
  ```
- **Para forzar la reconstrucción de la imagen (si hay cambios en el Dockerfile):**
  ```bash
  docker-compose up --build
  ```
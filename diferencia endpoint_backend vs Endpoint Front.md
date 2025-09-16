
### **Diferencias Principales entre Endpoints**

| Característica | Endpoint de Front-end | Endpoint de Back-end |
| :--- | :--- | :--- |
| **Contenido Devuelto** | Devuelve archivos para la interfaz de usuario: **HTML, CSS, y JavaScript**. Estos son los archivos que el navegador necesita para renderizar la página. | Devuelve **datos estructurados**, generalmente en formato **JSON** o XML. Esto permite que el front-end maneje la información y la presente de la manera que desee. |
| **Propósito** | Su función es **presentar una interfaz** y una experiencia de usuario. Es la "fachada" de la aplicación que el usuario final ve. | Su función es **manejar la lógica, los datos** y las operaciones del servidor. Es la "cocina" donde se procesan las peticiones. |
| **Nomenclatura (Convención)** | No tiene una convención de ruta universal. Las URL a menudo reflejan el contenido de la página, como `/perfil` o `/partidos`. | Por convención, las rutas de los endpoints de API a menudo comienzan con `/api` o `/api/v1` para indicar que son para el consumo de la API, no para la visualización directa del usuario. |


# Configuración del Servicio de Backend en Laravel

Este proyecto utiliza Docker para crear un ambiente de desarrollo y producción para una aplicación backend en Laravel con un servidor nginx.

## Requisitos Previos

Asegúrate de tener Docker y Docker Compose instalados en tu sistema para poder construir y ejecutar los contenedores necesarios.

## Estructura de Archivos Importantes

- `Dockerfile`: Contiene todas las instrucciones para construir la imagen del contenedor de PHP.
- `docker-compose.yml`: Define los servicios, redes y volúmenes que componen tu aplicación.
- `docker-compose/nginx/asesora.conf`: Configuraciones específicas para el servidor nginx.

## Variables de Entorno

Antes de iniciar los servicios, asegúrate de configurar las variables de entorno necesarias en un archivo `.env` en la raíz del proyecto. Este archivo debe contener todas las claves necesarias para la configuración de tu aplicación y la conexión a la base de datos.

## Instrucciones para Levantar el Servicio

1. **Construir y Levantar los Contenedores:**
   Utiliza el siguiente comando para construir y levantar los contenedores en modo detenido:

   ```bash
   docker-compose up -d
    ```
2. **Verificar los Contenedores:**
    Puedes verificar que los contenedores estén corriendo correctamente utilizando:
    ```bash
   docker-compose ps
    ```
3. **Acceder a la Aplicación:** Una vez que los contenedores estén en funcionamiento, puedes acceder a la aplicación a través de http://localhost:8000.

4. **Detener los Contenedores:**

    Para detener todos los contenedores, puedes utilizar:
    ```bash
   docker-compose down
    ```

## Solución de Problemas
* Si encuentras problemas al acceder a tu aplicación, asegúrate de que no hay otros servicios corriendo en el mismo puerto.
* Verifica las configuraciones de nginx y asegúrate de que las rutas en el archivo de configuración están correctamente establecidas respecto a las rutas en tus contenedores.

## Mantenimiento 
Es una buena práctica actualizar regularmente las imágenes de Docker para aprovechar las últimas actualizaciones de seguridad y rendimiento. Puedes hacerlo con:
```bash
docker-compose build --no-cache
```
Esperamos que esta guía te ayude a manejar tu entorno de desarrollo y producción de manera efectiva.

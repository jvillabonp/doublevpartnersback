# Gestión de Tickets

Esta es la solución a la prueba técnica de Double V Partners backend

## Requerimientos

PHP 8^
MySQL 5^
Postman
Composer

## Instalación

- Clonar el repositorio en una carpeta local en cualquier carpeta del sistema.
- Al momento de clonar es necesario dirigirse al directorio donde se clonó y ejecutar `composer install`
- Crear un archivo en el directorio raíz .env
- Copiar los datos que se encuentran en el archivo `.env.example` en el archivo recien creado
- En los campos `DB_DATABASE` `DB_USERNAME` `DB_PASSWORD` poner los parámetros según corresponda.
- Crear la base de datos en el gestor de elección `CREATE DATABASE {dbname}`
- Ejecutar `php artisan migrate --seed`
    1. Crea las tablas respectivas en base de datos
    2. Inserta datos aleatorios de Usuarios y Tickets en la base de datos

## Ejecución

- Ejecutar el comando `php artisan serve`
- Verifricar en el navegador que la URL cargue (por defecto debería ser `http://localhost:8000`)
- En el navegador se verán las rutas, métodos y parámetros necesarios para que funcione el aplicativo a través de postman.
- Ejecutar alguna de las operaciones allí descritas en el navegador

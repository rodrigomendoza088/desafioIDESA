# desafioIDESA
Desafio IDESA #1

El proyecto trata de una API RESTful de una biblioteca, permite la creacion, lectura, actualizacion y eliminacion (CRUD) de libros y autores; Asi como tambien un sencillo modulo de autenticacion.

## Requisitos
PHP >= 8.2.

MySql.

Laravel 11.

## Instalacion

Clonar el proyecto

```bash
  git clone https://github.com/rodrigomendoza088/desafioIDESA.git
```

Ir a la carpeta del proyecto

```bash
  cd desafioIDESA
```

Instalar dependencias

```bash
  composer install
```
Configurar nuestra coneccion a la base de datos en nuestro archivo .en

```bash
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=idesatest
 DB_USERNAME=root
 DB_PASSWORD=
```
Ejecutar migraciones

```bash
  php artisan migrate
```

Ejecutar seeders

```bash
  php artisan db:seed
```
Inicializar

```bash
  php artisan serve
```

## Base de Datos : idesatest

Para el proyecto se proporciona un dump.SQL para crear la base de datos inicial con el nombre "idesatest.sql"


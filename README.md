<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Guía de Configuración y Uso del Proyecto

## Configuración del Entorno

1. **Requisitos Previos:**
    - PHP >= 7.4
    - Composer
    - MySQL (u otro sistema de gestión de bases de datos compatible)

-   composer install
-   Copiar el archivo .env.example y renombrarlo a .env.

-   DB_CONNECTION=mysql
-   DB_HOST=127.0.0.1
-   DB_PORT=3306
-   DB_DATABASE=prueba_tecnica_atrinium
-   DB_USERNAME=root
-   DB_PASSWORD=

-   php artisan migrate:fresh --seed
-   php artisan serve

# API Documentation

## User Routes

### Test User Route

-   **URL:** `/test_user`
-   **Method:** `GET`
-   **Description:** Endpoint for testing user API.
-   **Controller Method:** `UserApiController@index`

### Get All Users

-   **URL:** `/users`
-   **Method:** `GET`
-   **Description:** Retrieves all users.
-   **Controller Method:** `UserApiController@show`

### Get Specific User

-   **URL:** `/users/{id}`
-   **Method:** `GET`
-   **Description:** Retrieves information about a specific user.
-   **Controller Method:** `UserApiController@showUser`
-   **Parameters:**
    -   `id` (integer): ID of the user.

### Create User

-   **URL:** `/create/users`
-   **Method:** `POST`
-   **Description:** Creates a new user.
-   **Controller Method:** `UserApiController@store`
-   **Request Body:** JSON object containing user data.
    ```json
    {
        "nombre_usuario": "user_name",
        "email_usuario": "email@example.com",
        "telefono_usuario": "1234567899",
        "rol_id": 2
    }
    ```

### Update User

-   **URL:** `/update/users/{id}`
-   **Method:** `PUT`
-   **Description:** Updates information about a specific user.
-   **Controller Method:** `UserApiController@update`
-   **Parameters:**
    -   `id` (integer): ID of the user to be updated.
-   **Request Body:** JSON object containing updated user data.
    ```json
    {
        "nombre_usuario": "Nuevo Nombre",
        "email_usuario": "nuevoemail@example.com",
        "telefono_usuario": "987654321",
        "rol_id": 3
    }
    ```

### Delete User

-   **URL:** `/delete/users/{id}`
-   **Method:** `DELETE`
-   **Description:** Deletes a user.
-   **Controller Method:** `UserApiController@destroy`
-   **Parameters:**
    -   `id` (integer): ID of the user to be deleted.
-   **Request Body:** JSON object containing admin role information.
    ```json
    {
        "rol_admin": 1
    }
    ```

### Change User Role

-   **URL:** `/change/role/users/{id}`
-   **Method:** `PUT`
-   **Description:** Changes the role of a user from basic to admin.
-   **Controller Method:** `UserApiController@changeRole`
-   **Parameters:**
    -   `id` (integer): ID of the user whose role will be changed.

### Filter Users by Empresa

-   **URL:** `/filter/users/empresa`
-   **Method:** `GET`
-   **Description:** Finds users who are owners of companies.
-   **Controller Method:** `UserApiController@findUsersEmpresa`

## Empresa Routes

### Test Empresa Route

-   **URL:** `/test_empresa`
-   **Method:** `GET`
-   **Description:** Endpoint for testing empresa API.
-   **Controller Method:** `EmpresaApiController@index`

### Get All Empresas

-   **URL:** `/empresas`
-   **Method:** `GET`
-   **Description:** Retrieves all empresas.
-   **Controller Method:** `EmpresaApiController@show`

### Get Specific Empresa

-   **URL:** `/empresas/{id}`
-   **Method:** `GET`
-   **Description:** Retrieves information about a specific empresa.
-   **Controller Method:** `EmpresaApiController@showEmpresa`
-   **Parameters:**
    -   `id` (integer): ID of the empresa.

### Create Empresa

-   **URL:** `/create/empresa`
-   **Method:** `POST`
-   **Description:** Creates a new empresa.
-   **Controller Method:** `EmpresaApiController@store`
-   **Request Body:** JSON object containing empresa data.
    ```json
    {
        "nombre_empresa": "name_empresa",
        "direccion_empresa": "example_address",
        "telefono_empresa": "555-12385",
        "tipo_documento": "CIF12388466",
        "estado_id": 1,
        "usuario_id": 2
    }
    ```

### Update Empresa

-   **URL:** `/update/empresas/{id}`
-   **Method:** `PUT`
-   **Description:** Updates information about a specific empresa.
-   **Controller Method:** `EmpresaApiController@update`
-   **Parameters:**
    -   `id` (integer): ID of the empresa to be updated.
-   **Request Body:** JSON object containing updated empresa data.
    ```json
    {
        "nombre_empresa": "Nuevo Nombre de Empresa",
        "direccion_empresa": "Nueva Dirección",
        "telefono_empresa": "555-5555",
        "tipo_documento": "Nuevo Tipo de Documento",
        "estado_id": 2,
        "usuario_id": 5
    }
    ```

### Delete Empresa

-   **URL:** `/delete/empresas/{id}`
-   **Method:** `DELETE`
-   **Description:** Deletes an empresa.
-   **Controller Method:** `EmpresaApiController@destroy`
-   **Parameters:**
    -   `id` (integer): ID of the empresa to be deleted.

### Filter Empresas Without Actividades

-   **URL:** `/filter/empresas/actividades`
-   **Method:** `GET`
-   **Description:** Finds empresas that do not have any actividades.
-   **Controller Method:** `EmpresaApiController@findEmpresasSinActividades`

## Actividad Empresa Routes

### Test Actividad Empresa Route

-   **URL:** `/test_actividad_empresa`
-   **Method:** `GET`
-   **Description:** Endpoint for testing actividad empresa API.
-   **Controller Method:** `ActividadEmpresaApiController@index`

### Get All Actividades Empresas

-   **URL:** `/actividades_empresas`
-   **Method:** `GET`
-   **Description:** Retrieves all actividades of empresas.
-   **Controller Method:** `ActividadEmpresaApiController@show`

### Get Specific Actividad Empresa

-   **URL:** `/actividades_empresas/{id}`
-   **Method:** `GET`
-   **Description:** Retrieves information about a specific actividad empresa.
-   **Controller Method:** `ActividadEmpresaApiController@showActividadEmpresa`
-   **Parameters:**
    -   `id` (integer): ID of the actividad empresa.

### Create Actividad Empresa

-   **URL:** `/create/actividad_empresa`
-   **Method:** `POST`
-   **Description:** Creates a new actividad empresa.
-   **Controller Method:** `ActividadEmpresaApiController@store`
-   **Request Body:** JSON object containing actividad empresa data.
    ```json
    {
        "nombre": "Actividad 1",
        "descripcion": "Descripción de la actividad 1",
        "empresa_id": 2
    }
    ```

### Update Actividad Empresa

-   **URL:** `/update/actividades_empresas/{id}`
-   **Method:** `PUT`
-   **Description:** Updates information about a specific actividad empresa.
-   **Controller Method:** `ActividadEmpresaApiController@update`
-   **Parameters:**
    -   `id` (integer): ID of the actividad empresa to be updated.
-   **Request Body:** JSON object containing updated actividad empresa data.
    ```json
    {
        "nombre": "Nuevo Nombre de Actividad",
        "descripcion": "Nueva descripción de la actividad",
        "empresa_id": 3
    }
    ```

### Delete Actividad Empresa

-   **URL:** `/delete/actividades_empresas/{id}`
-   **Method:** `DELETE`
-   **Description:** Deletes an actividad empresa.
-   **Controller Method:** `ActividadEmpresaApiController@destroy`
-   **Parameters:**
    -   `id` (integer): ID of the actividad empresa to be deleted.

### Filtro Coincidencia

-   **URL:** `/filter/coincidencias`
-   **Method:** `POST`
-   **Description:** Finds text matches in the listings of users, companies, and activities for at least 3 attributes of each model.
-   **Controller Method:** `EmpresaApiController@findCoincidencias`
-   **Request Body:** JSON object containing criteria for text matching.
    ```json
    {
        "text": "Texto de búsqueda"
    }
    ```

### Historial De Conversiones

### Test Historial Conversion Route

-   **URL:** `/test_historial_conversion`
-   **Method:** `GET`
-   **Description:** Endpoint for testing historial conversion API.
-   **Controller Method:** `HistorialConversionApiController@index`

### Show All Historiales de Conversión

-   **URL:** `/historial_conversion`
-   **Method:** `GET`
-   **Description:** Retrieves all historiales de conversion.
-   **Controller Method:** `HistorialConversionApiController@showAll`

### Create Historial de Conversión

-   **URL:** `/create/historial_conversion`
-   **Method:** `POST`
-   **Description:** Creates a new historial de conversion.
-   **Controller Method:** `HistorialConversionApiController@store`
-   **Request Body:** JSON object containing historial de conversion data.
    ```json
    {
      "monto": monto,
      "moneda_origen": "moneda_origen",
      "moneda_destino": "moneda_final"
    }
    ```

## Comandos Artisan

### currency:import

Este comando permite importar los datos de la serie histórica de cambios de moneda ofrecida por el Banco Central Europeo en formato XML.

#### Uso:

```bash
php artisan currency:import
```

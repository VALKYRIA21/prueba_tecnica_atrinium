<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

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

### Update User

-   **URL:** `/update/users/{id}`
-   **Method:** `PUT`
-   **Description:** Updates information about a specific user.
-   **Controller Method:** `UserApiController@update`
-   **Parameters:**
    -   `id` (integer): ID of the user to be updated.
-   **Request Body:** JSON object containing updated user data.

### Delete User

-   **URL:** `/delete/users/{id}`
-   **Method:** `DELETE`
-   **Description:** Deletes a user.
-   **Controller Method:** `UserApiController@destroy`
-   **Parameters:**
    -   `id` (integer): ID of the user to be deleted.

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

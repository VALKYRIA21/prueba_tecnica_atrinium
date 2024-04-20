<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

// Models
use App\Models\User;

class UserApiController extends Controller
{
    //Test
    public function index(){
        return response()->json(['message' => 'Test api users'], 200);
    }
    //Function para traer todos los usuarios registrados
    public function show(){
        $users = User::all();
        if($users->isEmpty()){
            $data = [
                'message' => 'No hay usuarios registrados',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'users' => $users,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo método, para crear un usuario
    public function store(Request $request){

        // Validar cada uno de los campos
        $validator = Validator::make($request->all(), [
            'nombre_usuario' => 'required|string',
            'email_usuario' => 'required|email|unique:users',
            'telefono_usuario' => 'nullable|string',
            'rol_id' => 'required|exists:rol_usuarios,id',
        ]);

        // Verificar si hay errores en la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }


        // Generar un remember_token aleatorio
        $rememberToken = Str::random(60);
        // Crear un nuevo usuario utilizando el método create
        $user = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'email_usuario' => $request->email_usuario,
            'telefono_usuario' => $request->telefono_usuario,
            'rol_id' => $request->rol_id,
            'remember_token' => $rememberToken,
        ]);

        // Verificar si el usuario fue creado
        if (!$user) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }


        // Retornar la respuesta
        $data = [
            'user' => $user,
            'status' => 201
        ];

        return response()->json($data, 201);


    }
    // Creando un nuevo método, para mostrar un usuario en específico
    public function showUser($id){
        $user = User::find($id);
        if(!$user){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Usuario encontrado',
            'user' => $user,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo método, para actualizar un usuario
    public function update(Request $request, $id){
        // Buscar el usuario por el id
        $user = User::find($id);
        if(!$user){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar cada uno de los campos
        $validator = Validator::make($request->all(), [
            'nombre_usuario' => 'required|string',
            'email_usuario' => 'required|email|unique:users,email_usuario,'.$id,
            'telefono_usuario' => 'nullable|string',
            'rol_id' => 'required|exists:rol_usuarios,id',
        ]);

        // Verificar si hay errores en la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualizar los datos del usuario
        $user->nombre_usuario = $request->nombre_usuario;
        $user->email_usuario = $request->email_usuario;
        $user->telefono_usuario = $request->telefono_usuario;
        $user->rol_id = $request->rol_id;

        // Guardar los cambios
        $user->save();

        // Retornar la respuesta
        $data = [
            'message' => 'Usuario actualizado correctamente',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    // Creando un nuevo método, para eliminar un usuario
    public function destroy(Request $request, $id){
        if($request->rol_admin == 2){
            $data = [
                'message' => 'No tienes permisos para eliminar un usuario',
                'status' => 401
            ];
            return response()->json($data, 401);

        }
        // Buscar el usuario por el id
        $user = User::find($id);
        if(!$user){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Eliminar el usuario
        $user->delete();

        // Retornar la respuesta
        $data = [
            'message' => 'Usuario eliminado correctamente',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    // Creando un nuevo método, para cambiar de rol a un usuario basico
    public function changeRol(Request $request, $id){
        // Buscar el usuario por el id
        $user = User::find($id);
        if(!$user){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar si el usuario ya es un usuario basico
        if($user->rol_id == 1){
            $data = [
                'message' => 'El usuario ya es un usuario basico',
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Cambiar el rol del usuario
        $user->rol_id = 1;

        // Guardar los cambios
        $user->save();

        // Retornar la respuesta
        $data = [
            'message' => 'Rol cambiado a usuario basico',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}

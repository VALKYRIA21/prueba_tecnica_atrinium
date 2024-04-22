<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


// Models
use App\Models\User;
use App\Models\Empresa;
use App\Models\ActividadEmpresa;

class EmpresaApiController extends Controller
{
    // Test
    public function index(){
        return response()->json(['message' => 'Test api empresas'], 200);
    }
    //Function para traer todas las empresas registradas
    public function show(){
        $empresas = Empresa::all();
        if($empresas->isEmpty()){
            $data = [
                'message' => 'No hay empresas registradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'empresas' => $empresas,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo método, para crear una empresa
    public function store(Request $request){

        // Verificar si el usuario ya tiene una empresa
        $usuario_id = $request->usuario_id;
        $empresa_existente = Empresa::where('usuario_id', $usuario_id)->first();

        if ($empresa_existente) {
            $data = [
                'message' => 'El usuario ya tiene una empresa asociada',
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Validar cada uno de los campos
        $validator = Validator::make($request->all(), [
            'nombre_empresa' => 'required|string',
            'direccion_empresa' => 'required|string',
            'telefono_empresa' => 'required|string',
            'tipo_documento' => 'required|string|unique:empresas,tipo_documento',
            'estado_id' => 'nullable|exists:estado_empresas,id',
            'usuario_id' => 'nullable|exists:users,id',
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

        // Crear la empresa solo si el usuario no tiene una empresa asociada
        $empresa = Empresa::create([
            'nombre_empresa' => $request->nombre_empresa,
            'direccion_empresa' => $request->direccion_empresa,
            'telefono_empresa' => $request->telefono_empresa,
            'tipo_documento' => $request->tipo_documento,
            'estado_id' => $request->estado_id,
            'usuario_id' => $request->usuario_id,
        ]);

        $data = [
            'message' => 'Empresa creada correctamente',
            'empresa' => $empresa,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    // Creando un nuevo método, para mostras una enpresa en especifico
    public function showEmpresa($id){
        $empresa = Empresa::find($id);
        if(!$empresa){
            $data = [
                'message' => 'Empresa no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Empresa encontrada',
            'empresa' => $empresa,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo método, para actualizar una empresa
    public function update(Request $request, $id){
        // Buscar la empresa por el ID
        $empresa = Empresa::find($id);

        // Verificar si la empresa no existe
        if (!$empresa) {
            $data = [
                'message' => 'Empresa no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), [
            'nombre_empresa' => 'required|string',
            'direccion_empresa' => 'required|string',
            'telefono_empresa' => 'required|string',
            'tipo_documento' => 'required|string|unique:empresas,tipo_documento,' . $id,
            'estado_id' => 'nullable|exists:estado_empresas,id',
            'usuario_id' => 'nullable|exists:users,id',
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

        // Actualizar los datos de la empresa
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->direccion_empresa = $request->direccion_empresa;
        $empresa->telefono_empresa = $request->telefono_empresa;
        $empresa->tipo_documento = $request->tipo_documento;
        $empresa->estado_id = $request->estado_id;
        $empresa->usuario_id = $request->usuario_id;

        // Guardar los cambios
        $empresa->save();

        // Retornar la respuesta
        $data = [
            'message' => 'Empresa actualizada correctamente',
            'empresa' => $empresa,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
    // Creando una un nuevo método, para eliminar una empresa
    public function delete(Request $request, $id){
        if($request->rol_admin == 2){
            $data = [
                'message' => 'No tienes permisos para eliminar una empresa',
                'status' => 401
            ];
            return response()->json($data, 401);

        }
        // Buscar la empresa por el ID
        $empresa = Empresa::find($id);

        // Verificar si la empresa no existe
        if (!$empresa) {
            $data = [
                'message' => 'Empresa no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Eliminar la empresa
        $empresa->delete();

        // Retornar la respuesta
        $data = [
            'message' => 'Empresa eliminada correctamente',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    // Creando un nuevo método, para eliminar una empresa

    // Creando un nuevo método, para filtrar las empresas que no tienen actividades
    public function findEmpresasSinActividades(){
        $empresas = Empresa::doesntHave('actividades')->get();
        if($empresas->isEmpty()){
            $data = [
                'message' => 'No hay empresas sin actividades',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message'   => 'Empresas sin actividades',
            'empresas' => $empresas,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // Filtro
    // Creando un nuevo método, para filtrar encontrar coincidencias de texto en los listados de usuarios, empresas y actividades por al menos 3 atributos de cada modelo.
    public function findCoincidencias(Request $request){


        $validator = Validator::make($request->all(), [
            'texto' => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], 400);
        }

        $texto = $request->texto;
        if(strlen($request->texto) < 3){
            $data = [
                'message' => 'El texto de coincidencia debe tener al menos 3 caracteres',
                'status' => 400
            ];
            return response()->json($data, 400);
        }


        $usuarios = User::where('nombre_usuario', 'LIKE', "%$texto%")
                        ->orWhere('email_usuario', 'LIKE', "%$texto%")
                        ->orWhere('telefono_usuario', 'LIKE', "%$texto%")
                        ->orWhere('rol_id', 'LIKE', "%$texto%")
                        ->get();
        $empresas = Empresa::where('nombre_empresa', 'LIKE', "%$texto%")
                        ->orWhere('direccion_empresa', 'LIKE', "%$texto%")
                        ->orWhere('telefono_empresa', 'LIKE', "%$texto%")
                        ->orWhere('tipo_documento', 'LIKE', "%$texto%")
                        ->orWhere('estado_id', 'LIKE', "%$texto%")
                        ->orWhere('usuario_id', 'LIKE', "%$texto%")
                        ->get();
        $actividades = ActividadEmpresa::where('nombre', 'LIKE', "%$texto%")
                        ->orWhere('descripcion', 'LIKE', "%$texto%")
                        ->orWhere('empresa_id', 'LIKE', "%$texto%")
                        ->get();
        if($usuarios->isEmpty() && $empresas->isEmpty() && $actividades->isEmpty()){
            $data = [
                'message' => 'No se encontraron coincidencias',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Coincidencias encontradas',
            'usuarios' => $usuarios,
            'empresas' => $empresas,
            'actividades' => $actividades,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}

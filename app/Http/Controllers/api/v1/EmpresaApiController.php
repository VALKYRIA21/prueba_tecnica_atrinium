<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


// Models
use App\Models\Empresa;

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
}

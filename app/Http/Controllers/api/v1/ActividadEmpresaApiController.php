<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\ActividadEmpresa;

class ActividadEmpresaApiController extends Controller
{
    //Test
    public function index(){
        return response()->json(['message' => 'Test api actividades empresas'], 200);
    }
    // Creando un nuevo método, para mostrar todas las actividades de las empresas
    public function show(){
        $actividades = ActividadEmpresa::all();
        if($actividades->isEmpty()){
            $data = [
                'message' => 'No hay actividades registradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'actividades' => $actividades,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo método, para crear una actividad de una empresa
    public function store(Request $request){
        // Validar cada uno de los campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        // Verificar si hay errores en la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los campos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Crear la actividad
        $actividad = ActividadEmpresa::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'empresa_id' => $request->empresa_id,
        ]);

        $data = [
            'message' => 'Actividad creada correctamente',
            'actividad' => $actividad,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    // Creando un nuevo método, para mostrar una actividad de una empresa en especifico
    public function showActividadEmpresa($id){
        $actividad = ActividadEmpresa::find($id);
        if(!$actividad){
            $data = [
                'message' => 'Actividad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'actividad' => $actividad,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo método, para actualizar una actividad de una empresa
    public function update(Request $request, $id){
        // Validar cada uno de los campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        // Verificar si hay errores en la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los campos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Buscar la actividad
        $actividad = ActividadEmpresa::find($id);

        // Verificar si la actividad existe
        if(!$actividad){
            $data = [
                'message' => 'Actividad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Actualizar la actividad
        $actividad->nombre = $request->nombre;
        $actividad->descripcion = $request->descripcion;
        $actividad->empresa_id = $request->empresa_id;
        $actividad->save();

        $data = [
            'message' => 'Actividad actualizada correctamente',
            'actividad' => $actividad,
            'status' => 200
        ];
        return response()->json($data, 200);

    }
    // Creando un nuevo método, para eliminar una actividad de una empresa
    public function destroy(Request $request, $id){
        if($request->rol_admin == 2){
            $data = [
                'message' => 'No tienes permisos para eliminar la actividad de una empresa',
                'status' => 401
            ];
            return response()->json($data, 401);
        }
        // Buscar la actividad
        $actividad = ActividadEmpresa::find($id);

        // Verificar si la actividad existe
        if(!$actividad){
            $data = [
                'message' => 'Actividad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Eliminar la actividad
        $actividad->delete();

        $data = [
            'message' => 'Actividad eliminada correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


// Models
use App\Models\HistorialConversion;

class HistorialConversionApiController extends Controller
{
    // Test
    public function index(){
        return response()->json([
            'message' => 'HistorialConversionApiController'
        ]);
    }
    // Creando un nuevo metodo para mostrar todos los historiales de conversion
    public function showAll(){
        $historialConversion = HistorialConversion::all();
        if($historialConversion->isEmpty()){
            $data = [
                'message' => 'No hay historiales de conversion registrados',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message'=> 'Historiales de conversion',
            'historialConversion' => $historialConversion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    // Creando un nuevo metodo para crear un historial y guardarlo en base de datos
    public function store(Request $request){
        // Validar cada uno de los campos
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric',
            'moneda_origen' => 'required|string',
            'moneda_destino' => 'required|string',
        ]);

        // Si la validacion falla
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $monto = $request->monto;
        $moneda_origen = $request->moneda_origen;
        $moneda_destino = $request->moneda_destino;

         // Verificar si existe una conversión previamente realizada en la base de datos
        $conversionExistente = HistorialConversion::where('moneda_origen', $moneda_origen)
        ->where('moneda_destino', $moneda_destino)
        ->where('monto_origen', $monto)
        ->first();

        // Si la conversión ya existe en la base de datos
        if ($conversionExistente) {
            return response()->json([
                'message' => 'Conversión encontrada en la base de datos',
                'conversion_final' => $conversionExistente->monto_final,
                'status' => 200,
                'conversion_id' => $conversionExistente->id,
            ]);
        }

        // apikey
        $apiKey = 'f120d7593b5515e1e30d693a';

        // Realiza la solicitud a la API
        $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/pair/{$moneda_origen}/{$moneda_destino}/{$monto}");

        // Verifica si la solicitud fue exitosa
        if ($response->failed()) {
            return response()->json(['error' => 'La solicitud de conversión de moneda falló'], 500);
        }
        // Obtiene los datos de la respuesta
        $data = $response->json();
        $total = $data['conversion_result'];
        // Guardar en base de datos
        $conversion = HistorialConversion::create([
            'moneda_origen' => $moneda_origen,
            'moneda_destino' => $moneda_destino,
            'monto_origen' => $monto,
            'monto_final' => $total,
        ]);
        // Devuelve el resultado de la conversión
        return response()->json([
            'message'=> 'Conversión de moneda exitosa',
            'conversion_final' => $total,
            'status' => 200
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActividadEmpresaApiController extends Controller
{
    //Test
    public function index(){
        return response()->json(['message' => 'Test api actividades empresas'], 200);
    }
}

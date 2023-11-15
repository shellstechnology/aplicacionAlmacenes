<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class lotesCamionController extends Controller
{
    public function obtenerDatos()
    {
        try {
            $response = Http::get('http://127.0.0.1:8001/api/loteCamion');
            $data = $response->json();
            Session::put('camionLlevaLote', $data[0]);
            Session::put('matriculaCamiones', $data[1]);
            Session::put('idLotes', $data[2]);
            return response()->json('Datos cargados');
        } catch (\Exception $e) {
            return response()->json('Error al obtener los datos');
        }
    }

    public function agregar($request)
    {
        try {
            $response = Http::post('http://127.0.0.1:8001/api/loteCamion', [
                'matricula' => $request->input('idCamion'),
                'id_lote' => $request->input('idLote'),
            ]);
            if($response->json()==null){
                return 'Error:Verifique los parametros del lote que intenta ingresar y el camion';
            }
            return 'Datos agregados correctamente';
        } catch (\Exception $e) {
            return 'No se pudieron agregar los datos';
        }

    }

    public function modificar($request)
    {
        try {
            $identificador = $request->input('identificador');
            $response = Http::put("http://127.0.0.1:8001/api/loteCamion/$identificador", [
                'matricula' => $request->input('idCamion'),
                'id_lote' => $request->input('idLote'),
            ]);
            if($response->json()==null){
                return 'Error:Verifique los parametros del lote que intenta ingresar y el camion';
            }
            return 'Datos modificados correctamente';
        } catch (\Exception $e) {
            return 'No se pudieron modificar los datos';
        }

    }

    public function eliminar($request)
    {
        try {
            $identificador = $request->input('identificador');
            $request = Http::delete("http://127.0.0.1:8001/api/loteCamion/$identificador");
            return 'Datos eliminados correctamente';
        } catch (\Exception $e) {
            return 'No se pudieron eliminar los datos';
        }

    }
    public function recuperar($request)
    {
        try {
            $identificador = $request->input('identificador');
            $request = Http::patch("http://127.0.0.1:8001/api/loteCamion/$identificador");
            return 'Datos recuperados correctamente';
        } catch (\Exception $e) {
            return 'No se pudieron recuperar los lotes';
        }
    }


    public function redireccion(Request $request)
    {
        try {
            $respuesta = 'No se encontro ninguna ruta';
            $accion = $request->input('accion');
            if ($accion == 'agregar') {
                $respuesta = $this->agregar($request);
            }
            if ($accion == 'modificar') {
                $respuesta = $this->modificar($request);
            }
            if ($accion == 'eliminar') {
                $respuesta = $this->eliminar($request);
            }
            if ($accion == 'recuperar') {
                $respuesta = $this->recuperar($request);
            }
            $this->obtenerDatos();
            return response()->json($respuesta);
        } catch (\Exception $e) {
            return response()->json('Error al obtener los datos');
        }
    }
}

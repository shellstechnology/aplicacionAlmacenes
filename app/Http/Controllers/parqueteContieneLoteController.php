<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class parqueteContieneLoteController extends Controller
{
    public function obtenerDatos()
    {
        $response = Http::get('http://127.0.0.1:8001/api/paquete-lote');
        $data = $response->json();
        Session::put('paqueteContieneLote', $data[0]);
        Session::put('idAlmacenes', $data[1]);
        Session::put('idPaquetes', $data[2]);
        Session::put('idLotes', $data[3]);
    }

    public function agregar($request)
    {try{
        $response=Http::post('http://127.0.0.1:8001/api/paquete-lote', [
            'id_lote' => $request->input('idLote'),
            'id_paquete' =>  $request->input('idPaquete'),
            'id_almacen' =>  $request->input('idAlmacen')
        ]);
        return 'Datos agregados correctamente';
    } catch (\Exception $e) {
        return 'No se pudieron agregar los datos';
    }
    }

    public function modificar($request)
    {
        try{
        $identificador = $request->input('identificador');
        $response= Http::put("http://127.0.0.1:8001/api/paquete-lote/$identificador", [
            'id_lote' => $request->input('idLote'),
            'id_paquete' =>  $request->input('idPaquete'),
            'id_almacen' =>  $request->input('idAlmacen')
        ]);
        return 'Datos modificados correctamente';
    } catch (\Exception $e) {
        return 'No se pudieron modificar los datos';
    }
    }

    public function eliminar($request)
    {
        try{
        $identificador = $request->input('identificador');
        $request = Http::delete("http://127.0.0.1:8001/api/paquete-lote/$identificador");
        return 'Datos eliminados correctamente';
    } catch (\Exception $e) {
        return 'No se pudieron eliminar los datos';
    }
    }
    public function recuperar($request)
    {
        try{
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/paquete-lote/$identificador");
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

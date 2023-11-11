<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class almacenesController extends Controller
{
    public function obtenerDatos()
    {
        $response = Http::get('http://127.0.0.1:8001/api/producto');
        $data = $response->json();
        $producto=$data[0];
        $moneda=$data[1];
        Session::put('producto', $producto);
        Session::put('monedas',$moneda);
        return redirect()->route('producto');
    }

    public function agregar($request)
    {
        try{
        Http::post('http://127.0.0.1:8001/api/producto', [
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'stock' => $request->input('stock'),
            'idMoneda' => $request->input('tipoMoneda'),
        ]);
        return 'Datos agregados correctamente';
    } catch (\Exception $e) {
        return 'No se pudieron agregar los datos';
    }
    }

    public function modificar($request)
    {try{
        $identificador = $request->input('identificador');
        $request = Http::put("http://127.0.0.1:8001/api/producto/$identificador", [
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'stock' => $request->input('stock'),
            'idMoneda' => $request->input('tipoMoneda'),
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
        $request = Http::delete("http://127.0.0.1:8001/api/producto/$identificador");
        return 'Datos eliminados correctamente';
    } catch (\Exception $e) {
        return 'No se pudieron eliminar los datos';
    }
    }
    public function recuperar($request)
    {
        try{
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/producto/$identificador");
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class productosController extends Controller
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
       $request= Http::post('http://127.0.0.1:8001/api/producto', [
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'stock' => $request->input('stock'),
            'idMoneda' => $request->input('tipoMoneda'),
        ]);
    /*     dd($request->json()); */
        $this->obtenerDatos();
    /*     return redirect()->route('producto'); */
    }

    public function modificar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::put("http://127.0.0.1:8001/api/producto/$identificador", [
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'stock' => $request->input('stock'),
            'idMoneda' => $request->input('tipoMoneda'),
        ]);
    }

    public function eliminar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::delete("http://127.0.0.1:8001/api/producto/$identificador");
    }
    public function recuperar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/producto/$identificador");
    }


    public function redireccion(Request $request)
    {
        $accion = $request->input('accion');
        if ($accion == 'agregar') {
            $this->agregar($request);
        }
        if ($accion == 'modificar') {
            $this->modificar($request);
        }
        if ($accion == 'eliminar') {
            $this->eliminar($request);
        }
        if ($accion == 'recuperar') {
            $this->recuperar($request);
        }
        $this->obtenerDatos();
        return redirect()->route('producto');
    }
    
}

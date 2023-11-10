<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class lotesController extends Controller
{
    public function obtenerDatos()
    {
        $response = Http::get('http://127.0.0.1:8001/api/lote');
        $data = $response->json();
        Session::put('lotes', $data);
    }

    public function agregar($request)
    {
        $response=Http::post('http://127.0.0.1:8001/api/lote');
    }

    public function eliminar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::delete("http://127.0.0.1:8001/api/lote/$identificador");
    }
    public function recuperar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/lote/$identificador");
    }


    public function redireccion(Request $request)
    {
        $accion = $request->input('accion');
        if ($accion == 'agregar') {
            $this->agregar($request);
        }
        if ($accion == 'eliminar') {
            $this->eliminar($request);
        }
        if ($accion == 'recuperar') {
            $this->recuperar($request);
        }
        $this->obtenerDatos();
        return redirect()->route('paquetes');
    }
}

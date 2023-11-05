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
        return redirect()->route('paquetesEnLote');
    }

    public function agregar($request)
    {
        $response=Http::post('http://127.0.0.1:8001/api/paquete-lote', [
            'id_lote' => $request->input('idLote'),
            'id_paquete' =>  $request->input('idPaquete'),
            'id_almacen' =>  $request->input('idAlmacen')
        ]);
        dd($response->json());
    }

    public function modificar($request)
    {
        $identificador = $request->input('identificador');
        $response= Http::put("http://127.0.0.1:8001/api/paquete-lote/$identificador", [
            'id_lote' => $request->input('idLote'),
            'id_paquete' =>  $request->input('idPaquete'),
            'id_almacen' =>  $request->input('idAlmacen')
        ]);
        dd($response->json());
    }

    public function eliminar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::delete("http://127.0.0.1:8001/api/paquete-lote/$identificador");
        dd($request->json());
    }
    public function recuperar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/paquete-lote/$identificador");
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
        return redirect()->route('paquetesEnLote');
    }
}

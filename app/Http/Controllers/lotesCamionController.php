<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class lotesCamionController extends Controller
{
    public function obtenerDatos()
    {
        $response = Http::get('http://127.0.0.1:8001/api/loteCamion');
        $data = $response->json();
        Session::put('camionLlevaLote', $data[0]);
        Session::put('matriculaCamiones', $data[1]);
        Session::put('idLotes', $data[2]);
        return redirect()->route('lotesCamion');
    }

    public function agregar($request)
    {
        $response=Http::post('http://127.0.0.1:8001/api/loteCamion', [
            'matricula' => $request->input('idCamion'),
            'id_lote' => $request->input('idLote'),
        ]);
        dd($response->json());
    }

    public function modificar($request)
    {
        $identificador = $request->input('identificador');
        $response= Http::put("http://127.0.0.1:8001/api/loteCamion/$identificador", [
            'matricula' => $request->input('idCamion'),
            'id_lote' => $request->input('idLote'),
        ]);
        dd($response->json());
    }

    public function eliminar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::delete("http://127.0.0.1:8001/api/loteCamion/$identificador");
        dd($request->json());
    }
    public function recuperar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/loteCamion/$identificador");
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
        return redirect()->route('lotesCamion');
    }
}

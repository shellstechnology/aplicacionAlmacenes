<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class paquetesController extends Controller
{
    public function obtenerDatos()
    {
        $response = Http::get('http://127.0.0.1:8001/api/paquete');
        $data = $response->json();
        Session::put('paquete', $data[0]);
        Session::put('descripcionCaracteristica', $data[1]);
        Session::put('idProductos', $data[2]);
        Session::put('idLugaresEntrega', $data[3]);
        Session::put('estadoPaquete', $data[4]);
    }

    public function agregar($request)
    {
        $response=Http::post('http://127.0.0.1:8001/api/paquete', [
            'nombre' => $request->input('nombrePaquete'),
            'volumen_l' => $request->input('volumen'),
            'peso_kg' => $request->input('peso'),
            'id_estado_p' => $request->input('estadoPaquete'),
            'id_caracteristica_paquete' => $request->input('caracteristica'),
            'id_producto' => $request->input('idProducto'),
            'nombre_destinatario' => $request->input('nombreRemitente'),
            'nombre_remitente' => $request->input('nombreDestinatario'),
            'direccion'=>$request->input('direccion'),
            'latitud'=>$request->input('longitud'),
            'longitud'=>$request->input('latitud'),
        ]);
    }

    public function modificar($request)
    {
        $identificador = $request->input('identificador');
        $response= Http::put("http://127.0.0.1:8001/api/paquete/$identificador", [
            'nombre' => $request->input('nombrePaquete'),
            'volumen_l' => $request->input('volumen'),
            'peso_kg' => $request->input('peso'),
            'id_estado_p' => $request->input('estadoPaquete'),
            'id_caracteristica_paquete' => $request->input('caracteristica'),
            'id_producto' => $request->input('idProducto'),
            'nombre_destinatario' => $request->input('nombreRemitente'),
            'nombre_remitente' => $request->input('nombreDestinatario'),
            'direccion'=>$request->input('direccion'),
            'latitud'=>$request->input('longitud'),
            'longitud'=>$request->input('latitud'),
        ]);
        
    }

    public function eliminar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::delete("http://127.0.0.1:8001/api/paquete/$identificador");
      
    }
    public function recuperar($request)
    {
        $identificador = $request->input('identificador');
        $request = Http::patch("http://127.0.0.1:8001/api/paquete/$identificador");
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
        return redirect()->route('paquetes');
    }
}

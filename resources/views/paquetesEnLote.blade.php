<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/styleAlmacenes.css">
<link rel="icon" href="img/Logo Aplicación.png">
<script src="{{asset('js/funciones.js')}}"> </script>
<title>Asignar Paquetes En Lote</title>
</head>

<body>
  <div class="principalBody">
    <div class="barraDeNavegacion">
    <a href="{{route('paquetes')}}" class="item"> Paquetes</a> 
      <a href="{{route('productos')}}" class="item"> Productos</a> 
      <div class="itemSeleccionado"> Paquetes En Lote</div> 
      <a  href="{{route('lotes')}}" class="item"> Lotes</a>
      <a  href="{{route('lotesCamion')}}" class="item"> Lotes En Camión</a>
    </div>
    <div class="container">
      <div class="cuerpo">
        <div id="contenedorTabla">
          <x-tabla-paquete-contiene-lote-component />
        </div>
      </div>
      <div class="cajaDatos">
      <form action="{{route('redireccion.paqueteLote')}}" method="POST">
        @csrf
        <fieldset>
               <legend>Selecciona una accion:</legend>
                 <div>
                  <input type="radio" id="agregar" name="accion" value="agregar" checked />
                  <label for="agregar">Agregar</label>
                 </div>
                 <div>
                   <input type="radio" id="modificar" name="accion" value="modificar" />
                   <label for="modificar">Modificar</label>
                </div>
                <div>
                 <input type="radio" id="eliminar" name="accion" value="eliminar" />
                 <label for="eliminar">Eliminar</label>
                </div>
                <div>
                 <input type="radio" id="recuperar" name="accion" value="recuperar" />
                 <label for="recuperar">Recuperar</label>
               </div >
             </fieldset>
       
       <div class="contenedorDatos">
       <div class="campo">
       <x-select-paquete-component/>
        </div>
       <div class="campo">
       <x-select-lote-component/>
        </div>
        <div class="campo">
        <x-select-almacenes-component/>
          </div>
          <div class="contenedorDatos">
          <input type="hidden" name="identificador" id="identificador"></input>
          <button type="submit" name="aceptar">Aceptar</button>
          </form>
         </div>
      <form action="{{route('paqueteLote.cargarDatos')}}" method="GET">
         @csrf
         <button type="submit" name="cargar" id="cargar">Cargar Datos</button>
       </form>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
</body>

</html>
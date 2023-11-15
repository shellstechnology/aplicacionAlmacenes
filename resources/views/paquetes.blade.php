<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/styleAlmacenes.css">
<link rel="icon" href="img/Logo Aplicación.png">
<script src="{{asset('js/funciones.js')}}"> </script>
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Paquetes</title>
</head>

<body>
  <div class="principalBody">
    <div class="barraDeNavegacion">
      <div class="itemSeleccionado"> Paquetes</div>
      <a href="{{route('productos')}}" class="item"> Productos</a> 
      <a href="{{route('paquetesEnLote')}}" class="item"> Paquetes En Lote</a> 
      <a  href="{{route('lotes')}}" class="item"> Lotes</a>
      <a  href="{{route('lotesCamion')}}" class="item"> Lotes En Camión</a>
    </div>
    <div class="container">
      <div class="cuerpo">
        <div id="contenedorTabla">
          <x-tabla-paquete-component />
        </div>
      </div>
      <div class="cajaDatos">

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
            </div>
          </fieldset>
          <div class="contenedorDatos">
            <div class="campo">
              <input type="text" name="nombrePaquete" id="nombrePaquete" maxlength="50"></input>
              <label for="nombrePaquete">Nombre del Paquete</label>
          </div>
          <div class="campo">
            <input type="text" id="direccion" name="direccion" maxlength="100" ></input>
           <label for="direccion" >Direccion</label>
          <div class="campo">
          <div class="campo">
            <input type="text" id="latitud" name="latitud" onkeydown="filtro(event)" 
                pattern="-?[0-9]*[.,]?[0-9]+" maxlength="16" >
          <label for="latitud" >Latitud</label>
            </div>
            <div class="campo">
            <input type="text" id="longitud" name="longitud" onkeydown="filtro(event)" 
                pattern="-?[0-9]*[.,]?[0-9]+" maxlength="16" >
          <label for="longitud" >Longitud</label>
          </div>
          <div id="map">
          </div>
          <div class="campo">
            <x-select-estado-paquete-component />
          </div>
          <div class="campo">
            <x-select-caracteristica-paquete-component />
          </div>
          <div class="campo">
            <input type="text" name="nombreRemitente" id="nombreRemitente" maxlength="40"></input>
            <label for="nombreRemitente">Nombre Remitente</label>
          </div>
          <div class="campo">
            <input type="text" name="nombreDestinatario" id="nombreDestinatario" maxlength="40"></input>
            <label for="nombreDestinatario">Nombre Destinatario</label>
          </div>
          <div class="campo">
            <x-select-producto-component />
          </div>
          <div class="campo">
            <input type="text" id="volumen" name="volumen" onkeydown="filtro(event)" pattern="[0-9]*[.,]?[0-9]+"
              maxlength="10">
            <label for="volumen">Volumen(L)</label>
          </div>
          <div class="campo">
            <input type="text" id="peso" name="peso" onkeydown="filtro(event)" pattern="[0-9]*[.,]?[0-9]+"
              maxlength="10">
            <label for="peso">Peso(Kg)</label>
          </div>
          <input type="hidden" name="identificador" id="identificador"></input>
          <button id="aceptar" type="submit" name="aceptar">Aceptar</button>
      

        <button id="cargarDatos" type="submit" name="cargar" id="cargar">Cargar Datos</button>

      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <script>
        $(document).ready(function(){
            var token = localStorage.getItem("accessTokenA");
            if(token == null)
            $(location).prop('href', '/login');

            $("#cargarDatos").click(function(){
                jQuery.ajax({  
                    url: '{{route('paquete.cargarDatos')}}',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenA"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/paquetes');
                    }
                    
                });  
            });


            $("#aceptar").click(function(){
              var accion = $("input[name='accion']:checked").val();
                var nombrePaquete = $("#nombrePaquete").val();
                var direccion = $("#direccion").val();
                var dia = $("#dia").val();
                var mes = $("#mes").val();
                var anio = $("#anio").val();
                var latitud = $("#latitud").val();
                var longitud = $("#longitud").val();
                var estadoPaquete = $("#estadoPaquete").val();
                var caracteristica = $("#caracteristica").val();
                var nombreRemitente = $("#nombreRemitente").val();
                var nombreDestinatario = $("#nombreDestinatario").val();
                var idProducto = $("#idProducto").val();
                var volumen = $("#volumen").val();
                var peso = $("#peso").val();
                var identificador = $("#identificador").val();
                
                
                var dataFormulario = {
                  "accion": accion,
                  "nombrePaquete": nombrePaquete,
                  "volumen": volumen,
                  "peso": peso,
                  "estadoPaquete": estadoPaquete,
                  "caracteristica": caracteristica,
                  "idProducto": idProducto,
                  "nombreRemitente": nombreRemitente,
                  "nombreDestinatario": nombreDestinatario,
                  "direccion": direccion,
                  "latitud": latitud,
                  "longitud": longitud,
                    "dia": dia,
                    "mes": mes,
                    "anio": anio,
                    "identificador": identificador,
                }
                console.log(dataFormulario);
                $.ajax({  
                    url: '{{route('redireccion.paquete')}}',  
                    method: 'POST',
                    async: true,
                    crossDomain: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenA"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    data: JSON.stringify(dataFormulario),
                    success: function(data) {  
                      alert(data);
                      $("#cargarDatos").click();
                      $("#cargarDatos").click(function(){
                jQuery.ajax({  
                    url: '{{route('paquete.cargarDatos')}}',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenA"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/paquetes');
                    }
                });  
            });
                    }
                    
                });  
            });
        });  
        </script>
</body>

</html>
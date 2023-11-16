<!DOCTYPE html> 
<html lang="en">
    <head> 
        <meta charset="UTF-8"> 
       <meta name="viewport" content="width=device-width,
        initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" 
        content="ie=edge">
        <link rel="stylesheet" href="css/styleAlmacenes.css">
        <link rel="icon" href="img/Logo Aplicación.png"> <title>Productos</title> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
    <div class="principalBody">
    <button class="cerrarSesion" id="cerrarSesion">
        <div class="rectangulo">
            <div class="linea">
                <div class="triangulo"></div>
            </div>
        </div>
</button>
        <div class="barraDeNavegacion">
           <a href="{{route('paquetes')}}" class="item"> Paquetes</a> 
           <a href="{{route('productos')}}" class="item"> Productos</a> 
           <a href="{{route('paquetesEnLote')}}" class="item"> Paquetes En Lote</a> 
            <div class="itemSeleccionado"> Lotes</div>
            <a  href="{{route('lotesCamion')}}" class="item"> Lotes En Camión</a>
        </div>
        <div class="container">
            <div class="cuerpo">
                <div id="contenedorTabla">
                    <x-tabla-lote-component />
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
                 <input type="radio" id="eliminar" name="accion" value="eliminar" />
                 <label for="eliminar">Eliminar</label>
                </div>
                <div>
                 <input type="radio" id="recuperar" name="accion" value="recuperar" />
                 <label for="recuperar">Recuperar</label>
               </div >
             </fieldset>
        <div class="contenedorDatos">
         <input type="hidden" name="identificador" id="identificador">
         <button id="aceptar" type="submit" name="aceptar">Aceptar</button>
      </div>


         <button id="cargarDatos" type="submit" name="cargar">Cargar Datos</button>

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
                    url: '{{route('lote.cargarDatos')}}',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenA"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/lotes');
                    }
                    
                });  
            });

            $("#aceptar").click(function(){
              var accion = $("input[name='accion']:checked").val();
                var identificador = $("#identificador").val();
                var dataFormulario = {
                   "accion": accion,
                   "identificador": identificador,

                }
                console.log(dataFormulario);

                $.ajax({  
                    url: '{{route('redireccion.lote')}}',  
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
                    url: '{{route('lote.cargarDatos')}}',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenA"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/productos');
                    }
                });  
            });
                    }
                    
                });  
            });
            $("#cerrarSesion").click(function(){
                jQuery.ajax({  
                    url: 'http://localhost:8002/api/v1/logout',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenA"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        localStorage.removeItem("accessTokenA");
                        $(location).prop('href', '/login');
                    }
                    
                });  
            });
        });  
        </script>
</body>
</html>
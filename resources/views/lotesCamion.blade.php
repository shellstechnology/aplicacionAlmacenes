<!DOCTYPE html> 
<html lang="en">
    <head> 
        <meta charset="UTF-8"> 
       <meta name="viewport" content="width=device-width,
        initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" 
        content="ie=edge">
        <link rel="stylesheet" href="css/styleAlmacenes.css">
        <link rel="icon" href="img/Logo Aplicación.png"> <title>Lotes en camion</title> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
    <div class="principalBody">
        <div class="barraDeNavegacion">

          <a href="{{route('paquetes')}}" class="item"> Paquetes</a> 
          <a href="{{route('productos')}}" class="item"> Productos</a> 
          <a href="{{route('paquetesEnLote')}}" class="item"> Paquetes En Lote</a> 
          <a  href="{{route('lotes')}}" class="item"> Lotes</a>
          <div class="itemSeleccionado"> Lotes En Camión</div>
        </div>
        <div class="container">
            <div class="cuerpo">
                <div id="contenedorTabla">
                    <x-tabla-camion-lleva-lote-component />
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
               </div >
             </fieldset>
        <div class="contenedorDatos">
        <x-select-camiones-component/>
         </div>
         <div class="contenedorDatos">
        <x-select-lote-component/>
         </div>
          <div class="contenedorDatos">
          <input type="hidden" name="identificador" id="identificador">
          <button id="aceptar" type="submit" name="aceptar">Aceptar</button>
        </div>
    

         <button id="cargarDatos" type="submit" name="cargar" id="cargar">Cargar Datos</button>

    </div>
    </div>
    </div>
    <script>
        $(document).ready(function(){
            var token = localStorage.getItem("accessToken");
            if(token == null)
            $(location).prop('href', '/login');
            
            $("#cargarDatos").click(function(){
                jQuery.ajax({  
                    url: '{{route('loteCamion.cargarDatos')}}',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessToken"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/lotesCamion');
                    }
                    
                });  
            });

            $("#aceptar").click(function(){
              var accion = $("input[name='accion']:checked").val();
                var idCamion = $("#idCamion").val();
                var idLote = $("#idLote").val();
                var identificador = $("#identificador").val();
                var dataFormulario = {
                   "accion": accion,
                   "identificador": identificador,
                    "idCamion": idCamion,
                    "idLote": idLote,


                }
                console.log(dataFormulario);

                $.ajax({  
                    url: '{{route('redireccion.loteCamion')}}',  
                    method: 'POST',
                    async: true,
                    crossDomain: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization" : "Bearer " + localStorage.getItem("accessToken"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    data: JSON.stringify(dataFormulario),
                    success: function(data) {  
                      $("#cargarDatos").click();
                      $("#cargarDatos").click(function(){
                jQuery.ajax({  
                    url: '{{route('loteCamion.cargarDatos')}}',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessToken"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/lotesCamion');
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
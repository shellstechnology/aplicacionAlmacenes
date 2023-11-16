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
    <div class="principalBody">
        <div class="barraDeNavegacion">

          <a href="{{route('paquetes')}}" class="item"> Paquetes</a> 
          <div class="itemSeleccionado"> Productos</div>
          <a href="{{route('paquetesEnLote')}}" class="item"> Paquetes En Lote</a> 
          <a  href="{{route('lotes')}}" class="item"> Lotes</a>
          <a  href="{{route('lotesCamion')}}" class="item"> Lotes En Camión</a>
        </div>
        <div class="container">
            <div class="cuerpo">
                <div id="contenedorTabla">
                    <x-tabla-productos-component />
                </div>
            </div>
            <div class="cajaDatos">

          <fieldset>
               <legend>Selecciona una accion:</legend>
                 <div>
                  <input class="accion" type="radio" id="agregar" name="accion" value="agregar" checked />
                  <label for="agregar">Agregar</label>
                 </div>
                 <div>
                   <input class="accion" type="radio" id="modificar" name="accion" value="modificar" />
                   <label for="modificar">Modificar</label>
                </div>
                <div>
                 <input class="accion" type="radio" id="eliminar" name="accion" value="eliminar" />
                 <label for="eliminar">Eliminar</label>
                </div>
                <div>
                 <input class="accion" type="radio" id="recuperar" name="accion" value="recuperar" />
                 <label for="recuperar">Recuperar</label>
               </div >
             </fieldset>
          <div class="contenedorDatos">
            <div class="campo">
            <input type="text" id="nombre" name="nombre" maxlength="50" ></input>
            <label for="nombreProducto" >Nombre</label>
          </div>
          <div class="campo">
          <input type="text" id="precio" name="precio" onkeydown="filtro(event)" 
                pattern="-?[0-9]*[.,]?[0-9]+" maxlength="16" >
            <label for="precioProducto" >Precio </label>
          </div>
          <div class="campo">
          <x-select-moneda-component/>
          </div>
          <div class="campo">
            <input type="number" id="stock" name="stock" min="0" max="999999" onkeydown="filtro(event)" 
            onpaste="return false"; ></input>
            <label for="stockProducto" >Stock</label>
            <input type="hidden" name="producto"> </input>
            <input type="hidden" name="identificador" id="identificador"> </input>
          </div>
          <div class="campo">
          <button id="aceptar" type="submit">Aceptar</button>
          </div>
       
       </div>

         <button id="cargarDatos" type="submit" name="cargar" id="cargar">Cargar Datos</button>

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
                    url: '{{route('productos.cargarDatos')}}',  
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

            $("#aceptar").click(function(){
              var accion = $("input[name='accion']:checked").val();
                var nombre = $("#nombre").val();
                var precio = $("#precio").val();
                var stock = $("#stock").val();
                var moneda = $("#tipoMoneda").val();
                var identificador = $("#identificador").val();
                var dataFormulario = {
                   "accion": accion,
                   "identificador": identificador,
                    "nombre": nombre,
                    "precio": precio,
                    "stock": stock,
                    "tipoMoneda": moneda,

                }
                console.log(dataFormulario);

                $.ajax({  
                    url: '{{route('redireccion.producto')}}',  
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
                    url: '{{route('productos.cargarDatos')}}',  
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
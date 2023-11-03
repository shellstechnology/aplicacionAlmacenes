<!DOCTYPE html> 
<html lang="en">
    <head> 
        <meta charset="UTF-8"> 
       <meta name="viewport" content="width=device-width,
        initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" 
        content="ie=edge">
        <link rel="stylesheet" href="css/styleAlmacenes.css">
        <link rel="icon" href="img/Logo Aplicación.png"> <title>Productos</title> 
    </head>
    <body>
    <div class="principalBody">
        <div class="barraDeNavegacion">

           <a href="{{route('paquetes')}}" class="item"> Paquetes</a> 
            <div class="itemSeleccionado"> Productos</div>
            <div class="item"> Lotes</div>
            <div class="item"> Lotes En Camión</div>
        </div>
        <div class="container">
            <div class="cuerpo">
                <div id="contenedorTabla">
                    <x-tabla-productos-component />
                </div>
            </div>
            <div class="cajaDatos">
            <form action="{{route('redireccion.producto')}}" method="POST">
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
            <input type="text" id="nombre" name="nombre" maxlength="50" ></input>
            <label for="nombreProducto" >Nombre</label>
          </div>
          <div class="campo">
            <input type="number" id="precio" name="precio" min="1" max="99999999" onkeydown="filtro(event)" 
              oninput="limitarInput(this, 7)" onpaste="return false" ></input>
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
          <button type="submit">Aceptar</button>
          </div>
        </form>
       </div>
       <form action="{{route('productos.cargarDatos')}}" method="GET">
         @csrf
         <button type="submit" name="cargar" id="cargar">Cargar Datos</button>
       </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/styleAlmacenes.css">
<link rel="icon" href="img/Logo Aplicación.png">
<title>Almacenes</title>
</head>

<body>
    <div class="principalBody">

        <div class="barraDeNavegacion">

            <div class="item"> Paquetes</div>
            <div class="item"> Productos</div>
            <div class="item"> Lotes</div>
            <div class="item"> Lotes En Camión</div>

        </div>
        <div class="container">
            <div class="cuerpo">
                <div id="contenedorTabla">
                    <x-tabla-productos-component />
                </div>
            </div>
            <div>
                <div class="cajaDatos">
                    <input type="checkbox" id="cbxAgregar">Agregar</input>
                    <input type="checkbox" id="cbxModificar">Modificar </input>
                    <input type="checkbox" id="cbxEliminar">Eliminar </input>
                    <div class="contenedorDatos">
                        <div class="campo">
                            <input type="text" id="nombre" maxlength="20" onpaste="return false;"
                                placeholder="Nombre del producto:"></input>

                        </div>
                        <div class="campo">
                            <input type="number" id="precio" min="1" max="9999999" onkeydown="filtro(event)"
                                onpaste="return false" ; placeholder="Precio:"></input>

                        </div>
                        <div class="campo">
                            <input type="text" id="tipoMoneda" maxlength="3" onpaste="return false;"
                                placeholder="Tipo de Moneda:"></input>

                        </div>
                        <div class="campo">
                            <input type="number" id="stock" min="0" max="9999999" onkeydown="filtro(event) onpaste="
                                return false;" placeholder="Stock del Producto:"></input>

                        </div><br>
                        <button>Cargar Tabla</button><br>
                        <button>Aceptar</button><br>
                        <button>Reestablecer Dato</button><br>
                        <form action="{{route('productos.cargarDatos')}}" method="GET">
                            @csrf
                            <button type="submit" name="cargar" id="cargar">Cargar Datos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
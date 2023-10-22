<!DOCTYPE html>
<html lang="en">
<head>
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
                    <table>
                        <thead>
                            <th>Id Almacenes</th>
                            <th>Direccion Almacen</th>
                            <th>Lat. Almacen</th>
                            <th>Lng. Almacen</th>
                            <th>Fecha de creación</th>
                            <th>Ultima Actualización</th>
                            <th>Fecha de borrado</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>1023 Perez</th>
                                <th>423</th>
                                <th>456</th>
                                <th></th>
                                <th>2023-07-12 05:34:45</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>2031 Dominguez</th>
                                <th>100</th>
                                <th>600</th>
                                <th></th>
                                <th>2023-07-20 10:34:45</th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div class="cajaDatos">
                    <input type="checkbox" id="cbxAgregar">Agregar</input>
                    <input type="checkbox" id="cbxModificar">Modificar </input>
                    <input type="checkbox" id="cbxEliminar">Eliminar </input>
                    <div class="contenedorDatos">
                        <div class="campo">
                            <input type="text" id="nombre" maxlength="20" onpaste="return false;" placeholder="Nombre del producto:"></input>

                        </div>
                        <div class="campo">
                            <input type="number" id="precio" min="1" max="9999999" onkeydown="filtro(event)" onpaste="return false" ; placeholder="Precio:"></input>

                        </div>
                        <div class="campo">
                            <input type="text" id="tipoMoneda" maxlength="3" onpaste="return false;" placeholder="Tipo de Moneda:"></input>

                        </div>
                        <div class="campo">
                            <input type="number" id="stock" min="0" max="9999999" onkeydown="filtro(event) onpaste=" return false;" placeholder="Stock del Producto:"></input>

                        </div><br>
                        <button>Cargar Tabla</button><br>
                        <button>Aceptar</button><br>
                        <button>Reestablecer Dato</button><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

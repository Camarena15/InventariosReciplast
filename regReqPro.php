<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Requisición de Productos</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM requisicionesproductos WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdRequisicion" class="form-label">Id Requisición: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdRequisicion"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <!-- SELECT DE NOMBRES -->
                <?php
          $consulta = "SELECT IdEmpleado, Nombre FROM empleados WHERE Estado = 'Activo' Order By Nombre ASC";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
                <label for="inputCp" class="form-label">Empleado que solicita: </label>
                <select type="text" class="form-control" id="NombreEmpleado">
                    <option value="0">Seleccione un empleado</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdEmpleado'] ?>"><?php echo $opciones['Nombre'] ?></option>

                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-md-2" id="IdEmpleado">
                <!-- SCRIPT PARA EL ID EMPLEADO-->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#NombreEmpleado').val(0);
                    recargar();

                    $('#NombreEmpleado').change(function() {
                        recargar();
                    });
                })
                </script>
                <script type="text/javascript">
                function recargar() {
                    $.ajax({
                        type: "POST",
                        url: "bd/getIdEmpleado.php",
                        data: "empleado=" + $('#NombreEmpleado').val(),
                        success: function(r) {
                            $('#IdEmpleado').html(r);
                        }
                    });
                }
                </script>

            </div>
            <div class="form-group col-3">
                <label for="" class="form-label">Fecha: </label>
                <input type="date" class="form-control" id="Fecha">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <!-- SELECT PARA EL PRODUCTO -->
                <?php
          $consulta = "SELECT IdProducto, Descripcion FROM productos Order By Descripcion ASC";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
                <label for="inputAddress2" class="form-label">Descripción del producto: </label>
                <select type="number" class="form-control" id="DescripcionProducto" name="dp">
                    <option value="0">Seleccione un producto</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdProducto'] ?>"><?php echo $opciones['Descripcion'] ?>
                    </option>

                    <?php endforeach ?>
                </select>
                </select>
            </div>
            <div class="form-group col-md-2" id="IdProducto">
                <!-- SCRIPT PARA EL ID PRODUCTO -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#DescripcionProducto').val(0);
                    reca();

                    $('#DescripcionProducto').change(function() {
                        reca();
                    });
                })
                </script>
                <script type="text/javascript">
                function reca() {
                    $.ajax({
                        type: "POST",
                        url: "bd/getIdProducto.php",
                        data: "prod=" + $('#DescripcionProducto').val(),
                        success: function(r) {
                            $('#IdProducto').html(r);
                        }
                    });
                }
                </script>
                <label for="inputTel" class="form-label">Id Producto: </label>
                <input type="text" class="form-control" id="IdProducto" placeholder="1" readonly
                    onmousedown="return false;">
            </div>
            <div class="form-group col-md-2" id="Cost">
                <!-- SCRIPT PARA EL COSTO -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#DescripcionProducto').val(0);
                    rec();

                    $('#DescripcionProducto').change(function() {
                        rec();
                    });
                })
                </script>
                <script type="text/javascript">
                function rec() {
                    $.ajax({
                        type: "POST",
                        url: "bd/getCosto.php",
                        data: "costo=" + $('#DescripcionProducto').val(),
                        success: function(r) {
                            $('#Cost').html(r);
                        }
                    });
                }
                </script>
            </div>
            <div class="form-group col-md-2">
                <label for="" class="form-label">Cantidad: </label>
                <input type="number" class="form-control" id="Cantidad" min="0" step=".01">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-danger" onclick="validar()">Agregar</button>
            </div>
        </div>
</form>


<br></br>
<div class="container text-center">
    <h5>Productos registrados para la requisición</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Movimiento</th>
                <th scope="col">Descripcion</th>
                <th scope="col">IdProducto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Unitario</th>
                <th scope="col">Importe</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="col-2">
        <button type="button" class="btn btn-success" onclick="validarTodo()">Registrar</button>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-3">
            <label for="" class="form-label">Total Aproximado: </label>
            <input type="number" class="form-control" id="TotalAprox" step=".01">
        </div>
    </div>
</div>

<!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
<script>
function validar() {
    var idproducto, desc, cant, precio;
    idproducto = document.getElementById('IdProd').value;
    desc = document.getElementById('DescripcionProducto').textContent;
    cant = document.getElementById('Cantidad').value;
    precio = document.getElementById('Precio').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (idproducto == '' || desc == '' || cant == '' || precio == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarTabla();
}
var cont = 0;
function calcularCosto(){
    var totalAprox = 0;
    var arregloId = new Array();
    let celdasId = $('#tbodydatos tr td');
    for (let i = 0; i < celdasId.length; i+=6) {
        totalAprox += Number(celdasId[i+5].firstChild.data);
    }
    document.getElementById("TotalAprox").value = Number.parseFloat(totalAprox).toFixed(2);
}
function registrarTabla() {
    var combo = document.getElementById("DescripcionProducto");
    var selected = combo.options[combo.selectedIndex].text;
    var cantidad = $("#Cantidad").val();
    var idProducto = $("#IdProd").val();
    var precio = $("#Precio").val();

    var id = "";
    var cantidad1 = 0;
    var precio1 = 0;

    var encontrado = false;

    $("#tablaProductos tbody tr").each(function(i, e) {
        var tr = $(e);
        var td = $(e).find("td").eq(1);

        id = $(td).find("input").eq(1).val();
        cantidad1 = $(td).find("input").eq(2).val();
        precio1 = $(td).find("input").eq(3).val();

        var fila = "";

        if (id == idProducto) {
            // si se encontró un ID: encontrado!
            encontrado = true;

            var tcan = parseFloat(cantidad) + parseFloat(cantidad1);
            var tpre = parseFloat(precio);

            tr.remove();
            cont++;
            fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont +
                '</td><td><input type="hidden" value="' + selected + '"><input type="hidden" value="' +
                idProducto + '"><input type="hidden" value="' + tcan + '"><input type="hidden" value="' + tpre +
                '">' + selected + '</td><td>' + idProducto + '</td><td>' + Number.parseFloat(tcan).toFixed(2) + '</td><td>' + Number.parseFloat(tpre).toFixed(2) +
                '</td><td>' + Number.parseFloat(tcan*tpre).toFixed(2) + '</td></tr>';
            $('#tbodydatos').append(fila);
            calcularCosto();
            return false;
        }
    });
    // si es el primer elemento o no se encontró ID, se añade una neuva fila
    // código de arriba movido aquí cambiando un poco la condición
    // realmente el `cont == 0` ya no hace falta, porque si la tabla está vacía encontrado será false
    if (cont == 0 || !encontrado) {
        cont++;
        fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont + '</td><td><input type="hidden" value="' +
            selected + '"><input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + cantidad +
            '"><input type="hidden" value="' + precio + '">' + selected + '</td><td>' + idProducto + '</td><td>' +
            Number.parseFloat(cantidad).toFixed(2) + '</td><td>' + Number.parseFloat(precio).toFixed(2) + '</td><td>' + Number.parseFloat(cantidad*precio).toFixed(2) + '</td></tr>';
        $('#tbodydatos').append(fila);
        calcularCosto();
        return;
    }
}
</script>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
    var idproducto, descu, canti, pre, IdRequisicion, descEquipo, descProgra, idprogra, nombre, idempleado, descmantto,
        fecha1, fecha2;
    try{
        idproducto = document.getElementById('IdProd').value;
        pre = document.getElementById('Precio').value;
    }catch(e){
        idproducto = "";
        pre = "";
    }
    descu = document.getElementById('DescripcionProducto').value;
    canti = document.getElementById('Cantidad').value;
    nombre = document.getElementById('NombreEmpleado').value;
    idempleado = document.getElementById('IdEmpleado').value;
    Fecha = document.getElementById('Fecha').value;
    IdRequisicion = document.getElementById('IdRequisicion').value;
    TotAprox = document.getElementById('TotalAprox').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (idproducto == '' || descu == '' || canti == '' || pre == '' || nombre == '' || idempleado == '' || Fecha == '' || IdRequisicion == '' 
    || TotalAprox == 0) {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarReqPro();
}

function registrarReqPro() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 6; ++i) {
        arregloId[c] = celdasId[c].firstChild.data;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.data;
        arregloId[c + 4] = celdasId[c + 4].firstChild.data;
        arregloId[c + 5] = celdasId[c + 5].firstChild.data;
        c += 6;
    }
    let IdRequisicion, IdEmpleadoSolicita, Fecha, TotalAprox;
    $(document).ready(function() {
        IdRequisicion = $.trim($("#IdRequisicion").val());
        console.log(IdRequisicion);
        IdEmpleadoSolicita = $.trim($("#NombreEmpleado").val());
        console.log(IdEmpleadoSolicita);
        Fecha = $.trim($("#Fecha").val());
        console.log(Fecha);
        TotalAprox = $.trim($("#TotalAprox").val());
        console.log(TotalAprox);
        opcion = 1;
        $.ajax({
            url: "bd/ReqPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdRequisicion: IdRequisicion,
                IdEmpleadoSolicita: IdEmpleadoSolicita,
                Fecha: Fecha,
                TotalAprox: TotalAprox,
                'arregloId': JSON.stringify(arregloId)
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Requisición de Productos Registrada',
                    showConfirmButton: false,
                    footer: '<a href = "consReqPro.php">Ir a consultar</a>'
                })

            }
        });
    });

}
</script>

<br>
<br>
<div row>
    <div class="d-flex justify-content-center">
        <!-- FIN del contenido principal -->
    </div>
</div>
<?php require_once "vistas/parte_inf.php"?>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
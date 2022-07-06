<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Vales Consumibles</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM valesconsumibles WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdRequisicion" class="form-label">Id Vale: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdValeCons"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <!-- SELECT DE NOMBRES -->
                <?php
            $consulta = "SELECT IdEmpleado, Nombre FROM empleados Order By Nombre ASC";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();  
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <label for="inputCp" class="form-label">Empleado que recibe: </label>
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
                <label for="" class="form-label">Fecha de Surtido: </label>
                <input type="date" class="form-control" id="FechaSurte">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="inputTel" class="form-label">Motivo: </label>
                <textarea type="text" class="form-control" id="Motivo" cols="20" rows="5" maxlength="200"></textarea>
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
                    $.ajax({
                        type: "POST",
                        url: "bd/getCantidadSur.php",
                        data: "IdProducto=" + $('#DescripcionProducto').val(),
                        success: function(r) {
                            $('#CantidadS').html(r);
                        }
                    });
                }
                </script>
                <label for="inputTel" class="form-label">Id Producto: </label>
                <input type="text" class="form-control" id="IdProducto" placeholder="1" readonly
                    onmousedown="return false;">
            </div>
            <div class="form-group col-md-2">
                <label for="" class="form-label">Cantidad Solicitada: </label>
                <input type="number" class="form-control" id="Cantidad" min="0" step=".01">
            </div>
            <div class="form-group col-md-2">
                <div id="CantidadS"></div>
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
    <h5>Productos en Vale Consumible Registrados</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Movimiento<br>-</th>
                <th scope="col">Descripción<br>-</th>
                <th scope="col">IdProducto<br>-</th>
                <th scope="col">Cantidad Solicitada<BR>-</BR></th>
                <th scope="col">Cantidad Surtida<br>-</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-success" onclick="validarTodo()">Registrar</button>
        </div>
    </div>
</div>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
    var IdEmpleadoRecibe, FechaEmision, FechaSurte, Motivo;
    IdEmpleadoRecibe = document.getElementById("NombreEmpleado").value;
    FechaSurte = document.getElementById("FechaSurte").value;
    Motivo = document.getElementById("Motivo").value;
    exp = /\w+@\w+\.+[a-z]/;

    if ( IdEmpleadoRecibe == 0 || FechaSurte == '' || Motivo == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    regVale();
}

function regVale() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 5; ++i) {
        arregloId[c] = celdasId[c].firstChild.data;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.data;
        arregloId[c + 4] = celdasId[c + 4].firstChild.data;
        c += 5;
    }
    let IdValeCons, IdEmpleadoRecibe, Motivo, FechaEmision, FechaSurte, Subtotal, Iva, Total, Saldo;
    $(document).ready(function() {
        IdValeCons = $.trim($("#IdValeCons").val());
        IdEmpleadoRecibe = $.trim($("#NombreEmpleado").val());
        Motivo = $.trim($("#Motivo").val());
        FechaEmision = $.trim($("#FechaEmision").val());
        FechaSurte = $.trim($("#FechaSurte").val());
        opcion = 1;
        $.ajax({
            url: "bd/ValesCons.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdValeCons: IdValeCons,
                IdEmpleadoRecibe: IdEmpleadoRecibe,
                FechaSurte: FechaSurte,
                Motivo: Motivo,
                'arregloId': JSON.stringify(arregloId)
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Vale Consumible Registrado',
                    showConfirmButton: false,
                    footer: '<a href = "consValeCons.php">Ir a consultar</a>'
                })

            }
        });
    });

}

function validar() {
    var idproducto, desc, cant, precio, max;
    idproducto = document.getElementById('IdProd').value;
    desc = document.getElementById('DescripcionProducto').textContent;
    cant = document.getElementById('Cantidad').value;
    cants = document.getElementById('CantidadSurtida').value;
    max = document.getElementById("CantidadSurtida").max;
    exp = /\w+@\w+\.+[a-z]/;

    if (idproducto == '' || desc == '' || cant == '' || cants == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    if(cants > max){
        alert("La cantidad surtida no puede ser mayor a la existente en almacén. Actualmente hay: " + max);
        return false;
    }

    registrarTabla();
}
var cont = 0;
function registrarTabla() {
    var combo = document.getElementById("DescripcionProducto");
    var selected = combo.options[combo.selectedIndex].text;
    var cantidad = $("#Cantidad").val();
    var cantidads = $("#CantidadSurtida").val();
    var idProducto = $("#IdProd").val();

    var id = "";
    var cantidad1 = 0;
    var cantidads1 = 0;

    var encontrado = false;

    $("#tablaProductos tbody tr").each(function(i, e) {
        var tr = $(e);
        var td = $(e).find("td").eq(1);

        id = $(td).find("input").eq(1).val();
        cantidad1 = $(td).find("input").eq(2).val();
        cantidads1 = $(td).find("input").eq(3).val();

        var fila = "";

        if (id == idProducto) {
            // si se encontró un ID: encontrado!
            encontrado = true;

            var tcan = parseFloat(cantidad) + parseFloat(cantidad1);
            var tcans = parseFloat(cantidads) + parseFloat(cantidads1);

            tr.remove();
            cont++;
            fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont +
                '</td><td><input type="hidden" value="' + selected + '"><input type="hidden" value="' +
                idProducto + '"><input type="hidden" value="' + tcan + '"><input type="hidden" value="' + tcans +
                '">' + selected + '</td><td>' + idProducto + '</td><td>' + Number.parseFloat(tcan).toFixed(2) + '</td><td>' + Number.parseFloat(tcans).toFixed(2) +
                '</td></tr>';
            $('#tbodydatos').append(fila);
        }
    });
    // si es el primer elemento o no se encontró ID, se añade una neuva fila
    // código de arriba movido aquí cambiando un poco la condición
    // realmente el `cont == 0` ya no hace falta, porque si la tabla está vacía encontrado será false
    if (cont == 0 || !encontrado) {
        cont++;
        fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont + '</td><td><input type="hidden" value="' +
            selected + '"><input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + cantidad +
            '"><input type="hidden" value="' + cantidads + '">' + selected + '</td><td>' + idProducto + '</td><td>' +
            Number.parseFloat(cantidad).toFixed(2) + '</td><td>' + Number.parseFloat(cantidads).toFixed(2) + '</td></tr>';
        $('#tbodydatos').append(fila);
    }
    $("#Cantidad").val('');
    $("#CantidadSurtida").val(0);
    $("#DescripcionProducto").prop('selectedIndex', 0);
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
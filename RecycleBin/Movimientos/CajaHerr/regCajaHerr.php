<?php require_once "../../../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Caja de Herramientas</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM cajaherramientas WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdCaja" class="form-label">Id-Caja Herramientas: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdCaja"
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
                <label for="inputCp" class="form-label">Nombre Empleado: </label>
                <select type="text" class="form-control" id="IdEm">
                    <option value="0">Seleccione un empleado</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdEmpleado'] ?>"><?php echo $opciones['Nombre'] ?></option>

                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="" class="form-label">Fecha Asignación: </label>
                <input type="date" class="form-control" id="Fecha">
            </div>
        </div>
        <hr>
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
                        url: "getIdProducto.php",
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
            <div class="form-group col-md-2" id="Existencia">
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
                        url: "getExistencia.php",
                        data: "existencia=" + $('#DescripcionProducto').val(),
                        success: function(r) {
                            $('#Cantidad').attr('max', r);
                        }
                    });
                }
                </script>
                <div class="form-group">
                    <label for="" class="form-label">Cantidad: </label>
                    <input type="number" class="form-control" id="Cantidad">
                </div>
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
    <h5>Productos en Cajas de Herramientas Registradas</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Movimiento</th>
                <th scope="col">IdProducto</th>
                <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="col-2">
        <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
    </div>
</div>

<!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
<script>
function validar() {
    var idproducto, cant;
    idproducto = document.getElementById('IdProd').value;
    cant = document.getElementById('Cantidad').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (idproducto == '' || cant == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarTabla();
}
var cont = 0;

function registrarTabla() {
    var cantidad = $("#Cantidad").val();
    var idProducto = $("#IdProd").val();
    var id = "";
    var cantidad1 = 0;

    var encontrado = false;

    $("#tablaProductos tbody tr").each(function(i, e) {
        var tr = $(e);
        id = $(e).find("td").eq(1).text();
        cantidad1 = $(e).find("td").eq(2).text();
        var fila = "";

        if (id == idProducto) {
            // si se encontró un ID: encontrado!
            encontrado = true;
            var tcan = parseFloat(cantidad) + parseFloat(cantidad1);
            tr.remove();
            cont++;
            fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont +'</td>' +
            '<input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + tcan + '">' +
            '<td id="idp">' + idProducto + '</td><td>' +
            tcan + '</td></tr>';
            $('#tbodydatos').append(fila);
            return false;
        }
    });
    // si es el primer elemento o no se encontró ID, se añade una neuva fila
    // código de arriba movido aquí cambiando un poco la condición
    // realmente el `cont == 0` ya no hace falta, porque si la tabla está vacía encontrado será false
    if (cont == 0 || !encontrado) {
        cont++;
        fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont + '</td>' + 
        '<input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + cantidad + '">' +
        '<td id="idp">' + idProducto + '</td><td>' +
            cantidad + '</td></tr>';
        $('#tbodydatos').append(fila);
        return;
    }
}
</script>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
        var idEmpleado, nombre, fecha, IdProducto, descripcion, cantidad, IdCaja;
        fecha=document.getElementById('Fecha').value;
        IdProducto=document.getElementById('IdProducto').value;
        descripcion = $('#DescripcionProducto option:selected').text();
        idEmpleado = document.getElementById('IdEm').value;
        nombre = $('#IdEm option:selected').text();
        cantidad=document.getElementById('Cantidad').value;
        IdCaja=document.getElementById('IdCaja').value;
        exp=/\w+@\w+\.+[a-z]/;

    if (IdCaja == '' || fecha == '' || IdProducto == '' || descripcion == '' || nombre == '' || idEmpleado == '' || cantidad == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarOrdenInt();
}

function registrarOrdenInt() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('td');
    let k = 0;
    let j = 0;
    for (let i = 0; i < celdasId.length; i++) {
        k++;
        if (k != 1){
            arregloId[j] = celdasId[i].firstChild.data;
            j++;
        } 
        if (k == 3) {
            k=0;
        }   
    }
    for (let i = 0; i < arregloId.length; i++){
        console.log(arregloId[i]);
    }
    let IdCaja, idempleado, fechaA;
    $(document).ready(function() {
        IdCaja = $.trim($("#IdCaja").val());
        console.log(IdCaja);
        idempleado = $.trim($("#IdEm").val());
        console.log(idempleado);
        fechaA = $.trim($("#Fecha").val());
        console.log(fechaA);
        opcion = 1;
        $.ajax({
            url: "CajaHerr.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdCaja: IdCaja,
                idempleado: idempleado,
                fechaA: fechaA,
                'arregloId': JSON.stringify(arregloId)
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Caja de Herramientas Registrada',
                    showConfirmButton: false,
                    footer: '<a href = "consCajaHerr.php">Ir a consultar</a>'
                })

            }
        });
    });
}
</script>




<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<br>
<br>
<div row>
    <div class="d-flex justify-content-center">
        <!-- FIN del contenido principal -->
        <?php require_once "../../../vistas/parte_inf.php"?>
    </div>
</div>
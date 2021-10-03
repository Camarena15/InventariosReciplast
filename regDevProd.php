<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Devolución de Productos <br> de Vales Consumibles</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM devprodvale WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdDevolucion" class="form-label">Id-Devolución: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdDevolucion"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group col-md-4">
                <!-- SELECT DE NOMBRES -->
                <?php
                    $consulta = "SELECT DISTINCT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON 
                    R.IdEmpleadoSolicita = E.IdEmpleado INNER JOIN  `detallerequisicionproductos` AS D ON D.IdRequisicion = R.IdRequisicion 
                    WHERE D.CantidadSurtida > 0 AND D.CantidadSurtida <> D.CantidadDevuelta";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();  
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                <label for="inputCp" class="form-label">Seleccionar Requisición: (sólo requisiciones surtidas)</label>
                <select type="text" class="form-control" id="Requisicion">
                    <option value="0">Seleccione una requisición</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdRequisicion'] ?>"><?php echo $opciones['IdRequisicion'] ?> ->
                        <?php echo $opciones['Nombre']?> (<?php echo $opciones['Fecha']?>)</option>

                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="" class="form-label"> <br> Fecha: </label>
                <input type="date" class="form-control" id="Fecha">
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#Requisicion').val(0);
            getDatosReq();

            $('#Requisicion').change(function() {
                getDatosReq();
            });
        })
        </script>
        <script type="text/javascript">
        function getDatosReq() {
            $.ajax({
                type: "POST",
                url: "bd/getDatosReq.php",
                data: "requisicion=" + $('#Requisicion').val(),
                success: function(r) {
                    $('#DatosRequisicion').html(r);
                }
            });
            $.ajax({
                type: "POST",
                url: "bd/getDetReq3.php",
                data: "requisicion=" + $('#Requisicion').val(),
                success: function(r) {
                    $('#tbodydatos').html(r);
                }
            });
        }
        </script>

        <div id="DatosRequisicion"></div>
        <hr>
</form>


<br></br>
<div class="container text-left">
    <h6 style="color: red;">(Seleccione únicamente los productos que <br> se devolverán)</h6>
</div>
<div class="container text-center">
    <h5>Productos Devueltos Registrados</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Seleccionar</th>
                <th scope="col">IdProducto</th>
                <th scope="col">Cantidad Surtida</th>
                <th scope="col">Cantidad a Devolver</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="col-2">
        <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
    </div>
</div>

<!-- VALIDAR TODO -->
<script>
function desactiva(n, c) {
    var caja = document.getElementById("cacom" + n);
    if (c == true)
        caja.disabled = false;
    else {
        caja.disabled = true;
        caja.value = 0;
    }
}

function validarTodo() {
    var IdRequisicion, Fecha, IdDevolucion;
    IdRequisicion = document.getElementById('Requisicion').value;
    Fecha = document.getElementById('Fecha').value;
    IdDevolucion = document.getElementById('IdDevolucion');
    exp = /\w+@\w+\.+[a-z]/;

    if (IdDevolucion == '' || IdRequisicion == 0 || Fecha == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    regDevProdV();
}

function regDevProdV() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 4; ++i) {
        arregloId[c] = celdasId[c].firstChild.checked;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.value;
        c += 4;
    }
    let IdDevolucion, IdRequisicion, Fecha;
    $(document).ready(function() {
        IdDevolucion = $.trim($("#IdDevolucion").val());
        IdRequisicion = $.trim($("#Requisicion").val());
        Fecha = $.trim($("#Fecha").val());
        console.log(IdDevolucion  + "---" + IdRequisicion + "---" + Fecha);
        opcion = 1;
        $.ajax({
            url: "bd/DevProd.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdDevolucion: IdDevolucion,
                IdRequisicion: IdRequisicion,
                Fecha: Fecha,
                'arregloId': JSON.stringify(arregloId)
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Devolución de Productos de Vale Consumible Registrada',
                    showConfirmButton: false,
                    footer: '<a href = "consDevProd.php">Ir a consultar</a>'
                })

            }
        });
    });
}
</script>




<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<br>
<br>
<div row>
    <div class="d-flex justify-content-center">
        <!-- FIN del contenido principal -->
        <?php require_once "vistas/parte_inf.php"?>
    </div>
</div>
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
          $consulta = "SELECT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON 
          R.IdEmpleadoSolicita = E.IdEmpleado WHERE R.Estado='Surtida' OR R.Estado='Ejecucion'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
                <label for="inputCp" class="form-label">Seleccionar Requisición: (sólo requisiciones en
                    ejecución)</label>
                <select type="text" class="form-control" id="Requisicion">
                    <option value="0">Seleccione una requisición</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdRequisicion'] ?>"><?php echo $opciones['IdRequisicion'] ?> ->
                        <?php echo $opciones['Nombre']?> (<?php echo $opciones['Fecha']?>)</option>

                    <?php endforeach ?>
                </select>
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
                url: "bd/getDetReq2.php",
                data: "requisicion=" + $('#Requisicion').val(),
                success: function(r) {
                    $('#tbodydatos').html(r);
                }
            });
        }
        </script>

        <div id="DatosRequisicion"></div>
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
                <label for="" class="form-label">Fecha de Emisión: </label>
                <input type="date" class="form-control" id="FechaEmision">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="inputTel" class="form-label">Motivo: </label>
                <textarea type="text" class="form-control" id="Motivo" cols="20" rows="5" maxlength="200"></textarea>
            </div>      
            <div class="form-group col-3">
                <label for="" class="form-label">Fecha de Surtido: </label>
                <input type="date" class="form-control" id="FechaSurte">
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
                <th scope="col">Seleccionar<br>-</th>
                <th scope="col">IdProducto<br>-</th>
                <th scope="col">Cantidad Requerida <BR>-</BR></th>
                <th scope="col">Cantidad Suministrada<br>-</th>
                <th scope="col">Precio<br>-</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
        </div>
    </div>
</div>

<!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
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
</script>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
    var IdRequisicion, IdEmpleadoRecibe, FechaEmision, FechaSurte, Motivo;
    IdRequisicion = document.getElementById("Requisicion").value;
    IdEmpleadoRecibe = document.getElementById("NombreEmpleado").value;
    FechaEmision = document.getElementById("FechaEmision").value;
    FechaSurte = document.getElementById("FechaSurte").value;
    Motivo = document.getElementById("Motivo").value;
    exp = /\w+@\w+\.+[a-z]/;

    if (IdRequisicion == 0 || IdEmpleadoRecibe == 0 || FechaEmision == '' || FechaSurte == '' || Motivo == '') {
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
        arregloId[c] = celdasId[c].firstChild.checked;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.value;
        arregloId[c + 4] = celdasId[c + 4].firstChild.data;
        c += 5;
    }
    let IdValeCons, IdRequisicion, IdEmpleadoRecibe, Motivo, FechaEmision, FechaSurte, Subtotal, Iva, Total, Saldo;
    $(document).ready(function() {
        IdValeCons = $.trim($("#IdValeCons").val());
        IdRequisicion = $.trim($("#Requisicion").val());
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
                IdRequisicion: IdRequisicion,
                IdEmpleadoRecibe: IdEmpleadoRecibe,
                FechaEmision: FechaEmision,
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
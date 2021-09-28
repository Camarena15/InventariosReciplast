<?php require_once "../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Modificar Requisición de Productos</h1>
</div>
<br>
<form id="frm">
    <div class="container">


        <div class="row">
            <div class="form-group col-md-2" id="IdR">
                <!-- SCRIPT PARA EL ID EMPLEADO-->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#IdRequisicion').val(0);
                    getIdR();

                    $('#IdRequisicion').change(function() {
                        getIdR();
                    });
                })
                </script>
                <script type="text/javascript">
                function getIdR() {
                    $.ajax({
                        type: "POST",
                        url: "../bd/getIdRequisicion.php",
                        data: "empleado=" + $('#IdRequisicion').val(),
                        success: function(r) {
                            $('#IdR').html(r);
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "bd/getRequisicion.php",
                        data: "empleado=" + $('#IdRequisicion').val(),
                        success: function(r) {
                            $('#oldEmployee').html(r);
                        }
                    });
                }
                </script>

            </div>
            <div class="form-group col-md-5">
                <?php
             $consulta = "SELECT R.*, E.Nombre  FROM requisicionesproductos AS R INNER JOIN Empleados as E ON R.IdEmpleadoSolicita = E.IdEmpleado WHERE R.Estado='Planeacion'";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          ?>
                <label for="InputIdRequisicion" class="form-label">Selecciona Requisición a Modificar (solo en estado
                    planeación): </label>
                <select type="text" class="form-control" id="IdRequisicion" name="">
                    <option value="0">Seleccionar Requisición</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdRequisicion'] ?>"><?php echo $opciones['IdRequisicion'] ?> =>
                        <?php echo $opciones['Nombre'] ?> (<?php echo $opciones['Fecha'] ?>)</option>

                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div id="oldEmployee"></div>
        <div class="row">
            <div class="form-group col-md-4">
                <!-- SELECT DE NOMBRES -->
                <?php
          $consulta = "SELECT IdEmpleado, Nombre FROM empleados Order By Nombre ASC";
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
                        url: "../bd/getIdEmpleado.php",
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
        <br>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-danger" onclick="modificarRequisicion()">Actualizar</button>
            </div>
        </div>
    </div>
</form>



<!-- VALIDAR TODO -->
<script>
function modificarRequisicion() {
  let IdRequisicion, IdEmpleadoSolicita, fecha;
    $(document).ready(function() {
        IdRequisicion = $.trim($("#IdRequisicion").val());
        console.log(IdRequisicion);
        IdEmpleadoSolicita = $.trim($("#IdEm").val());
        console.log(IdEmpleadoSolicita);
        fecha = $.trim($("#Fecha").val());
        console.log(fecha);
        opcion = 2;
        $.ajax({
            url: "../bd/ReqPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdRequisicion: IdRequisicion,
                IdEmpleadoSolicita: IdEmpleadoSolicita,
                fecha: fecha
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Requisición Modificada',
                    showConfirmButton: false,
                    footer: '<a href = "consReqPro.php">Ir a consultar</a>'
                })

            }
        });
    });

}
</script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "../vistas/parte_inf.php"?>
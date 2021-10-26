<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Reporte de Vales Consumibles en un Periodo por Empleado</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
    <p>Seleccione el periodo de las compras:</p>
        <div class="row">
        <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Inicial: </label>
                <input type="date" class="form-control" id="FI" name="FI">
            </div>
            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Final: </label>
                <input type="date" class="form-control" id="FF" name="FF">
            </div>
            <div class="form-group col-md-4">
                <?php
                  $consulta = "SELECT DISTINCTROW E.Nombre, E.IdEmpleado FROM valesconsumibles AS OM INNER JOIN empleados AS E ON OM.IdEmpleadoRecibe = E.IdEmpleado WHERE 1";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();        
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label for="" class="form-label">Nombre de Empleado: </label>
                <select type="text" class="form-control" id="IdEmpleado" name="IdEmpleado">
                    <option value="0">Seleccione un empleado</option>
                    <?php foreach ($data as $opciones): ?>
                        <option value="<?php echo $opciones['IdEmpleado'] ?>"><?php echo $opciones['Nombre'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-3">
                <br>
                <input type="text" name="opcion" id="opcion" value="9" hidden>
                <input type="text" name="titulo" id="titulo" value="RELACIÓN DE VALES DE CONSUMIBLES EN UN PERIODO POR EMPLEADO" hidden>
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>
</form>

<script>
function validar1() {
    var FI, FF, ids;
    FI = document.getElementById('FI').value;
    FF = document.getElementById('FF').value;
    ids = document.getElementById('IdEmpleado').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (FI == '' || FF == '' || ids == '0') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione correctamente los campos',
            showConfirmButton: false,
            timer: 1500
        })
        return false;

    } else {
        document.frm.submit();
    }
}
</script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
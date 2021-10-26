<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Reporte de Pagos de Compras de Productos en un Periodo</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
    <p>Seleccione el periodo de los pagos:</p>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Inicial: </label>
                <input class="form-control" type="date" name="FI" id="FI">
            </div>
            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Final: </label>
                <input class="form-control" type="date" name="FF" id="FF">
            </div>
            <div class="col-md-3">
                <br>
                <input type="text" name="opcion" id="opcion" value="8" hidden>
                <input type="text" name="titulo" id="titulo" value="RELACIÓN DE PAGOS DE PRODUCTOS EN UN PERIODO" hidden>
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>
</form>

<script>
function validar1() {
    var FI, FF;
    FI = document.getElementById('FI').value;
    FF = document.getElementById('FF').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (FI == '' || FF == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione correctamente el periodo',
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
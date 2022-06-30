<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Reporte de Lista de Requisiciones de Productos por Estado</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
    <p>Seleccione el estado de las requisiciones a enlistar:</p>
        <div class="row">
        <div class="form-group col-md-4">
                <label for="" class="form-label">Estado de la Requisición: </label>
                <select type="number" class="form-control" id="Estado" name="Estado">
                    <option value="0">Seleccione un estado</option>
                    <option value="Planeación">Planeación</option>
                    <option value="Ejecución">Ejecución</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>
            <div class="col-md-3">
                <br>
                <input type="text" name="opcion" id="opcion" value="5" hidden>
                <input type="text" name="titulo" id="titulo" value="RELACIÓN DE REQUISICIONES DE PRODUCTOS POR ESTADO" hidden>
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>
</form>

<script>
function validar1() {
    var Estado;
    Estado = document.getElementById('Estado').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (Estado == '0') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione correctamente el estado',
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
<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Relación de Compras de Productos a Vencer</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <input type="text" name="opcion" id="opcion" value="7" hidden>
                <input type="text" name="titulo" id="titulo" value="RELACIÓN DE COMPRAS DE PRODUCTOS A VENCER" hidden>
            </div>
        </div>
</form>

<script>
window.onload = load();
function load(){
    document.frm.submit();
}
</script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
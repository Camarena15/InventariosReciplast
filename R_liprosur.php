<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Reporte de Lista de Productos a Surtir</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
    <p>Seleccione la categoría de productos a buscar:</p>
        <div class="row">
        <div class="form-group col-md-4">
                <?php
                  $consulta = "SELECT * FROM subcategorias  WHERE 1 ORDER BY DescripcionSC";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();        
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label for="" class="form-label">Subcategoría: </label>
                <select type="number" class="form-control" id="IdSubCategoria" name="IdSubCategoria">
                    <option value="0">Seleccione una subcategoría</option>
                    <?php foreach ($data as $opciones): ?>
                        <option value ="<?php echo $opciones['IdSubCategoria'] ?>"><?php echo $opciones['DescripcionSC'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-3">
                <br>
                <input type="text" name="opcion" id="opcion" value="2" hidden>
                <input type="text" name="titulo" id="titulo" value="LISTA DE PRODUCTOS A SURTIR POR CATEGORÍA" hidden>
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>
</form>

<script>
function validar1() {
        document.frm.submit();
}
</script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
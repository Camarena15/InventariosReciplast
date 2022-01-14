<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Relación de Existencias de Productos por Categoría</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
    <p>Seleccione la categoría de productos a buscar:</p>
        <div class="row">
        <div class="form-group col-md-4">
                <?php
                  $consulta = "SELECT * FROM SubCategorias  WHERE 1";
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
                <input type="text" name="opcion" id="opcion" value="1" hidden>
                <input type="text" name="titulo" id="titulo" value="RELACIÓN DE EXISTENCIAS DE PRODUCTOS POR CATEGORÍA" hidden>
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>
</form>

<script>
function validar1() {
    var IdSubCategoria;
    IdSubCategoria = document.getElementById('IdSubCategoria').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (IdSubCategoria == 0) {
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
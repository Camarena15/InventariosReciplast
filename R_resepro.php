<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h2>Reporte de Seguimiento de Productos en un Periodo</h2>
</div>
<br>
<form id="frm" name="frm" method="post" action="InvReportes.php">
    <div class="container">
        <p>Seleccione el periodo de los movimientos:</p>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Inicial: </label>
                <input class="form-control" type="date" name="FI" id="FI">
            </div>
            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Final: </label>
                <input class="form-control" type="date" name="FF" id="FF">
            </div>
            <div class="form-group col-md-3">
                <!-- SELECT PARA EL PRODUCTO -->
                <?php
                    $consulta = "SELECT DISTINCT P.IdProducto, P.Descripcion FROM productos as P WHERE 1 Order By Descripcion ASC";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();  
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                <label for="inputAddress2" class="form-label">Descripción del producto: </label>
                <select type="number" class="form-control" id="Producto" name="Producto">
                    <option value="0">Seleccione un producto</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdProducto'] ?>"><?php echo $opciones['Descripcion'] ?>
                    </option>

                    <?php endforeach ?>
                </select>
                </select>
            </div>
            <div class="col-md-3">
                <br>
                <input type="text" name="opcion" id="opcion" value="11" hidden>
                <input type="text" name="titulo" id="titulo"
                    value="REPORTE DE SEGUIMIENTO DE PRODUCTOS EN UN PERIODO" hidden>
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>
</form>

<script>
function validar1() {
    var FI, FF, PR;
    FI = document.getElementById('FI').value;
    FF = document.getElementById('FF').value;
    PR = document.getElementById('Producto').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (FI == '' || FF == '' || PR == 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione correctamente todos los campos',
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
<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$costo=$_POST['costo'];

	$sql="SELECT CostoProm
		from productos
		where IdProducto='$costo'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='' class='form-label'>Costo Actual: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<input type="number" class="form-control" id="PrecioPUC" step="0.01" value='.$ver[0].'>';
	}

	echo  $cad;
	

?>
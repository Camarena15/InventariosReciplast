<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$IdProducto=$_POST['IdProducto'];

	$sql="SELECT Existencia
		from productos
		where IdProducto='$IdProducto'";

	$result=mysqli_query($conexion,$sql);
    $cad="";
	while ($ver=mysqli_fetch_row($result)) {
        $cad="<label for='' class='form-label'>Cantidad Surtida: </label>" . '<input type="number" class="form-control" id="CantidadSurtida" min=0 max='.$ver[0].' step=".01">';
	}

	echo  $cad;
	

?>
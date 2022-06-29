<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$prod=$_POST['prod'];

	$sql="SELECT IdProducto
		from productos
		where IdProducto='$prod'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='inputIdP' class='form-label'>Id Producto: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<input type="text" class="form-control" id="IdProd" readonly onmousedown="return false;" value='.$ver[0].'>';
	}

	echo  $cad;
	

?>
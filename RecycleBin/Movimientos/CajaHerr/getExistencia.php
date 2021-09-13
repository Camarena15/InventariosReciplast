<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$existencia=$_POST['existencia'];

	$sql="SELECT Existencia
		from productos
		where IdProducto='$existencia'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='' class='form-label'>Costo: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        //$cad=$cad.'<input type="text" class="form-control" id="Precio" readonly onmousedown="return false;" value='.$ver[0].'>';
		$cad = $ver[0];
	}

	echo  $cad;
	

?>
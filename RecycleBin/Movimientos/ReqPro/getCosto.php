<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$costo=$_POST['costo'];

	$sql="SELECT CostoProm
		from productos
		where IdProducto='$costo'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='' class='form-label'>Costo: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<input type="text" class="form-control" id="Precio" readonly onmousedown="return false;" value='.$ver[0].'>';
	}

	echo  $cad;
	

?>
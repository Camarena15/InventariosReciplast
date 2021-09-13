<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
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
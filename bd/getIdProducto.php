<?php 
$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
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
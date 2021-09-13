<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$idp=$_POST['idp'];

	$sql="SELECT IdPrograma
		from programaequipo
		where IdPrograma='$idp'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='inputAdd' class='form-label'>Id Programa: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<input type="text" class="form-control" id="IdP" readonly onmousedown="return false;" value='.$ver[0].'>';
	}

	echo  $cad;
	

?>
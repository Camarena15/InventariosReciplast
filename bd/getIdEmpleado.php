<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$empleado=$_POST['empleado'];

	$sql="SELECT IdEmpleado
		from empleados 
		where IdEmpleado='$empleado'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='inputAddress2' class='form-label'>Id Empleado: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<input type="text" class="form-control" id="IdEm" readonly onmousedown="return false;" value='.$ver[0].'>';
	}

	echo  $cad;
	

?>
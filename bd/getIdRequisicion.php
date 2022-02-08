<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$empleado=$_POST['empleado'];

	$sql="SELECT R.*, E.Nombre
		from requisicionesproductos AS R INNER JOIN empleados as E ON R.IdEmpleadoSolicita = E.IdEmpleado
		where IdRequisicion='$empleado'";

	$result=mysqli_query($conexion,$sql);

    $cad = "<label for='inputAddress2' class='form-label'>Id Requisicion: </label>";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<input type="text" class="form-control" id="IdR" readonly onmousedown="return false;" value='.$ver[0].'>';
	}

	echo  $cad;
	

?>
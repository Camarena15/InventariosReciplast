<?php
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$fi = (isset($_POST['fi'])) ? $_POST['fi'] : '';
$ff = (isset($_POST['ff'])) ? $_POST['ff'] : '';
    if ($ide != 0)
	    $sql="SELECT DISTINCT E.Nombre, R.* FROM valesconsumibles AS R INNER JOIN empleados AS E ON R.IdEmpleadoRecibe = E.IdEmpleado 
		INNER JOIN detvalesconsumibles AS D ON D.IdValeCons = R.IdValeCons 
		WHERE D.CantidadSurtida > 0 AND D.CantidadSurtida <> D.CantidadDevuelta AND R.IdEmpleadoRecibe ='$ide' AND FechaSurte BETWEEN '$fi' AND '$ff'";
    else
		$sql="SELECT DISTINCT E.Nombre, R.* FROM valesconsumibles AS R INNER JOIN empleados AS E ON R.IdEmpleadoRecibe = E.IdEmpleado 
		INNER JOIN detvalesconsumibles AS D ON D.IdValeCons = R.IdValeCons 
		WHERE D.CantidadSurtida > 0 AND D.CantidadSurtida <> D.CantidadDevuelta AND FechaSurte BETWEEN '$fi' AND '$ff'";
	$result=mysqli_query($conexion,$sql);

	$cadena = "<option value='0'>Seleccione un vale: </option>";
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[1].'>'.$ver[1].' -> '. utf8_encode($ver[0]) . ' (' . $ver[3] . ')' . '</option>';
	}

	echo  $cadena;
	

?>
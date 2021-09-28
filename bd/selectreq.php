<?php
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$fi = (isset($_POST['fi'])) ? $_POST['fi'] : '';
$ff = (isset($_POST['ff'])) ? $_POST['ff'] : '';
    if ($ide != 0)
	    $sql="SELECT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON R.IdEmpleadoSolicita = E.IdEmpleado WHERE IdEmpleadoSolicita ='$ide' AND Fecha BETWEEN '$fi' AND '$ff' AND R.Estado='Planeacion'";
    else
        $sql="SELECT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON R.IdEmpleadoSolicita = E.IdEmpleado WHERE Fecha BETWEEN '$fi' AND '$ff' AND R.Estado='Planeacion'";
	$result=mysqli_query($conexion,$sql);

	$cadena = "<option value='0'>Seleccione una Requisición: </option>";
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[1].'>'.utf8_encode($ver[1]).' -> '. $ver[0] . ' (' . $ver[3] . ')' . '</option>';
	}

	echo  $cadena;
	

?>
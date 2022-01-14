<?php
$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$fi = (isset($_POST['fi'])) ? $_POST['fi'] : '';
$ff = (isset($_POST['ff'])) ? $_POST['ff'] : '';
    if ($ide != 0)
	    $sql="SELECT DISTINCT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON R.IdEmpleadoSolicita = E.IdEmpleado 
		INNER JOIN detallerequisicionproductos AS D ON D.IdRequisicion = R.IdRequisicion 
		WHERE D.Cantidad > D.CantidadSurtida AND IdEmpleadoSolicita ='$ide' AND Fecha BETWEEN '$fi' AND '$ff' AND R.Estado='Ejecucion'";
    else
		$sql="SELECT DISTINCT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON R.IdEmpleadoSolicita = E.IdEmpleado 
		INNER JOIN detallerequisicionproductos AS D ON D.IdRequisicion = R.IdRequisicion 
		WHERE D.Cantidad > D.CantidadSurtida AND Fecha BETWEEN '$fi' AND '$ff' AND R.Estado='Ejecucion'";
	$result=mysqli_query($conexion,$sql);

	$cadena = "<option value='0'>Seleccione una Requisición: </option>";
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[1].'>'.utf8_encode($ver[1]).' -> '. $ver[0] . ' (' . $ver[3] . ')' . '</option>';
	}

	echo  $cadena;
	

?>
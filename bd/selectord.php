<?php
$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

	$sql="SELECT * FROM ordenmanttoint WHERE IdEmpleado ='$ide' AND Estado = '$estado'";

	$result=mysqli_query($conexion,$sql);

	$cadena = "<option value='0'>Seleccione una Orden: </option>";
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[0]).'</option>';
	}

	echo  $cadena;
	

?>
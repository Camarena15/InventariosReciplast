<?php
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
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
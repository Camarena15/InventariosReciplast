<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$equipo=$_POST['equipo'];

	$sql="SELECT IdPrograma,
			 Descripcion
		from programaequipo 
		where IdEquipo='$equipo'";

	$result=mysqli_query($conexion,$sql);

	$cadena = "<option value='0'>Seleccione un empleado</option>";
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena;
	

?>
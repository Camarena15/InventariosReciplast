<?php 
$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
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
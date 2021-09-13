<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
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
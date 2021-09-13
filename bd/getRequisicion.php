<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$empleado=$_POST['empleado'];

	$sql="SELECT E.Nombre, R.*
		from requisicionesproductos AS R INNER JOIN empleados as E ON R.IdEmpleadoSolicita = E.IdEmpleado
		where IdRequisicion='$empleado'";

	$result=mysqli_query($conexion,$sql);
	$cad="";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'<div class="row">
            <div class="col-md-3">
                <label for="OutputOldIdEm" class="form-label">Nombre empleado anterior:</label>
                <input type="text" class="form-control" id="IdR" readonly onmousedown="return false;"
                    value="' . $ver[0] . '">
            </div>
			<div class="col-md-3">
                <label for="OutputOldIdEm" class="form-label">Id-Empleado anterior:</label>
                <input type="text" class="form-control" id="IdR" readonly onmousedown="return false;"
                    value="' . $ver[2] . '">
            </div>
			<div class="col-md-3">
                <label for="OutputOldDate" class="form-label">Fecha anterior:</label>
                <input type="text" class="form-control" id="IdR" readonly onmousedown="return false;"
                    value="' . $ver[3] . '">
            </div>
        </div><br>';
	}

	echo  $cad;
	echo "alert('Modificar');"
	

?>
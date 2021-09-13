<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$ordenint=$_POST['ordenint'];

	$sql="SELECT o.IdOrdenInt, p.Descripcion, e.Nombre, o.FechaRegistro, o.FechaEstimadaEntrega, o.Estado
		from ordenmanttoint as o INNER JOIN programaequipo as p ON o.IdPrograma = p.IdPrograma INNER JOIN empleados as e ON o.IdEmpleado = e.IdEmpleado
		where IdOrdenInt='$ordenint'";

	$result=mysqli_query($conexion,$sql);

    $cad = "";
	while ($ver=mysqli_fetch_row($result)) {
        $cad=$cad.'
					<div class="row"><div class="form-group col-md-2" >
					<label for="inputTel" class="form-label">Id Orden: </label>
					<input type="text" class="form-control" id="IdOrden" readonly onmousedown="return false;" value='.$ver[0].'>
					
					</div><div class="form-group col-md-3" >
					
					<label for="inputTel" class="form-label">Nombre Empleado: </label>
					<input type="text" class="form-control" id="Empleado" readonly onmousedown="return false;" value='.$ver[2].'>
					<label for="inputTel" class="form-label">Fecha Registro: </label>
					<input type="text" class="form-control" id="FechaRegistro" readonly onmousedown="return false;" value='.$ver[3].'>
					<label for="inputTel" class="form-label">Estado: </label>
					<input type="text" class="form-control" id="Estado" readonly onmousedown="return false;" value='.$ver[5].'>
					
					</div><div class="form-group col-md-3" >
					
					<label for="inputTel" class="form-label">Programa: </label>
					<input type="text" class="form-control" id="Programa" readonly onmousedown="return false;" value='.$ver[1].'>
					
					<label for="inputTel" class="form-label">Fecha Entrega: </label>
					<input type="text" class="form-control" id="FechaEstimadaEntrega" readonly onmousedown="return false;" value='.$ver[4].'>
					
					</div>';
	}

	echo  $cad;
	

?>
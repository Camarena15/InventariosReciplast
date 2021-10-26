<?php
$conexion=mysqli_connect('localhost','root','','mantenimiento');
	$ri = (isset($_POST['ri'])) ? $_POST['ri'] : '';
	$rf = (isset($_POST['rf'])) ? $_POST['rf'] : '';
	
	$comienzo = $ri-1;
	$longitud = ($rf - $ri)+1;
	$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

	switch($opcion){
		case 1:
			$sql="SELECT C.* FROM comprasproductos AS C WHERE 1 LIMIT $comienzo, $longitud";
			$result=mysqli_query($conexion,$sql);

			$cadena = "<option value='0'>Seleccione una Compra: </option>";
			while ($ver=mysqli_fetch_row($result)) {
				$cadena=$cadena.'<option value='.$ver[0].'>Compra: '.utf8_encode($ver[0]). ' (' . $ver[5] . ')' . '</option>';
			}

			echo  $cadena;
			break;
		case 2:
			$sql="SELECT C.* FROM devprodvale AS C WHERE 1 LIMIT $comienzo, $longitud";
			$result=mysqli_query($conexion,$sql);

			$cadena = "<option value='0'>Seleccione una Devolución: </option>";
			while ($ver=mysqli_fetch_row($result)) {
				$cadena=$cadena.'<option value='.$ver[0].'>Devolución: '.utf8_encode($ver[0]). ' (' . $ver[2] . ')' . '</option>';
			}

			echo  $cadena;
			break;
		case 3:
			$sql="SELECT C.* FROM requisicionesproductos AS C WHERE 1 LIMIT $comienzo, $longitud";
			$result=mysqli_query($conexion,$sql);

			$cadena = "<option value='0'>Seleccione una Requisición: </option>";
			while ($ver=mysqli_fetch_row($result)) {
				$cadena=$cadena.'<option value='.$ver[0].'>Requisición: '.utf8_encode($ver[0]). ' (' . $ver[2] . ')' . '</option>';
			}

			echo  $cadena;
			break;
		case 4:
			$sql="SELECT C.* FROM valesconsumibles AS C WHERE 1 LIMIT $comienzo, $longitud";
			$result=mysqli_query($conexion,$sql);

			$cadena = "<option value='0'>Seleccione un Vale: </option>";
			while ($ver=mysqli_fetch_row($result)) {
				$cadena=$cadena.'<option value='.$ver[0].'>Vale: '.utf8_encode($ver[0]). ' (' . $ver[3] . ')' . '</option>';
			}

			echo  $cadena;
			break;
	}
	
	

?>
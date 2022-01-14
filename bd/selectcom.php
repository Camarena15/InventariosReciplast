<?php
$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$fi = (isset($_POST['fi'])) ? $_POST['fi'] : '';
$ff = (isset($_POST['ff'])) ? $_POST['ff'] : '';
    if ($ide != 0)
		$sql="SELECT C.* FROM comprasproductos AS C INNER JOIN proveedores AS P ON C.IdProveedor = P.IdProveedor WHERE P.IdProveedor ='$ide' AND Fecha BETWEEN '$fi' AND '$ff' AND C.Saldo > 0";
    else
        $sql="SELECT C.* FROM comprasproductos AS C INNER JOIN proveedores AS P ON C.IdProveedor = P.IdProveedor WHERE Fecha BETWEEN '$fi' AND '$ff' AND C.Saldo > 0";
	$result=mysqli_query($conexion,$sql);

	$cadena = "<option value='0'>Seleccione una Compra: </option>";
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>Compra: '.utf8_encode($ver[0]). ' (' . $ver[5] . ')' . '</option>';
	}

	echo  $cadena;
	

?>
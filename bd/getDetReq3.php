<?php 
include_once 'conexion.php';
$objeto = new Conexion();
$conection = $objeto->Conectar();

$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
$requisicion=$_POST['requisicion'];

	$sql="SELECT D.*, P.Descripcion FROM `detallerequisicionproductos` AS D INNER JOIN productos AS P ON D.IdProducto = P.IdProducto 
    WHERE IdRequisicion=$requisicion";

$result=mysqli_query($conexion,$sql);
    $cont = 0;
    $cad = "";
	while ($ver=mysqli_fetch_row($result)) {
        $cont++;
        $max = $ver[3] - $ver[4];
        if($max > 0){
            $cad = $cad . '<tr class="selected" id="fila' . $cont . '"><td><input type="checkbox" onchange="desactiva('. $cont .', this.checked)" id="chk'. $cont .'">
            </td><td>' . $ver[1] . '</td><td>' .$max . '</td><td><input type="number" class="num" max="'. $max .'" min="0" id="cacom'.$cont.'" step="0.01" value="0" disabled></td></tr>';
        }
    }
	echo  $cad;
	

?>
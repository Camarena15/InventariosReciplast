<?php 
include_once 'conexion.php';
$objeto = new Conexion();
$conection = $objeto->Conectar();

require("datos_conexion.php");
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$vale=$_POST['vale'];

	$sql="SELECT D.*, P.Descripcion, P.Existencia FROM `detvalesconsumibles` AS D INNER JOIN productos AS P ON D.IdProducto = P.IdProducto 
    WHERE D.IdValeCons=$vale";

$result=mysqli_query($conexion,$sql);
    $cont = 0;
    $cad = "";
	while ($ver=mysqli_fetch_row($result)) {
        $cont++;
        $max = $ver[3]-$ver[4]; //cantidad surtida - cantidad devuelta = maximo por devolver
            $cad = $cad . '<tr class="selected" id="fila' . $cont . '"><td><input type="checkbox" onchange="desactiva('. $cont .', this.checked)" id="chk'. $cont .'">
            </td><td>' . $ver[1] . '</td><td>' . $ver[5] . '</td><td>' .$ver[3] . '</td><td><input type="number" class="num" max="'. $max .'" min="0" id="cacom'.$cont.'" step="0.01" value="0" disabled></td></tr>';         
        
    }
	echo  $cad;
	

?>
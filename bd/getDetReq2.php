<?php 
include_once 'conexion.php';
$objeto = new Conexion();
$conection = $objeto->Conectar();

$conexion=mysqli_connect('localhost','root','','mantenimiento');
$requisicion=$_POST['requisicion'];

	$sql="SELECT D.*, P.Descripcion FROM `detallerequisicionproductos` AS D INNER JOIN productos AS P ON D.IdProducto = P.IdProducto 
    WHERE IdRequisicion=$requisicion";

$result=mysqli_query($conexion,$sql);
    $cont = 0;
    $cad = "";
	while ($ver=mysqli_fetch_row($result)) {
        $cont++;
       /* 
        $comprados = 0;
        $consulta = "SELECT SUM(D.Cantidad) AS F FROM detvalesconsumibles AS D INNER JOIN valesconsumibles AS C ON D.IdValeCons= C.IdValeCons 
        WHERE C.IdRequisicion=$requisicion AND D.IdProducto=$ver[1]";
        $resultado = $conection->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($data as $opciones): 
            $comprados = $opciones['F'];
        endforeach;
        
        $max = $ver[2]-$comprados;*/
        $max = $ver[2];
        if($max > 0){
            $cad = $cad . '<tr class="selected" id="fila' . $cont . '"><td><input type="checkbox" onchange="desactiva('. $cont .', this.checked)" id="chk'. $cont .'">
            </td><td>' . $ver[1] . '</td><td>' .$max . '</td><td><input type="number" class="num" max="'. $max .'" min="0" id="cacom'.$cont.'" onchange="calcularCosto()" value="0" disabled></td><td class="precio">' . $ver[5] . '</td></tr>';
        }
    }
	echo  $cad;
	

?>
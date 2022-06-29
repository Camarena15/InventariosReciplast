<?php 
include_once 'conexion.php';
$objeto = new Conexion();
$conection = $objeto->Conectar();

require("datos_conexion.php");
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$requisicion=$_POST['requisicion'];

	$sql="SELECT D.*, P.Descripcion, P.Existencia FROM `detallerequisicionproductos` AS D INNER JOIN productos AS P ON D.IdProducto = P.IdProducto 
    WHERE D.IdRequisicion=$requisicion";

$result=mysqli_query($conexion,$sql);
    $cont = 0;
    $cad = "";
	while ($ver=mysqli_fetch_row($result)) {
        $cont++;
        $max = $ver[2]-$ver[3];
        if($ver[7] < 0)
			$ver[7] = 0;
        if ($ver[7] >= $max){ //Si la existencia de este producto en almacen es MAYOR o igual a 
                            //la cantidad maxima que se puede tomar del producto en el vale
            
            if($max > 0){ //si la cantidad maxima que se puede tomar del producto es mayor que 0, entonces puede tomar productos
                $cad = $cad . '<tr class="selected" id="fila' . $cont . '"><td><input type="checkbox" onchange="desactiva('. $cont .', this.checked)" id="chk'. $cont .'">
                </td><td>' . $ver[6] . '</td><td>' .$max . '</td><td><input type="number" class="num" max="'. $max .'" min="0" id="cacom'.$cont.'" step="0.01" value="0" disabled></td><td class="precio">' . $ver[5] . '</td></tr>';
            }

        }
        else if ($ver[7] < $max){//Si la existencia de este producto en almacen es MENOR a 
                            //la cantidad maxima que se puede tomar del producto en el vale
            
            if($max > 0){ //si la cantidad maxima que se puede tomar del producto es mayor que 0, entonces puede tomar productos
                $cad = $cad . '<tr class="selected" id="fila' . $cont . '"><td><input type="checkbox" onchange="desactiva('. $cont .', this.checked)" id="chk'. $cont .'">
                </td><td>' . $ver[6] . ' <p style="color: red;">(PRODUCTO INSUFICIENTE EN ALMACÉN - <strong>' . $ver[7] . '</strong>)</p>' . '</td><td>' .$max . '</td><td><input type="number" class="num" max="'. $ver[7] .'" min="0" id="cacom'.$cont.'" step="0.01" value="0" disabled></td><td class="precio">' . $ver[5] . '</td></tr>';
            }                
          
        }
        
    }
	echo  $cad;
	

?>
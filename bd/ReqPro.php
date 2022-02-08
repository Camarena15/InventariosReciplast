<?php
session_start();
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$data = json_decode($_POST['arregloId']);
var_dump($data);
$max=sizeof($data); 



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $IdRequisicion = (isset($_POST['IdRequisicion'])) ? $_POST['IdRequisicion'] : '';
        $IdEmpleadoSolicita = (isset($_POST['IdEmpleadoSolicita'])) ? $_POST['IdEmpleadoSolicita'] : '';
        $Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
        $TotalAprox = (isset($_POST['TotalAprox'])) ? $_POST['TotalAprox'] : '';
        $consulta2 = "INSERT INTO requisicionesproductos(IdEmpleadoSolicita, Fecha, Estado, TotalAprox) VALUES ($IdEmpleadoSolicita,'$Fecha', 'Planeación', $TotalAprox)";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=6){
            $IdProducto[$c] = $data[$i+2];
            $Cantidad[$c] = $data[$i+3];
            $Costo[$c] = $data[$i+4];
            echo 'console.log('.$IdProducto[$c] . ' + " " +' . $Cantidad[$c] . '+ " " +' . $Costo[$c] . ')';
            $consulta = "INSERT INTO detallerequisicionproductos (IdRequisicion, IdProducto, Cantidad, CantidadSurtida, CantidadDevuelta, CostoAprox) 
            VALUES($IdRequisicion, $IdProducto[$c], $Cantidad[$c], 0, 0, $Costo[$c]) ";	
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 	
            $c++;
        }
        break;
    case 2:
        $IdRequisicion = (isset($_POST['IdRequisicion'])) ? $_POST['IdRequisicion'] : '';
        $Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
        $consulta2 = "UPDATE requisicionesproductos SET Estado='$Estado' WHERE IdRequisicion=$IdRequisicion";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
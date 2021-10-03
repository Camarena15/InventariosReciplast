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
        $IdDevolucion = (isset($_POST['IdDevolucion'])) ? $_POST['IdDevolucion'] : '';
        $IdRequisicion = (isset($_POST['IdRequisicion'])) ? $_POST['IdRequisicion'] : '';
        $Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
        $consulta2 = "INSERT INTO devprodvale(IdRequisicion, Fecha) VALUES ($IdRequisicion, '$Fecha')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=4){
            $IdProducto[$c] = $data[$i+1];
            $Cantidad[$c] = $data[$i+3];
            if($Cantidad[$c] > 0){
                $consulta = "INSERT INTO detdevprodvale (IdDevolucion, IdProducto, Cantidad) VALUES($IdDevolucion, $IdProducto[$c], $Cantidad[$c]) ";	
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 	

                $consulta = "UPDATE `productos` SET `Existencia`=`Existencia`+ $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c]";
                $resultado1 = $conexion->prepare($consulta);
                $resultado1->execute(); 
                
                $consulta = "UPDATE `detallerequisicionproductos` SET `CantidadDevuelta`=`CantidadDevuelta`+ $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c] AND `IdRequisicion` = $IdRequisicion";
                $resultado1 = $conexion->prepare($consulta);
                $resultado1->execute();
            }
            $c++;
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
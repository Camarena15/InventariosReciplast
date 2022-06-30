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
        $IdValeCons = (isset($_POST['IdValeCons'])) ? $_POST['IdValeCons'] : '';
        $Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
        $consulta2 = "INSERT INTO devprodvale(IdValeCons, Fecha) VALUES ($IdValeCons, '$Fecha')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=5){
            $IdProducto[$c] = $data[$i+1];
            $Cantidad[$c] = $data[$i+4]; //cantidad devuelta
            if($Cantidad[$c] > 0){
                $consulta1 = "INSERT INTO detdevprodvale (IdDevolucion, IdProducto, Cantidad) VALUES($IdDevolucion, $IdProducto[$c], $Cantidad[$c]) ";	
                $resultado = $conexion->prepare($consulta1);
                $resultado->execute(); 	

                $consulta2 = "UPDATE `productos` SET `Existencia`=`Existencia`+ $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c]";
                $resultado1 = $conexion->prepare($consulta2);
                $resultado1->execute(); 
                
                $consulta3 = "UPDATE `detvalesconsumibles` SET `CantidadDevuelta`=`CantidadDevuelta`+ $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c] AND `IdValeCons` = $IdValeCons";
                $resultado1 = $conexion->prepare($consulta3);
                $resultado1->execute();
            }
            $c++;
        }
        break;
}

print json_encode($consulta1 . $consulta2 . $consulta3, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
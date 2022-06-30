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
        $IdValeCons = (isset($_POST['IdValeCons'])) ? $_POST['IdValeCons'] : '';
        $IdEmpleadoRecibe = (isset($_POST['IdEmpleadoRecibe'])) ? $_POST['IdEmpleadoRecibe'] : '';
        $FechaSurte = (isset($_POST['FechaSurte'])) ? $_POST['FechaSurte'] : '';
        $Motivo = (isset($_POST['Motivo'])) ? $_POST['Motivo'] : '';
        $consulta2 = "INSERT INTO valesconsumibles(IdEmpleadoRecibe, FechaSurte, Motivo) VALUES 
        ($IdEmpleadoRecibe,'$FechaSurte','$Motivo')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute();
        for($i = 0; $i<=$max; $i+=5){
            $IdProducto = $data[$i+2];
            $Cantidad = $data[$i+3];
            $CantidadSurtida = $data[$i+4];
            if($Cantidad > 0){
                $consulta = "INSERT INTO detvalesconsumibles (IdValeCons, IdProducto, Cantidad, CantidadSurtida, CantidadDevuelta) VALUES($IdValeCons, $IdProducto, $Cantidad, $CantidadSurtida, 0) ";	
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta1 = "UPDATE `productos` SET `Existencia`=`Existencia`- $CantidadSurtida WHERE `IdProducto`=$IdProducto";
                $resultado1 = $conexion->prepare($consulta1);
                $resultado1->execute(); 
            }
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
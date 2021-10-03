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
        $IdRequisicion = (isset($_POST['IdRequisicion'])) ? $_POST['IdRequisicion'] : '';
        $IdEmpleadoRecibe = (isset($_POST['IdEmpleadoRecibe'])) ? $_POST['IdEmpleadoRecibe'] : '';
        $FechaEmision = (isset($_POST['FechaEmision'])) ? $_POST['FechaEmision'] : '';
        $FechaSurte = (isset($_POST['FechaSurte'])) ? $_POST['FechaSurte'] : '';
        $Motivo = (isset($_POST['Motivo'])) ? $_POST['Motivo'] : '';
        $consulta2 = "INSERT INTO valesconsumibles(IdRequisicion, IdEmpleadoRecibe, FechaEmision, FechaSurte, Motivo) VALUES 
        ($IdRequisicion,$IdEmpleadoRecibe,'$FechaEmision','$FechaSurte','$Motivo')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=5){
            $IdProducto[$c] = $data[$i+1];
            $Cantidad[$c] = $data[$i+3];
            if($Cantidad[$c] > 0){
                $consulta = "INSERT INTO detvalesconsumibles (IdValeCons, IdProducto, Cantidad) VALUES($IdValeCons, $IdProducto[$c], $Cantidad[$c]) ";	
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "UPDATE `productos` SET `Existencia`=`Existencia`- $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c]";
                $resultado1 = $conexion->prepare($consulta);
                $resultado1->execute(); 
                
                $consulta = "UPDATE `detallerequisicionproductos` SET `CantidadSurtida`=`CantidadSurtida`+ $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c] AND `IdRequisicion` = $IdRequisicion";
                $resultado1 = $conexion->prepare($consulta);
                $resultado1->execute();
            }
            $c++;
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
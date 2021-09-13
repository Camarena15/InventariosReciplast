<?php
session_start();
include_once '../../rsc/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$data = json_decode($_POST['arregloId']);
var_dump($data);
$max=sizeof($data); 



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $IdValeCons = (isset($_POST['IdValeCons'])) ? $_POST['IdValeCons'] : '';
        $IdEmpleadoAutoriza = (isset($_POST['IdEmpleadoAutoriza'])) ? $_POST['IdEmpleadoAutoriza'] : '';
        $IdEmpleadoRecibe = (isset($_POST['IdEmpleadoRecibe'])) ? $_POST['IdEmpleadoRecibe'] : '';
        $FechaEmision = (isset($_POST['FechaEmision'])) ? $_POST['FechaEmision'] : '';
        $FechaSurte = (isset($_POST['FechaSurte'])) ? $_POST['FechaSurte'] : '';
        $Motivo = (isset($_POST['Motivo'])) ? $_POST['Motivo'] : '';
        $consulta2 = "INSERT INTO valesconsumibles(IdEmpleadoAutoriza, IdEmpleadoRecibe, FechaEmision, FechaSurte, Motivo, Estado) VALUES 
        ($IdEmpleadoAutoriza,$IdEmpleadoRecibe,'$FechaEmision','$FechaSurte','$Motivo','Pendiente')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=2){
            $IdProducto[$c] = $data[$i];
            $Cantidad[$c] = $data[$i+1];
            console.log($data[$i] + "-" + $data[$i+1]);
            $consulta = "INSERT INTO detvalesconsumibles (IdValeCons, IdProducto, Cantidad) VALUES($IdValeCons, $IdProducto[$c], $Cantidad[$c]) ";	
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 	
            $c++;
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
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
        $IdCaja = (isset($_POST['IdCaja'])) ? $_POST['IdCaja'] : '';
        $IdEmpleado = (isset($_POST['idempleado'])) ? $_POST['idempleado'] : '';
        $FechaAsigna = (isset($_POST['fechaA'])) ? $_POST['fechaA'] : '';
        $consulta2 = "INSERT INTO cajaherramientas(IdEmpleado, FechaAsigna) VALUES ('$IdEmpleado','$FechaAsigna')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=2){
            $IdProducto[$c] = $data[$i];
            $Cantidad[$c] = $data[$i+1];
            console.log($data[$i] + "-" + $data[$i+1]);
            $consulta = "INSERT INTO detallecajaherramientas (IdCaja, IdProducto, Cantidad) VALUES($IdCaja, $IdProducto[$c], $Cantidad[$c]) ";	
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 	
            $c++;
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
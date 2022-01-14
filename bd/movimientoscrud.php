<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:    
        $consulta = "SELECT C.*, P.NombreP FROM comprasproductos AS C INNER JOIN proveedores as P ON P.IdProveedor = C.IdProveedor WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "SELECT C.* FROM devprodvale AS C WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "SELECT C.* FROM requisicionesproductos AS C WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:
        $consulta = "SELECT `IdValeCons`,`IdRequisicion`, `IdEmpleadoRecibe`, E.Nombre as Nombre,`FechaEmision`,`FechaSurte`,`Motivo` FROM 
        `valesconsumibles` AS V INNER JOIN `empleados` AS E ON V.IdEmpleadoRecibe = E.IdEmpleado WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "SELECT C.* FROM pagoscompras AS C WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
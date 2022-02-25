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
        $consulta = "SELECT E.Nombre, C.* FROM devprodvale AS C INNER JOIN requisicionesproductos as R 
        ON R.IdRequisicion = C.IdRequisicion INNER JOIN empleados as E ON R.IdEmpleadoSolicita = E.IdEmpleado WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "SELECT E.Nombre, C.* FROM requisicionesproductos AS C INNER JOIN empleados as E ON
         E.IdEmpleado = C.IdEmpleadoSolicita WHERE 1";
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
        $consulta = "SELECT P.NombreP, C.* FROM pagoscompras AS C INNER JOIN comprasproductos as CR 
        ON CR.IdCompra = C.IdCompra INNER JOIN proveedores as P ON P.IdProveedor = CR.IdProveedor WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$IdEmpleado = (isset($_POST['IdEmpleado'])) ? $_POST['IdEmpleado'] : '';
$IdArea = (isset($_POST['IdArea'])) ? $_POST['IdArea'] : '';
$IdPuesto = (isset($_POST['IdPuesto'])) ? $_POST['IdPuesto'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$FechaNac = (isset($_POST['FechaNac'])) ? $_POST['FechaNac'] : '';
$FechaIngreso = (isset($_POST['FechaIngreso'])) ? $_POST['FechaIngreso'] : '';
$Domicilio = (isset($_POST['Domicilio'])) ? $_POST['Domicilio'] : '';
$Colonia = (isset($_POST['Colonia'])) ? $_POST['Colonia'] : '';
$Ciudad = (isset($_POST['Ciudad'])) ? $_POST['Ciudad'] : '';
$CP = (isset($_POST['CP'])) ? $_POST['CP'] : '';
$Edo = (isset($_POST['Edo'])) ? $_POST['Edo'] : '';
$Tel = (isset($_POST['Tel'])) ? $_POST['Tel'] : '';
$Celular = (isset($_POST['Celular'])) ? $_POST['Celular'] : '';
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO empleados(IdArea, IdPuesto, Nombre, FechaNac, FechaIngreso, Domicilio, Colonia, Ciudad, CP, Edo, Tel, Celular, Estado) 
        VALUES ($IdArea, $IdPuesto, '$Nombre', '$FechaNac', '$FechaIngreso', '$Domicilio', '$Colonia', '$Ciudad', '$CP', '$Edo', '$Tel', '$Celular', '$Estado')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM empleados ORDER BY IdEmpleado DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE empleados SET IdArea=  $IdArea, IdPuesto=$IdPuesto, Nombre = '$Nombre', FechaNac= '$FechaNac', FechaIngreso = '$FechaIngreso', Domicilio = '$Domicilio', Colonia = '$Colonia', Ciudad= '$Ciudad', CP = '$CP', Edo='$Edo', Tel = '$Tel', Celular = '$Celular', Estado = '$Estado' WHERE IdEmpleado = $IdEmpleado ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM empleados WHERE IdEmpleado= $IdEmpleado ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM empleados WHERE IdEmpleado= $IdEmpleado ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT P.DescripcionP, A.DescripcionA, E.* FROM empleados as E INNER JOIN area as A ON E.IdArea = A.IdArea 
        INNER JOIN puestos as P ON E.IdPuesto = P.IdPuesto WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
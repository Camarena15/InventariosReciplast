<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$IdEquipo = (isset($_POST['IdEquipo'])) ? $_POST['IdEquipo'] : '';
$IdProveedor = (isset($_POST['IdProveedor'])) ? $_POST['IdProveedor'] : '';
$IdArea = (isset($_POST['IdArea'])) ? $_POST['IdArea'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';
$Marca = (isset($_POST['Marca'])) ? $_POST['Marca'] : '';
$Modelo = (isset($_POST['Modelo'])) ? $_POST['Modelo'] : '';
$NoSerie = (isset($_POST['NoSerie'])) ? $_POST['NoSerie'] : '';
$FechaAdq = (isset($_POST['FechaAdq'])) ? $_POST['FechaAdq'] : '';
$FechaGarantia = (isset($_POST['FechaGarantia'])) ? $_POST['FechaGarantia'] : '';
$FechaUltMant = (isset($_POST['FechaUltMant'])) ? $_POST['FechaUltMant'] : '';
$FechaProxMant = (isset($_POST['FechaProxMant'])) ? $_POST['FechaProxMant'] : '';
$HorasTrabajadas = (isset($_POST['HorasTrabajadas'])) ? $_POST['HorasTrabajadas'] : '';
$HorasUltimoCorte = (isset($_POST['HorasUltimoCorte'])) ? $_POST['HorasUltimoCorte'] : '';
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO equipos(IdProveedor, IdArea, Nombre, Descripcion, Marca, Modelo, NoSerie, FechaAdq, FechaGarantia, FechaUltMant, FechaProxMant, HorasTrabajadas, HorasUltimoCorte, Estado) 
        VALUES ($IdProveedor, $IdArea, '$Nombre', '$Descripcion', '$Marca', '$Modelo', '$NoSerie', '$FechaAdq', '$FechaGarantia', '$FechaUltMant', '$FechaProxMant', $HorasTrabajadas, $HorasUltimoCorte, '$Estado')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM equipos ORDER BY IdEquipo DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE equipos SET IdProveedor=  $IdProveedor, IdArea=$IdArea, Nombre = '$Nombre', Descripcion= '$Descripcion', Marca = '$Marca', Modelo = '$Modelo', NoSerie= '$NoSerie', FechaAdq = '$FechaAdq', FechaGarantia='$FechaGarantia', FechaUltMant = '$FechaUltMant', FechaProxMant = '$FechaProxMant', HorasTrabajadas = $HorasTrabajadas, HorasUltimoCorte = $HorasUltimoCorte, Estado = '$Estado' WHERE IdEquipo = $IdEquipo ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM equipos WHERE IdEquipo= $IdEquipo ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM equipos WHERE IdEquipo= $IdEquipo ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM equipos  WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
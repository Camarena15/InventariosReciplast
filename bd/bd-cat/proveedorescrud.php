<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$IdProveedor = (isset($_POST['IdProveedor'])) ? $_POST['IdProveedor'] : '';
$NombreP = (isset($_POST['NombreP'])) ? $_POST['NombreP'] : '';
$Domicilio = (isset($_POST['Domicilio'])) ? $_POST['Domicilio'] : '';
$Colonia = (isset($_POST['Colonia'])) ? $_POST['Colonia'] : '';
$Ciudad = (isset($_POST['Ciudad'])) ? $_POST['Ciudad'] : '';
$CP = (isset($_POST['CP'])) ? $_POST['CP'] : '';
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
$Tel = (isset($_POST['Tel'])) ? $_POST['Tel'] : '';
$Celular = (isset($_POST['Celular'])) ? $_POST['Celular'] : '';
$Email = (isset($_POST['Email'])) ? $_POST['Email'] : '';
$Representante = (isset($_POST['Representante'])) ? $_POST['Representante'] : '';
$DescripcionTipoProv = (isset($_POST['DescripcionTipoProv'])) ? $_POST['DescripcionTipoProv'] : '';
$Saldo = (isset($_POST['Saldo'])) ? $_POST['Saldo'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO proveedores(NombreP, Domicilio, Colonia, Ciudad, CP, Estado, Tel, Celular, Email, Representante, DescripcionTipoProv, Saldo) 
        VALUES ('$NombreP', '$Domicilio', '$Colonia', '$Ciudad', '$CP', '$Estado', '$Tel', '$Celular', '$Email', '$Representante', '$DescripcionTipoProv', $Saldo)";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM proveedores ORDER BY IdProveedor DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE proveedores SET NombreP = '$NombreP', Domicilio = '$Domicilio', Colonia = '$Colonia', Ciudad= '$Ciudad', CP = '$CP', Estado='$Estado', Tel = '$Tel', Celular = '$Celular', Email='$Email', Representante = '$Representante', DescripcionTipoProv = '$DescripcionTipoProv' WHERE IdProveedor = $IdProveedor ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM proveedores WHERE IdProveedor= $IdProveedor ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM proveedores WHERE IdProveedor= $IdProveedor ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM proveedores  WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
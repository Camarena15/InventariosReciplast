<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$IdCategoria = (isset($_POST['IdCategoria'])) ? $_POST['IdCategoria'] : '';
$IdSubCategoria = (isset($_POST['IdSubCategoria'])) ? $_POST['IdSubCategoria'] : '';
$DescripcionSC = (isset($_POST['DescripcionSC'])) ? $_POST['DescripcionSC'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO subcategorias(IdCategoria, IdSubCategoria, DescripcionSC) 
        VALUES ($IdCategoria, $IdSubCategoria, '$DescripcionSC')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM subcategorias ORDER BY Id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE subcategorias SET IdCategoria=  $IdCategoria, IdSubCategoria=$IdSubCategoria, DescripcionSC = '$DescripcionSC' WHERE Id = $Id ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM subcategorias WHERE Id= $Id ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM subcategorias WHERE Id= $Id ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM subcategorias  WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
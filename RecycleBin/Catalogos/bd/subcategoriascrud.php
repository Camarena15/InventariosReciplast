<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$IdCategoria = (isset($_POST['IdCategoria'])) ? $_POST['IdCategoria'] : '';
$IdSubCategoria = (isset($_POST['IdSubCategoria'])) ? $_POST['IdSubCategoria'] : '';
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO subcategorias(IdCategoria, IdSubCategoria, Descripcion) 
        VALUES ($IdCategoria, $IdSubCategoria, '$Descripcion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM subcategorias ORDER BY Id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE subcategorias SET IdCategoria=  $IdCategoria, IdSubCategoria=$IdSubCategoria, Descripcion = '$Descripcion' WHERE Id = $Id ";		
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
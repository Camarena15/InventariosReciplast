<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdCategoria = (isset($_POST['IdCategoria'])) ? $_POST['IdCategoria'] : '';
$IdSubCategoria = (isset($_POST['IdSubCategoria'])) ? $_POST['IdSubCategoria'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO subcategorias (IdCategoria, DescripcionSC) VALUES('$IdCategoria', '$Descripcion') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT S.IdSubCategoria, C.DescripcionC, S.DescripcionSC FROM subcategorias AS S INNER JOIN categorias AS C ON S.IdCategoria = C.IdCategoria";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE subcategorias SET IdCategoria = '$IdCategoria',  DescripcionSC='$Descripcion' WHERE IdSubCategoria='$IdSubCategoria' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM subcategorias WHERE IdSubCategoria='$IdSubCategoria'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM subcategorias WHERE IdSubCategoria='$IdSubCategoria' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT S.IdSubCategoria, C.DescripcionC, S.DescripcionSC FROM subcategorias AS S INNER JOIN categorias AS C ON S.IdCategoria = C.IdCategoria";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
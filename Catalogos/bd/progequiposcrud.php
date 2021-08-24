<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$IdPrograma = (isset($_POST['IdPrograma'])) ? $_POST['IdPrograma'] : '';
$IdEquipo = (isset($_POST['IdEquipo'])) ? $_POST['IdEquipo'] : '';
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';
$TipoFrecuencia = (isset($_POST['TipoFrecuencia'])) ? $_POST['TipoFrecuencia'] : '';
$Frecuencia = (isset($_POST['Frecuencia'])) ? $_POST['Frecuencia'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO programaequipo(IdEquipo, Descripcion, TipoFrecuencia, Frecuencia) 
        VALUES ($IdEquipo, '$Descripcion', '$TipoFrecuencia', $Frecuencia)";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM programaequipo ORDER BY IdPrograma DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE programaequipo SET IdEquipo=  $IdEquipo, Descripcion = '$Descripcion', TipoFrecuencia = '$TipoFrecuencia', Frecuencia= $Frecuencia WHERE IdPrograma = $IdPrograma ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM programaequipo WHERE IdPrograma= $IdPrograma ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM programaequipo WHERE IdPrograma= $IdPrograma ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM programaequipo  WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
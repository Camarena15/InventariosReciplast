<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Contrasena = (isset($_POST['Contrasena'])) ? $_POST['Contrasena'] : '';
$Privilegio = (isset($_POST['Privilegio'])) ? $_POST['Privilegio'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO usuarios(Nombre, Contrasena, Privilegio, Sistema) VALUES ('$Nombre', MD5('$Contrasena'), $Privilegio, 'I')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios WHERE Sistema='I' ORDER BY idUsuario DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);      
        break;    
    case 2:
        if ($Contrasena == ""){
            $consulta = "UPDATE usuarios SET Nombre='$Nombre', Privilegio = $Privilegio WHERE idUsuario = $idUsuario ";	
        } else {
            $consulta = "UPDATE usuarios SET Nombre='$Nombre', Contrasena=MD5('$Contrasena'), Privilegio = $Privilegio WHERE idUsuario = $idUsuario ";
        }        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();      
        
        $consulta = "SELECT * FROM usuarios WHERE idUsuario= $idUsuario AND Sistema='I'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM usuarios WHERE idUsuario= $idUsuario ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM usuarios  WHERE Sistema='I'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
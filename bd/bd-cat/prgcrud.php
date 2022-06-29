<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$IdProducto = (isset($_POST['IdProducto'])) ? $_POST['IdProducto'] : '';
$IdSubCategoria = (isset($_POST['IdSubCategoria'])) ? $_POST['IdSubCategoria'] : '';
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : '';
$Maximo = (isset($_POST['Maximo'])) ? $_POST['Maximo'] : '';
$Minimo = (isset($_POST['Minimo'])) ? $_POST['Minimo'] : '';
$PuntoReorden = (isset($_POST['PuntoReorden'])) ? $_POST['PuntoReorden'] : '';
$Existencia = (isset($_POST['Existencia'])) ? $_POST['Existencia'] : '';
$CostoProm = (isset($_POST['CostoProm'])) ? $_POST['CostoProm'] : '';
$UltCosto = (isset($_POST['UltCosto'])) ? $_POST['UltCosto'] : '';
$UnidadMedida = (isset($_POST['UnidadMedida'])) ? $_POST['UnidadMedida'] : '';
$Marca = (isset($_POST['Marca'])) ? $_POST['Marca'] : '';
$Modelo = (isset($_POST['Modelo'])) ? $_POST['Modelo'] : '';
$NoParte = (isset($_POST['NoParte'])) ? $_POST['NoParte'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO productos(IdSubCategoria, Descripcion, Maximo, Minimo, PuntoReorden, Existencia, 
        CostoProm, UltCosto, UnidadMedida, Marca, Modelo, NoParte) VALUES ($IdSubCategoria, '$Descripcion', $Maximo, $Minimo, $PuntoReorden, $Existencia, $CostoProm, $UltCosto, '$UnidadMedida', '$Marca', '$Modelo', '$NoParte')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM productos ORDER BY IdProducto DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE productos SET IdSubCategoria=  $IdSubCategoria, Descripcion='$Descripcion', Maximo = $Maximo, Minimo= $Minimo, PuntoReorden = $PuntoReorden, UnidadMedida = '$UnidadMedida', Marca= '$Marca', Modelo = '$Modelo', NoParte='$NoParte' WHERE IdProducto = $IdProducto ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM productos WHERE IdProducto= $IdProducto ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM productos WHERE IdProducto= $IdProducto ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT SC.DescripcionSC, P.* FROM productos as P INNER JOIN subcategorias as SC ON 
        P.IdSubCategoria = SC.IdSubCategoria  WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
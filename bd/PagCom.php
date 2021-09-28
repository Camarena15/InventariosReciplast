<?php
session_start();
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $IdCompra = (isset($_POST['IdCompra'])) ? $_POST['IdCompra'] : '';
        $Referencia = (isset($_POST['Referencia'])) ? $_POST['Referencia'] : '';
        $Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
        $Importe = (isset($_POST['Importe'])) ? $_POST['Importe'] : '';
        $Condiciones = (isset($_POST['Condiciones'])) ? $_POST['Condiciones'] : '';
        $Proveedor = (isset($_POST['Proveedor'])) ? $_POST['Proveedor'] : '';
        $consulta2 = "INSERT INTO pagoscompras(IdCompra, Referencia, Fecha, Importe) VALUES ($IdCompra, '$Referencia','$Fecha', $Importe)";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 

        $consulta2 = "UPDATE `comprasproductos` SET Saldo=Saldo-$Importe WHERE IdCompra=$IdCompra";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute();

        if ($Condiciones == "Crédito") {
            $consulta2 = "UPDATE `proveedores` SET Saldo=Saldo-$Importe WHERE IdProveedor=$Proveedor";		
            $resultado1 = $conexion->prepare($consulta2);
            $resultado1->execute();
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
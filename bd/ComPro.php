<?php
session_start();
include_once 'conexion.php';
require("datos_conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$data = json_decode($_POST['arregloId']);
var_dump($data);
$max=sizeof($data); 



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $IdCompra = (isset($_POST['IdCompra'])) ? $_POST['IdCompra'] : '';
        $IdProveedor = (isset($_POST['IdProveedor'])) ? $_POST['IdProveedor'] : '';
        $Factura = (isset($_POST['Factura'])) ? $_POST['Factura'] : '';
        $Condiciones = (isset($_POST['Condiciones'])) ? $_POST['Condiciones'] : '';
        $Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
        $FechaVto = (isset($_POST['FechaVto'])) ? $_POST['FechaVto'] : '';
        $Subtotal = (isset($_POST['Subtotal'])) ? $_POST['Subtotal'] : '';
        $Iva = (isset($_POST['Iva'])) ? $_POST['Iva'] : '';
        $Total = (isset($_POST['Total'])) ? $_POST['Total'] : '';
        $Saldo = (isset($_POST['Saldo'])) ? $_POST['Saldo'] : '';
        $consulta = "INSERT INTO `comprasproductos`(`IdProveedor`, `Factura`, `Condiciones`, `Fecha`, `FechaVto`, `Subtotal`, `Iva`, `Total`, `Saldo`) 
        VALUES ($IdProveedor, '$Factura', '$Condiciones', '$Fecha', '$FechaVto', $Subtotal, $Iva, $Total, $Saldo)";		
        $resultado1 = $conexion->prepare($consulta);
        $resultado1->execute();
        $c=0;
        $con = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
        for($i = 0; $i<=$max; $i+=6){
            $IdProducto[$c] = $data[$i+2];
            $Cantidad[$c] = $data[$i+3];
            $Costo[$c] = $data[$i+4];
            if($Cantidad[$c] > 0){
                $Existencia = 0;
                $CostoProm = 0;
                $consulta = "SELECT Existencia, CostoProm FROM productos WHERE IdProducto=$IdProducto[$c]";
                $result=mysqli_query($con,$consulta);
                while ($ver=mysqli_fetch_row($result)) {
                    $Existencia = $ver[0];
                    $CostoProm = $ver[1];
                }
                $CostoPromedio = round(((($Existencia * $CostoProm) + ($Cantidad[$c] * $Costo[$c])) / ($Existencia + $Cantidad[$c])), 2);
                $consulta = "INSERT INTO detallecompraprod(`IdCompra`, `IdProducto`, `Cantidad`, `Costo`) VALUES 
                ($IdCompra, $IdProducto[$c], $Cantidad[$c], $Costo[$c]) ";	
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $consulta = "UPDATE `productos` SET `Existencia`=`Existencia`+" . floatval($Cantidad[$c]) . ", `CostoProm`=" . floatval($CostoPromedio) . ", `UltCosto`=" . floatval($Costo[$c]) . " WHERE `IdProducto`=$IdProducto[$c]";
                $resultado1 = $conexion->prepare($consulta);
                $resultado1->execute();
            }
            $c++;
        }
        if($Condiciones == "Crédito"){
            $consulta = "UPDATE proveedores SET Saldo=Saldo+$Saldo WHERE IdProveedor=$IdProveedor";		
            $resultado1 = $conexion->prepare($consulta);
            $resultado1->execute();
        }
        break; 

}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
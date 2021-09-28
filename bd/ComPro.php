<?php
session_start();
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$data = json_decode($_POST['arregloId']);
var_dump($data);
$max=sizeof($data); 



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $IdCompra = (isset($_POST['IdCompra'])) ? $_POST['IdCompra'] : '';
        $IdRequisicion  = (isset($_POST['IdRequisicion'])) ? $_POST['IdRequisicion'] : '';
        $IdProveedor = (isset($_POST['IdProveedor'])) ? $_POST['IdProveedor'] : '';
        $Factura = (isset($_POST['Factura'])) ? $_POST['Factura'] : '';
        $Condiciones = (isset($_POST['Condiciones'])) ? $_POST['Condiciones'] : '';
        $Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
        $FechaVto = (isset($_POST['FechaVto'])) ? $_POST['FechaVto'] : '';
        $Subtotal = (isset($_POST['Subtotal'])) ? $_POST['Subtotal'] : '';
        $Iva = (isset($_POST['Iva'])) ? $_POST['Iva'] : '';
        $Total = (isset($_POST['Total'])) ? $_POST['Total'] : '';
        $Saldo = (isset($_POST['Saldo'])) ? $_POST['Saldo'] : '';
        $consulta = "INSERT INTO `comprasproductos`(`IdRequisicion`, `IdProveedor`, `Factura`, `Condiciones`, `Fecha`, `FechaVto`, `Subtotal`, `Iva`, `Total`, `Saldo`) 
        VALUES ($IdRequisicion, $IdProveedor, '$Factura', '$Condiciones', '$Fecha', '$FechaVto', $Subtotal, $Iva, $Total, $Saldo)";		
        $resultado1 = $conexion->prepare($consulta);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=5){
            $IdProducto[$c] = $data[$i+1];
            $Cantidad[$c] = $data[$i+3];
            $Costo[$c] = $data[$i+4];
            if($Cantidad[$c] > 0){
                $consulta = "INSERT INTO detallecompraprod(`IdCompra`, `IdProducto`, `Cantidad`, `Costo`) VALUES 
                ($IdCompra, $IdProducto[$c], $Cantidad[$c], $Costo[$c]) ";	
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 	
                $consulta = "UPDATE `productos` SET `Existencia`=`Existencia`+ $Cantidad[$c] WHERE `IdProducto`=$IdProducto[$c]";
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

        //VERIFICAR QUE PRODUCTOS FUERON REQUERIDOS, Y CUALES SE HAN COMPRADO, ADEMAS DE SU CANTIDAD
        $consulta = "SELECT D.IdProducto, D.Cantidad FROM `detallerequisicionproductos` AS D WHERE IdRequisicion = $IdRequisicion";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $c=0;
        foreach ($data as $opciones):
            {
                $idp[$c] = $opciones['IdProducto'];
                $can[$c] = $opciones['Cantidad'];
                $c++;
            }
        endforeach;
        $consulta = "SELECT D.IdProducto, SUM(D.Cantidad) as Cantidad FROM `detallecompraprod` AS D INNER JOIN comprasproductos as C ON C.IdCompra = D.IdCompra INNER JOIN
        requisicionesproductos AS R ON R.IdRequisicion = C.IdRequisicion WHERE R.IdRequisicion = $IdRequisicion GROUP BY D.IdProducto";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $k=0;
        foreach ($data as $opciones):
            {
                $cidp[$k] = $opciones['IdProducto'];
                $ccan[$k] = $opciones['Cantidad'];
                $k++;
            }
        endforeach;
        $matchrows = 0;
        for ($i=0; $i<$c; $i++){
            for ($j=0; $j<$k; $j++){
                if ($cidp[$j] == $idp[$i] && $ccan[$j]==$can[$i]){ //Si el producto de la requisicion y su cantidad es igual al producto y cantidad
                    $matchrows++;                                   // encontrado en las compras de la requisicion, se incrementa matchrows
                }
            }
        }
        if($c==$matchrows){ //Si los productos relacionados son la misma cantidad que los productos de la requisicion, la requisicion esta surtida
            $consulta = "UPDATE requisicionesproductos SET Estado='Surtida' WHERE IdRequisicion=$IdRequisicion";		
            $resultado1 = $conexion->prepare($consulta);
            $resultado1->execute();
        }

        break; 

}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
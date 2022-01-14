<?php
include 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$fi = (isset($_POST['fi'])) ? $_POST['fi'] : '';
$ff = (isset($_POST['ff'])) ? $_POST['ff'] : '';

if ($ide != 0)
	    $sql="SELECT P.NombreP, C.* FROM comprasproductos AS C INNER JOIN proveedores AS P ON C.IdProveedor = P.IdProveedor WHERE P.IdProveedor ='$ide' AND Fecha BETWEEN '$fi' AND '$ff' AND C.Saldo > 0";
    else
        $sql="SELECT P.NombreP, C.* FROM comprasproductos AS C INNER JOIN proveedores AS P ON C.IdProveedor = P.IdProveedor WHERE Fecha BETWEEN '$fi' AND '$ff' AND C.Saldo > 0";
$resultado = $conexion->prepare($sql);
$resultado->execute();  
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
echo"<thead>";
echo"                <tr>";
echo"                  <th scope='col'>IdCompra</th>";
echo"                    <th scope='col'>Proveedor</th>";
echo"                    <th scope='col'>Factura</th>";
echo"                    <th scope='col'>Condiciones</th>";
echo"                    <th scope='col'>Fecha</th>";
echo"                    <th scope='col'>Fecha Vto</th>";
echo"                    <th scope='col'>Subtotal</th>";
echo"                    <th scope='col'>Iva</th>";
echo"                    <th scope='col'>Total</th>";
echo"                    <th scope='col'>Saldo</th>";
echo"                </tr>";
echo"            </thead>";
echo"            <tbody>";
echo"            </tbody>";
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdCompra']."</td><td>".$opciones['NombreP']."</td><td>".
        $opciones['Factura']."</td><td>".$opciones['Condiciones']."</td><td>".$opciones['Fecha']."</td><td>".$opciones['FechaVto'].
        "</td><td>".$opciones['Subtotal']."</td><td>".$opciones['Iva']."</td><td>".$opciones['Total']."</td><td>".$opciones['Saldo']."</td>";
        echo "</tr>";
    }
endforeach;
    ?>
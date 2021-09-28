<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA Compras de Productos</h1></div>
    <br>  
    <?php
          $consulta = "SELECT E.Nombre, C.* FROM comprasproductos AS C INNER JOIN proveedores AS E ON 
          C.IdProveedor = E.IdProveedor";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaP" class="table table-hover  table-dark" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>IdCompra</th>
                            <th>IdRequisicion</th>
                            <th>IdProveedor</th>
                            <th>Proveedor</th>
                            <th>Factura</th>
                            <th>Condiciones</th>
                            <th>Fecha</th>
                            <th>FechaVto</th>
                            <th>Subtotal</th>
                            <th>Iva</th>
                            <th>Total</th>
                            <th>Saldo</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdCompra']."</td><td>".$opciones['IdRequisicion']."</td><td>".$opciones['IdProveedor']."</td>
        <td>".$opciones['Nombre']."</td><td>".$opciones['Factura']."</td><td>".$opciones['Condiciones']."</td><td>".$opciones['Fecha']."</td>
        <td>".$opciones['FechaVto']."</td><td>".$opciones['Subtotal']."</td><td>".$opciones['Iva']."</td><td>".$opciones['Total']."</td><td>".$opciones['Saldo']."</td>";
        echo "</tr>";
    }
endforeach;
    echo "</table>";
    echo"</thead>";
    echo "<tbody> ";                         
    echo "</tbody>";        
    echo "</table>";               
    echo "</div>";
    echo "</div>";
    echo "</div>";  
    echo "</div>";  
    
    
    ?>
<br>
<br>
<br>
<div class="container"><h1>CONSULTA Detalles de Compras de Productos</h1></div>
    <br>  
    <?php
          $consulta = "SELECT P.Descripcion, D.* FROM detallecompraprod as D INNER JOIN productos as P ON
          D.IdProducto = P.IdProducto";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaP" class="table table-hover  table-dark" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>IdCompra <br>-</th>
                            <th>Producto <br>-</th>
                            <th>Cantidad <br>-</th>
                            <th>Costo <br> Unitario</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdCompra']."</td><td>".$opciones['Descripcion']."</td><td>".$opciones['Cantidad']."</td><td>".$opciones['Costo']."</td>";
        echo "</tr>";
    }
endforeach;
    echo "</table>";
    echo"</thead>";
    echo "<tbody> ";                         
    echo "</tbody>";        
    echo "</table>";               
    echo "</div>";
    echo "</div>";
    echo "</div>";  
    echo "</div>";  
    
    
    ?>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
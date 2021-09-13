<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA Devolución de Productos <br> de Mantenimiento</h1></div>
    <br>  
    <?php
          $consulta = "SELECT C.IdRequisicion, E.Nombre, C.Fecha, C.TotalAprox, C.Estado FROM requisicionesproductos AS C INNER JOIN empleados AS E ON 
          C.IdEmpleadoSolicita = E.IdEmpleado";
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
                            <th>IdRequisicion</th>
                            <th>Empleado Solicita</th>
                            <th>Fecha</th>
                            <th>Total Aproximado</th>
                            <th>Estado</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdRequisicion']."</td><td>".$opciones['Nombre']."</td><td>".$opciones['Fecha']."</td><td>".$opciones['TotalAprox']."</td><td>".$opciones['Estado']."</td>";
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
<div class="container"><h1>CONSULTA Detalles de Devolución <br> de Productos de Mantenimiento</h1></div>
    <br>  
    <?php
          $consulta = "SELECT D.IdRequisicion, P.Descripcion, D.Cantidad, D.CantidadSurtida, D.CantidadDevuelta, D.CostoAprox FROM detallerequisicionproductos as D INNER JOIN productos as P ON
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
                            <th>IdRequisicion</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Cantidad Surtida</th>
                            <th>Cantidad Devuelta</th>
                            <th>CostoAprox</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdRequisicion']."</td><td>".$opciones['Descripcion']."</td><td>".$opciones['Cantidad']."</td><td>".$opciones['CantidadSurtida']."</td><td>".$opciones['CantidadDevuelta']."</td><td>".$opciones['CostoAprox']."</td>";
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
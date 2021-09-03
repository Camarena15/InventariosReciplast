<?php require_once "../../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include '../../rsc/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA Cajas de Herramientas</h1></div>
    <br>  
    <?php
          $consulta = "SELECT C.IdCaja, C.IdEmpleado, E.Nombre, C.FechaAsigna FROM cajaherramientas AS C INNER JOIN empleados AS E ON 
          C.IdEmpleado = E.IdEmpleado";
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
                            <th>IdCaja</th>
                            <th>IdEmpleado</th>
                            <th>Nombre Empleado</th>
                            <th>Fecha Asignación</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdCaja']."</td><td>".$opciones['IdEmpleado']."</td><td>".$opciones['Nombre']."</td><td>".$opciones['FechaAsigna']."</td>";
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
<div class="container"><h1>CONSULTA Detalles de Cajas de Herramientas</h1></div>
    <br>  
    <?php
          $consulta = "SELECT D.IdCaja, P.Descripcion, D.Cantidad FROM detallecajaherramientas as D INNER JOIN productos as P ON
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
                            <th>IdCaja</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdCaja']."</td><td>".$opciones['Descripcion']."</td><td>".$opciones['Cantidad']."</td>";
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
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "../../vistas/parte_inf.php"?>
<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA de Vales Consumibles</h1></div>
    <br>  
    <?php
          $consulta = "SELECT `IdValeCons`,`IdRequisicion`, E.Nombre, `IdEmpleadoRecibe`,`FechaEmision`,`FechaSurte`,`Motivo` FROM 
          `valesconsumibles` AS V INNER JOIN `empleados` AS E ON V.IdEmpleadoRecibe = E.IdEmpleado WHERE 1";
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
                            <th>IdValeCons</th>
                            <th>IdRequisicion</th>
                            <th>IdEmpleadoRecibe</th>
                            <th>Nombre Empleado Recibe</th>
                            <th>Fecha de Emisión</th>
                            <th>Fecha Surte</th>
                            <th>Motivo</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdValeCons']."</td><td>".$opciones['IdRequisicion']."</td><td>".$opciones['IdEmpleadoRecibe']."</td>";
        echo "<td>".$opciones['Nombre']."</td><td>".$opciones['FechaEmision']."</td><td>".$opciones['FechaSurte']."</td><td>".$opciones['Motivo']."</td>";
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
<div class="container"><h1>CONSULTA Detalles de Vales Consumibles</h1></div>
    <br>  
    <?php
          $consulta = "SELECT D.IdValeCons, P.Descripcion, D.Cantidad FROM detvalesconsumibles as D INNER JOIN productos as P ON
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
                            <th>IdValeCons</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdValeCons']."</td><td>".$opciones['Descripcion']."</td><td>".$opciones['Cantidad']."</td>";
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
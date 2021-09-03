<?php require_once "../../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include '../../rsc/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA de Vales Consumibles</h1></div>
    <br>  
    <?php
          $consulta = "SELECT `IdValeCons`,`IdEmpleadoAutoriza`, E.Nombre, `IdEmpleadoRecibe`,`FechaEmision`,`FechaSurte`,`Motivo`,V.Estado FROM 
          `valesconsumibles` AS V INNER JOIN `empleados` AS E ON V.IdEmpleadoAutoriza = E.IdEmpleado WHERE 1";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          $consulta2 = "SELECT E.Nombre FROM `valesconsumibles` AS V INNER JOIN `empleados` AS E ON E.IdEmpleado = V.IdEmpleadoRecibe";
          $resultado = $conexion->prepare($consulta2);
          $resultado->execute();
          $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaP" class="table table-hover  table-dark" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>IdValeCons</th>
                            <th>IdEmpleadoAutoriza</th>
                            <th>Nombre Empleado Autoriza</th>
                            <th>IdEmpleadoRecibe</th>
                            <th>Nombre Empleado Recibe</th>
                            <th>Fecha de Emisión</th>
                            <th>Fecha Surte</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        $NombreRecibe = implode($data2[0]);
        echo "<tr>";
        echo "<td>".$opciones['IdValeCons']."</td><td>".$opciones['IdEmpleadoAutoriza']."</td><td>".$opciones['Nombre']."</td><td>".$opciones['IdEmpleadoRecibe']."</td>";
        echo "<td>".$NombreRecibe."</td><td>".$opciones['FechaEmision']."</td><td>".$opciones['FechaSurte']."</td><td>".$opciones['Motivo']."</td><td>".$opciones['Estado']."</td>";
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
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "../../vistas/parte_inf.php"?>
<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA Devolución de Productos <br> de Vales Consumibles</h1></div>
    <br>  
    <?php
          $consulta = "SELECT C.IdDevolucion, C.IdRequisicion, C.Fecha FROM devprodvale AS C";
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
                            <th>IdDevolucion</th>
                            <th>IdRequisicion</th>
                            <th>Fecha</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdDevolucion']."</td><td>".$opciones['IdRequisicion']."</td><td>".$opciones['Fecha']."</td>";
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
<div class="container"><h1>CONSULTA Detalles de Devolución <br> de Productos de Vales Consumibles</h1></div>
    <br>  
    <?php
          $consulta = "SELECT D.IdDevolucion, P.Descripcion, D.Cantidad FROM detdevprodvale as D INNER JOIN productos as P ON
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
                            <th>IdDevolucion</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdDevolucion']."</td><td>".$opciones['Descripcion']."</td><td>".$opciones['Cantidad']."</td>";
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
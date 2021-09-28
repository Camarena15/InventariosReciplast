<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container"><h1>CONSULTA Pagos de Compras de Productos</h1></div>
    <br>  
    <?php
          $consulta = "SELECT * FROM pagoscompras WHERE 1";
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
                            <th>IdPago</th>
                            <th>IdCompra</th>
                            <th>Referencia</th>
                            <th>Fecha</th>
                            <th>Importe</th>
                        </tr>  
    <?php
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdPago']."</td><td>".$opciones['IdCompra']."</td><td>".$opciones['Referencia']."</td><td>".$opciones['Fecha']."</td><td>".$opciones['Importe']."</td>";
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
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
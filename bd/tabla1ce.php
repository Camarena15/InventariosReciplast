<?php
include 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();



$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';

$consulta = "SELECT * FROM ordenmanttoint WHERE IdEmpleado ='$ide' AND Estado = '$estado'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();  
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
echo"<thead>";
echo"                <tr>";
echo"                  <th scope='col'>IdOrdenInt</th>";
echo"                  <th scope='col'>IdPrograma</th>";
echo"                    <th scope='col'>IdEmpleado</th>";
echo"                    <th scope='col'>FechaRegistro</th>";
echo"                    <th scope='col'>Descripción</th>";
echo"                    <th scope='col'>FechaEstimada</th>";
echo"                    <th scope='col'>Estado</th>";
echo"                </tr>";
echo"            </thead>";
echo"            <tbody>";
echo"            </tbody>";
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdOrdenInt']."</td><td>".$opciones['IdPrograma']."</td><td>".$opciones['IdEmpleado']."</td><td>".$opciones['FechaRegistro']."</td><td>".$opciones['Descripcion']."</td><td>".$opciones['FechaEstimadaEntrega']."</td><td>".$opciones['Estado']."</td>";
        echo "</tr>";
    }
endforeach;
    ?>
<?php
include 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$ide = (isset($_POST['ide'])) ? $_POST['ide'] : '';
$fi = (isset($_POST['fi'])) ? $_POST['fi'] : '';
$ff = (isset($_POST['ff'])) ? $_POST['ff'] : '';

if ($ide != 0)
	    $sql="SELECT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN empleados AS E ON R.IdEmpleadoSolicita = E.IdEmpleado WHERE IdEmpleadoSolicita ='$ide' AND Fecha BETWEEN '$fi' AND '$ff' AND R.Estado='Planeación'";
    else
        $sql="SELECT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN empleados AS E ON R.IdEmpleadoSolicita = E.IdEmpleado WHERE Fecha BETWEEN '$fi' AND '$ff' AND R.Estado='Planeación'";
$resultado = $conexion->prepare($sql);
$resultado->execute();  
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
echo"<thead>";
echo"                <tr>";
echo"                  <th scope='col'>IdRequisicion</th>";
echo"                  <th scope='col'>IdEmpleadoSolicita</th>";
echo"                    <th scope='col'>Nombre</th>";
echo"                    <th scope='col'>Fecha</th>";
echo"                    <th scope='col'>TotalAprox</th>";
echo"                    <th scope='col'>Estado</th>";
echo"                </tr>";
echo"            </thead>";
echo"            <tbody>";
echo"            </tbody>";
    foreach ($data as $opciones):
    {
        echo "<tr>";
        echo "<td>".$opciones['IdRequisicion']."</td><td>".$opciones['IdEmpleadoSolicita']."</td><td>".$opciones['Nombre']."</td><td>".$opciones['Fecha']."</td><td>".$opciones['TotalAprox']."</td><td>".$opciones['Estado']."</td>";
        echo "</tr>";
    }
endforeach;
    ?>
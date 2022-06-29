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
$sql = $sql . " ORDER BY R.IdRequisicion DESC";
if ($fi == "2000-00-00")
$sql = $sql . " LIMIT 50";

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
echo"                    <th scope='col'>Ejecutar</th>";
echo"                    <th scope='col'>Cancelar</th>";
echo"                </tr>";
echo"            </thead>";
echo"            <tbody>";
echo"            </tbody>";
$idreq = 0;
    foreach ($data as $opciones):
    {
        $idreq = $opciones['IdRequisicion'];
        echo "<tr>";
        echo "<td>".$idreq."</td><td>".$opciones['IdEmpleadoSolicita']."</td><td>".$opciones['Nombre']."</td><td>".$opciones['Fecha']."</td><td>".$opciones['TotalAprox']."</td><td>".$opciones['Estado']."</td>";
        echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-success btn-sm btnEjecutar' onclick='registrar2($idreq)'><i class='material-icons'>Ejecutar</i></button></td>";
        echo "<td><div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnCancelar' onclick='registrar3($idreq)'><i class='material-icons'>Cancelar</i></button></td>";
        echo "</tr>";
    }
endforeach;
    ?>
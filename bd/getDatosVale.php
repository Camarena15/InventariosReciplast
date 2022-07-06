<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$vale=$_POST['vale'];

	$sql="SELECT E.Nombre, R.*
		from valesconsumibles AS R INNER JOIN empleados as E ON R.IdEmpleadoRecibe = E.IdEmpleado
		where R.IdValeCons='$vale'";

$result=mysqli_query($conexion,$sql);
    $cad='<div class="container caja">
    <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive">        
            <table id="tablaP" class="table table-hover  table-dark" style="width:100%" ><thead class="text-center">'
    ."                <tr>"
    ."                  <th scope='col'>IdVale</th>"
    ."                  <th scope='col'>IdEmpleadoRecibe</th>"
    ."                    <th scope='col'>Nombre</th>"
    ."                    <th scope='col'>Fecha</th>"
    ."                    <th scope='col'>Motivo</th>"
    ."                </tr>"
    ."            </thead>"
    ."            <tbody>"
    ."            </tbody>"; 
	while ($ver=mysqli_fetch_row($result)) {
        $cad = $cad . "<tr>"
        . "<td>".$ver[1]."</td><td>".$ver[2]."</td><td>".$ver[0]."</td><td>".$ver[3]."</td><td>".$ver[4]."</td>"
        . "</tr>";  
	}
    $cad = $cad . "</table>"
        ."</thead>"
        . "<tbody> "                         
        . "</tbody>"        
        . "</table>"               
        . "</div>"
        . "</div>"
        . "</div>"  
        . "</div>";  
	echo  $cad;
	

?>
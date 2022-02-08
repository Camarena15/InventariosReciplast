<?php 
require("datos_conexion.php");
//conectar por PROCEDIMIENTOS
$conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);
$requisicion=$_POST['requisicion'];

	$sql="SELECT E.Nombre, R.*
		from requisicionesproductos AS R INNER JOIN empleados as E ON R.IdEmpleadoSolicita = E.IdEmpleado
		where IdRequisicion='$requisicion'";

$result=mysqli_query($conexion,$sql);
    $cad='<div class="container caja">
    <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive">        
            <table id="tablaP" class="table table-hover  table-dark" style="width:100%" ><thead class="text-center">'
    ."                <tr>"
    ."                  <th scope='col'>IdRequisicion</th>"
    ."                  <th scope='col'>IdEmpleadoSolicita</th>"
    ."                    <th scope='col'>Nombre</th>"
    ."                    <th scope='col'>Fecha</th>"
    ."                    <th scope='col'>TotalAprox</th>"
    ."                    <th scope='col'>Estado</th>"
    ."                </tr>"
    ."            </thead>"
    ."            <tbody>"
    ."            </tbody>"; 
	while ($ver=mysqli_fetch_row($result)) {
        $cad = $cad . "<tr>"
        . "<td>".$ver[1]."</td><td>".$ver[2]."</td><td>".$ver[0]."</td><td>".$ver[3]."</td><td>".$ver[5]."</td><td>".$ver[4]."</td>"
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
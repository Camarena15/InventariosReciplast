<?php 
$conexion=mysqli_connect('db5003537921.hosting-data.io:3306','dbu1577258','w52NXfdnj.isC2B','dbs2878085');
$compra=$_POST['compra'];

	$sql="SELECT R.IdCompra, E.IdProveedor, E.NombreP, R.Condiciones, R.Factura, R.Fecha, R.FechaVto, R.Saldo, R.IdProveedor
		from comprasproductos AS R INNER JOIN proveedores as E ON R.IdProveedor = E.IdProveedor
		where IdCompra='$compra'";

$result=mysqli_query($conexion,$sql);
    $cad='<div class="container caja">
    <div class="row">
        <label class="form-label">Compra Seleccionada:</label>
        <div class="col-lg-12">
        <div class="table-responsive">        
            <table id="tablaP" class="table table-hover " style="width:100%" ><thead class="text-center">'
    ."                <tr>"
    ."                  <th scope='col'>IdCompra<br>-</th>"
    ."                  <th scope='col'>IdProveedor<br>-</th>"
    ."                    <th scope='col'>Nombre<br> Proveedor</th>"
    ."                    <th scope='col' style='color:red;'>Condiciones<br>-</th>"
    ."                    <th scope='col'>Factura<br>-</th>"
    ."                    <th scope='col'>Fecha<br> Registro</th>"
    ."                    <th scope='col'>Fecha<br> Vencimiento</th>"
    ."                    <th scope='col'>Importe<br>-</th>"
    ."                </tr>"
    ."            </thead>"
    ."            <tbody>"
    ."            </tbody>"; 
    $max = 0;
    $cond = "";
    $prov = 0;
	while ($ver=mysqli_fetch_row($result)) {
        $cad = $cad . "<tr>"
        . "<td>".$ver[0]."</td><td>".$ver[1]."</td><td>".$ver[2]."</td><td style='font-weight: bold;'>".$ver[3]."</td><td>".$ver[4]."</td><td>".$ver[5]."</td><td>".$ver[6]."</td><td style='font-weight: bold;'>".$ver[7]."</td>"
        . "</tr>";  
        $max = $ver[7];
        $cond = $ver[3];
        $prov=$ver[8];
	}
    $cad = $cad . "</table>"
        ."</thead>"
        . "<tbody> "                         
        . "</tbody>"        
        . "</table>"               
        . "</div>"
        . "</div>"
        . "</div>"  
        . "</div>"
        . '<br><br><br>
        <div class="row">
            <div class="form-group col-md-3" id="">
                <label for="" class="form-label">Fecha: </label>
                <input type="date" class="form-control" id="Fecha" >
            </div>
            <div class="form-group col-md-3" id="">
                <label class="form-label">Referencia:</label>
                <input type="text" class="form-control" id="Referencia" maxlength="11">
            </div>
            <div class="form-group col-md-3" id="">
                <label class="form-label">Importe a pagar:</label>';

        if($cond == "Contado"){
            $cad = $cad . '<input type="number" class="form-control" id="Importe" min="' . $max . '" max="' . $max . '" value="' . $max . '">';
        }else{
            $cad = $cad . '<input type="number" class="form-control" id="Importe" min="0" max="' . $max . '">';
            $cad = $cad . '<input type="text" id="Condiciones" value="' . $cond . '" hidden>';
        }
        $cad = $cad . '<input type="text" id="Proveedor" value="' . $prov . '" hidden>';
    $cad = $cad . '</div></div>';  
	echo  $cad;
	

?>
<?php 
$conexion=mysqli_connect('localhost','root','','mantenimiento');
$idmov=$_POST['idmov'];
$opcion=$_POST['opcion'];

switch($opcion){
    case 1:  

        $sql="SELECT D.IdCompra, P.Descripcion, D.Cantidad, D.Costo FROM detallecompraprod AS D INNER JOIN productos as P ON D.IdProducto = P.IdProducto 
        WHERE IdCompra='$idmov'";

        $result=mysqli_query($conexion,$sql);
            $cad='<div class="container caja">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaP2" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>IdCompra <br>-</th>
                                    <th>Producto <br>-</th>
                                    <th>Cantidad <br>-</th>
                                    <th>Costo <br> Unitario</th>
                                </tr>'
            ."            </thead>"
            ."            <tbody>"
            ."            </tbody>"; 
            while ($ver=mysqli_fetch_row($result)) {
                $cad = $cad . "<tr>"
                . "<td>".$ver[0]."</td><td>".$ver[1]."</td><td>".$ver[2]."</td><td>".$ver[3]."</td>"
                . "</tr>";  
            }
            $cad = $cad . "</table>"
                ."</thead>"
                . "<tbody> "                         
                . "</tbody>"        
                . "</table>"               
                . "</div>"
                . "</div>";
            $cad = $cad . '</div></div>';  
            echo  $cad;

        break;
    case 2:

        $sql="SELECT D.IdDevolucion, P.Descripcion, D.Cantidad FROM detdevprodvale AS D INNER JOIN productos as P ON D.IdProducto = P.IdProducto 
        WHERE IdDevolucion='$idmov'";

        $result=mysqli_query($conexion,$sql);
            $cad='<div class="container caja">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaP2" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>IdDevolución <br>-</th>
                                    <th>Producto <br>-</th>
                                    <th>Cantidad <br>-</th>
                                </tr>'
            ."            </thead>"
            ."            <tbody>"
            ."            </tbody>"; 
            while ($ver=mysqli_fetch_row($result)) {
                $cad = $cad . "<tr>"
                . "<td>".$ver[0]."</td><td>".$ver[1]."</td><td>".$ver[2]."</td>"
                . "</tr>";  
            }
            $cad = $cad . "</table>"
                ."</thead>"
                . "<tbody> "                         
                . "</tbody>"        
                . "</table>"               
                . "</div>"
                . "</div>";
            $cad = $cad . '</div></div>';  
            echo  $cad;

        break;
    case 3:
        $sql="SELECT D.IdRequisicion, P.Descripcion, D.Cantidad, D.CantidadSurtida, D.CantidadDevuelta, D.CostoAprox FROM detallerequisicionproductos as D INNER JOIN productos as P ON
        D.IdProducto = P.IdProducto 
        WHERE D.IdRequisicion='$idmov'";

        $result=mysqli_query($conexion,$sql);
            $cad='<div class="container caja">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaP2" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>IdRequisicion</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Cantidad Surtida</th>
                                    <th>Cantidad Devuelta</th>
                                    <th>CostoAprox</th>
                                </tr>'
            ."            </thead>"
            ."            <tbody>"
            ."            </tbody>"; 
            while ($ver=mysqli_fetch_row($result)) {
                $cad = $cad . "<tr>"
                . "<td>".$ver[0]."</td><td>".$ver[1]."</td><td>".$ver[2]."</td>"
                . "<td>".$ver[3]."</td><td>".$ver[4]."</td><td>".$ver[5]."</td>"
                . "</tr>";  
            }
            $cad = $cad . "</table>"
                ."</thead>"
                . "<tbody> "                         
                . "</tbody>"        
                . "</table>"               
                . "</div>"
                . "</div>";
            $cad = $cad . '</div></div>';  
            echo  $cad;
        break;
        case 4:
            $sql="SELECT D.IdValeCons, P.Descripcion, D.Cantidad FROM detvalesconsumibles as D INNER JOIN productos as P ON
            D.IdProducto = P.IdProducto  
        WHERE IdValeCons='$idmov'";

        $result=mysqli_query($conexion,$sql);
            $cad='<div class="container caja">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaP2" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>IdValeCons <br>-</th>
                                    <th>Producto <br>-</th>
                                    <th>Cantidad <br>-</th>
                                </tr>'
            ."            </thead>"
            ."            <tbody>"
            ."            </tbody>"; 
            while ($ver=mysqli_fetch_row($result)) {
                $cad = $cad . "<tr>"
                . "<td>".$ver[0]."</td><td>".$ver[1]."</td><td>".$ver[2]."</td>"
                . "</tr>";  
            }
            $cad = $cad . "</table>"
                ."</thead>"
                . "<tbody> "                         
                . "</tbody>"        
                . "</table>"               
                . "</div>"
                . "</div>";
            $cad = $cad . '</div></div>';  
            echo  $cad;

        break;
            break;

}


	

?>
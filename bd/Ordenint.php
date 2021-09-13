<?php
session_start();
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$data = json_decode($_POST['arregloId']);
var_dump($data);
$max=sizeof($data); 



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $IdOrden = (isset($_POST['idorden'])) ? $_POST['idorden'] : '';
        $IdPrograma = (isset($_POST['idprogra'])) ? $_POST['idprogra'] : '';
        $IdEmpleado = (isset($_POST['idempleado'])) ? $_POST['idempleado'] : '';
        $FechaRegistro = (isset($_POST['fechar'])) ? $_POST['fechar'] : '';
        $FechaEntrega = (isset($_POST['fechae'])) ? $_POST['fechae'] : '';
        $DescripcionMantto = (isset($_POST['descmantto'])) ? $_POST['descmantto'] : '';
        $Estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
        $consulta2 = "INSERT INTO ordenmanttoint(IdOrdenInt, IdPrograma, IdEmpleado, FechaRegistro, Descripcion, FechaEstimadaEntrega, Estado) VALUES ('$IdOrden','$IdPrograma','$IdEmpleado','$FechaRegistro','$DescripcionMantto','$FechaEntrega', 'Planeacion')";		
        $resultado1 = $conexion->prepare($consulta2);
        $resultado1->execute(); 
        $c=0;
        for($i = 0; $i<=$max; $i+=3){
            $IdProducto[$c] = $data[$i];
            $Cantidad[$c] = $data[$i+1];
            $Precio[$c] = $data[$i+2];
            $consulta = "INSERT INTO detallemanttoint (IdOrdenInt, IdProducto, Cantidad, Costo, CantidadSurtida, Estado) VALUES($IdOrden, $IdProducto[$c], $Cantidad[$c], $Precio[$c], 0, 'N') ";	
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 	
            $c++;
        }
        break;
    case 2:        
        $IdOrden = (isset($_POST['idorden'])) ? $_POST['idorden'] : '';
        $Estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
        $IdPrograma = (isset($_POST['idprogra'])) ? $_POST['idprogra'] : '';
        $IdEmpleado = (isset($_POST['idempleado'])) ? $_POST['idempleado'] : '';
        $FechaRegistro = (isset($_POST['fechar'])) ? $_POST['fechar'] : '';
        $FechaEntrega = (isset($_POST['fechae'])) ? $_POST['fechae'] : '';
        $DescripcionMantto = (isset($_POST['descmantto'])) ? $_POST['descmantto'] : '';
        $consulta = "UPDATE ordenmanttoint SET IdPrograma = '$IdPrograma', IdEmpleado = '$IdEmpleado', FechaRegistro='$FechaRegistro', Descripcion = '$DescripcionMantto', FechaEstimadaEntrega = '$FechaEntrega', Estado = '$Estado' WHERE IdOrdenInt='$IdOrden' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 3:    
        $IdOrden = (isset($_POST['idorden'])) ? $_POST['idorden'] : '';
        $Estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
        if($Estado == 'Planeacion'){
            $consulta = "UPDATE ordenmanttoint SET  Estado = 'Programada' WHERE IdOrdenInt='$IdOrden' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();   
        }
        else if ($Estado == 'Programada'){
            $consulta = "UPDATE ordenmanttoint SET  Estado = 'Ejecucion' WHERE IdOrdenInt='$IdOrden' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }     
        break;
    case 4:
        $IdOrden = (isset($_POST['idorden'])) ? $_POST['idorden'] : '';
        $Fechav = (isset($_POST['fechav'])) ? $_POST['fechav'] : '';
        $IdVale = (isset($_POST['idvale'])) ? $_POST['idvale'] : '';
        $consulta = "INSERT INTO valesordenmanttoint (IdVale, IdOrdenInt, Fecha) VALUES ($IdVale, $IdOrden, '$Fechav')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $c=0;
        for($i = 0; $i<=$max; $i+=2){
            $IdProducto[$c] = $data[$i];
            $Idproductox = $IdProducto[$c];
            $CantidadN[$c] = $data[$i+1];
            $Cantidadx = $CantidadN[$c];
            //Obtener la cantidad necesaria del producto de la orden x
            $consulta = "SELECT Cantidad FROM detallemanttoint WHERE IdOrdenInt = $IdOrden AND IdProducto= $Idproductox";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $Cantidad=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($Cantidad as $opciones):
                $c1= $opciones['Cantidad'];
            endforeach; 
            //Obtener la cantidad surtida del producto de la orden x
            $consulta = "SELECT CantidadSurtida FROM detallemanttoint WHERE IdOrdenInt = $IdOrden AND IdProducto= $Idproductox";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $CantidadS=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($Cantidad as $opciones):
                $c2= $opciones['CantidadSurtida'];
            endforeach; 
            if($Cantidadx<=($c1-$c2)){
                //Si la cantidad proporcionada es menor a la cantidad - cantidad surtida en la orden
                $consulta = "INSERT INTO detallevales (IdVale, IdProducto, Cantidad) VALUES ($IdVale, $Idproductox, $Cantidadx)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                $consulta = "UPDATE productos SET  Existencia = Existencia - $Cantidadx WHERE  IdProducto = $Idproductox";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                $consulta = "UPDATE detallemanttoint SET  CantidadSurtida = CantidadSurtida + $Cantidadx WHERE IdOrdenInt=$IdOrden AND IdProducto = $Idproductox";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            } 
            if($c1==$c2){
                //Actualizar estado surtido si la cantidad surtida es igual a la cantidad necesitada
                $consulta = "UPDATE detallemanttoint SET  Estado = 'S' WHERE IdOrdenInt= $IdOrden AND IdProducto = $Idproductox";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }
            $c++;
        }
    break;  
    case 5:
        $IdOrden = (isset($_POST['idorden'])) ? $_POST['idorden'] : '';
        $Fechafmi = (isset($_POST['fechafmi'])) ? $_POST['fechafmi'] : '';
        $Observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';
        $Duracion = (isset($_POST['duracion'])) ? $_POST['duracion'] : '';
        $consulta = "INSERT INTO finmanttoint (IdOrdenInt, Fecha, Observaciones, DuracionHoras) VALUES($IdOrden, '$Fechafmi', '$Observaciones', $Duracion)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta = "UPDATE ordenmanttoint SET  Estado = 'Terminada' WHERE IdOrdenInt='$IdOrden' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();         
        break;
    case 6:
        $IdDevolucion = (isset($_POST['iddevolucion'])) ? $_POST['iddevolucion'] : '';
        $FechaD = (isset($_POST['fechad'])) ? $_POST['fechad'] : '';
        $IdVale = (isset($_POST['idvale'])) ? $_POST['idvale'] : '';
        $consulta = "INSERT INTO devoluciones (IdDevolucion, IdVale, Fecha) VALUES ($IdDevolucion, $IdVale, '$FechaD')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $c=0;
        for($i = 0; $i<=$max; $i+=2){
            $IdProducto[$c] = $data[$i];
            $Idproductox = $IdProducto[$c];
            $CantidadN[$c] = $data[$i+1];
            $Cantidadx = $CantidadN[$c];
            $consulta = "INSERT INTO detalledevolucion (IdDevolucion, IdProducto, Cantidad) VALUES ($IdDevolucion, $Idproductox, $Cantidadx)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $consulta = "UPDATE productos SET  Existencia = Existencia + $Cantidadx WHERE  IdProducto = $Idproductox";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $c++;
        }
        break;
    case 7:
        $IdOrden = (isset($_POST['idorden'])) ? $_POST['idorden'] : '';
        $Estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
        $consulta = "UPDATE ordenmanttoint SET  Estado = 'Cancelada' WHERE IdOrdenInt='$IdOrden' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        break;

}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
<?php
date_default_timezone_set('America/Mexico_City');
include "rsc/fpdf/fpdf.php";
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Logo
		$this->Image('rsc/css/img/Icon.jpg',177,0,30);
		// Arial bold 15
		$this->SetFont('Arial','',12);
		// Movernos a la derecha
		$this->Cell(50);
		// Título
		$this->Cell(40,10,'Reciplast de Occidente, S.P.R. de R.L. de C.V.',0,1,'R');
		$this->SetFont('Arial','B',12);
		$titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
		$this->Cell(0,10,utf8_decode($titulo),0,0,'C');
		// Salto de línea
		$this->Ln(15);
	}

	// Pie de página
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

	// Tabla coloreada
	function FancyTable($header, $w)
	{
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(148,148,148);
		$this->SetTextColor(255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Cabecera
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Restauración de colores y fuentes
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		
	}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
	switch($opcion){
		case 1: //RELACIÓN DE EXISTENCIAS DE PRODUCTOS POR CATEGORÍA
			#region Busqueda
			$IdSubCategoria = (isset($_POST['IdSubCategoria'])) ? $_POST['IdSubCategoria'] : '';
			$sql="SELECT DescripcionSC FROM SubCategorias WHERE IdSubCategoria=$IdSubCategoria";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data as $opciones):{
				$pdf->Cell(0,0,'Categoria=' . $opciones['DescripcionSC'],0,1,'L');
				$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
				$pdf->Cell(0,0,'                 ______________',0,0,'L');
				$pdf->Cell(0,10,'',0,1);
			}endforeach;
			$pdf->SetFont('Times','',7);
			$sql="SELECT * FROM productos WHERE IdSubCategoria=$IdSubCategoria";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			#endregion
			#region Tabla
			$header = array('IdProducto', 'IdSubCategoria', 'Descripcion', 'Max', 'Min', 'Punto Reorden', 'Costo Prom.', 'Ultimo Costo', 'Unidad Medida', 'Marca', 'Modelo', 'No. Parte','Existencia');
			$w = array(14,14,28,8,8,14,14,14,14,14,14,14,14);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				foreach($data as $opciones)
				{
					$pdf->Cell($w[0],6,$opciones['IdProducto'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,$opciones['IdSubCategoria'],'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['Descripcion']), 0, 20) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,$opciones['Maximo'],'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,$opciones['Minimo'],'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['PuntoReorden'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,$opciones['CostoProm'],'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,$opciones['UltCosto'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['UnidadMedida'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,$opciones['Marca'],'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,substr($opciones['Modelo'], 0, 6) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[11],6,$opciones['NoParte'],'LR',0,'C',$fill);
					$pdf->Cell($w[12],6,$opciones['Existencia'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
			#endregion
			break;
		case 2: //Lista de productos a surtir
			#region Busqueda
			$IdSubCategoria = (isset($_POST['IdSubCategoria'])) ? $_POST['IdSubCategoria'] : '';
			$sql="SELECT DescripcionSC FROM SubCategorias WHERE IdSubCategoria=$IdSubCategoria";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data as $opciones):{
				$pdf->Cell(0,0,'Categoria=' . utf8_decode($opciones['DescripcionSC']),0,1,'L');
				$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
				$pdf->Cell(0,0,'                 ______________',0,0,'L');
				$pdf->Cell(0,10,'',0,1);
			}endforeach;
			$pdf->SetFont('Times','',7);
			$sql="SELECT * FROM productos WHERE IdSubCategoria=$IdSubCategoria AND Existencia Between 0 AND Minimo";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			#endregion
			#region Tabla
			$header = array('IdProducto', 'IdSubCategoria', 'Descripcion', 'Maximo', 'Minimo', 'Punto Reorden', 'Costo Prom.', 'Ultimo Costo', 'Unidad Medida', 'Marca', 'Modelo', 'No. Parte','Existencia');
			$w = array(14,14,14,14,14,14,14,14,14,14,14,14,14);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				foreach($data as $opciones)
				{
					$pdf->Cell($w[0],6,$opciones['IdProducto'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,$opciones['IdSubCategoria'],'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['Descripcion']), 0, 10) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,$opciones['Maximo'],'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,$opciones['Minimo'],'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['PuntoReorden'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,$opciones['CostoProm'],'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,$opciones['UltCosto'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['UnidadMedida'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,$opciones['Marca'],'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,$opciones['Modelo'],'LR',0,'C',$fill);
					$pdf->Cell($w[11],6,$opciones['NoParte'],'LR',0,'C',$fill);
					$pdf->Cell($w[12],6,$opciones['Existencia'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
			#endregion
			break;
		case 3:
			#region Busqueda
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->SetFont('Times','',7);
			$sql="SELECT * FROM proveedores WHERE 1";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			#endregion
			#region Tabla
			$pdf->Ln(10);
			$header = array('ID', 'Nombre', 'Domicilio', 'Colonia', 'Ciudad', 'CP', 'Estado', 'Tel', 'Celular', 'Representante', 'Descripcion TipoProv', 'Saldo');
			$w = array(5,25,25,25,15,8,10,13,13,25,15,10);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				$saldototal = 0;
				foreach($data as $opciones)
				{
					$saldototal += $opciones['Saldo'];
					$pdf->Cell($w[0],6,$opciones['IdProveedor'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,substr(utf8_decode($opciones['NombreP']), 0, 15) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['Domicilio']), 0, 16) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,substr(utf8_decode($opciones['Colonia']), 0, 15) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,substr(utf8_decode($opciones['Ciudad']), 0, 10) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['CP'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,utf8_decode($opciones['Estado']),'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,$opciones['Tel'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['Celular'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,substr(utf8_decode($opciones['Representante']), 0, 15) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,substr(utf8_decode($opciones['DescripcionTipoProv']), 0, 10) . "..",'LR',0,'C',$fill);
					$pdf->Cell($w[11],6,$opciones['Saldo'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				$pdf->Cell(array_sum($w),0,'','T',1);
				$pdf->Cell(10,6,'TOTAL:','LR',0,'C',$fill);
				$pdf->Cell(179,6,'$' . $saldototal,'LR',1,'R',$fill);
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
				
			#endregion
			break;
		case 4:
			#region Busqueda
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->SetFont('Times','',7);
			$pdf->Ln(5);
			$sql="SELECT E.*, A.DescripcionA as Area, P.DescripcionP as Puesto FROM empleados as E INNER JOIN area as A ON E.IdArea = A.IdArea INNER JOIN puestos as P 
			ON P.IdPuesto = E.IdPuesto WHERE Estado='Activo' Order By A.DescripcionA, P.DescripcionP, E.Nombre";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			#endregion
			#region Tabla
			//$header = array('IdEmpleado', 'Area', 'Puesto', 'Nombre', 'Fecha Nac.', /*'Domicilio', 'Colonia',*/ 'Ciudad', 'CP', /*'Edo', 'Tel',*/ 'Celular','Estado');
			$header = array('IdEmpleado', 'Area', 'Puesto', 'Nombre', 'Fecha Nac.','Ciudad', 'CP','Edo','Celular','Estado');
			//$w = array(10,20,22,40,14,/*17,17,*/15,8,/*14,14,*/14,14);
			$w = array(10,20,22,45,14,17,17,14,15,8);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				foreach($data as $opciones)
				{
					$pdf->Cell($w[0],6,$opciones['IdEmpleado'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,utf8_decode($opciones['Area']),'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['Puesto']),0,18),'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,substr(utf8_decode($opciones['Nombre']),0,30),'LR',0,'L',$fill);
					$pdf->Cell($w[4],6,$opciones['FechaNac'],'LR',0,'C',$fill);
					//$pdf->Cell($w[5],6,utf8_decode($opciones['Domicilio']),'LR',0,'C',$fill);
					//$pdf->Cell($w[6],6,utf8_decode($opciones['Colonia']),'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,utf8_decode($opciones['Ciudad']),'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,$opciones['CP'],'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,utf8_decode($opciones['Edo']),'LR',0,'C',$fill);
					//$pdf->Cell($w[10],6,$opciones['Tel'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['Celular'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,$opciones['Estado'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
			#endregion
			break;
		case 5:
			#region Busqueda
			$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
				$pdf->Cell(0,0,'Estado=' . $Estado,0,1,'L');
				$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
				$pdf->Cell(0,0,'             ___________',0,0,'L');
				$pdf->Cell(0,10,'',0,1);
			$pdf->SetFont('Times','',7);
			$sql="SELECT R.*, E.Nombre, P.DescripcionP as Puesto, D.IdProducto, PR.Descripcion, D.CostoAprox FROM requisicionesproductos as R INNER JOIN empleados as E ON R.IdEmpleadoSolicita = E.IdEmpleado 
			INNER JOIN puestos as P ON E.IdPuesto = P.IdPuesto INNER JOIN detallerequisicionproductos as D ON D.IdRequisicion = R.IdRequisicion 
			INNER JOIN productos as PR ON PR.IdProducto = D.IdProducto WHERE R.Estado='$Estado'";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			#endregion
			#region Tabla
			$header = array('IdRequisicion', 'IdEmpleado', 'Puesto', 'Nombre', 'Fecha', 'TotalAprox', 'IdProducto', 'Descripcion', 'CostoAprox', 'Estado');
			$w = array(16,14,18,40,14,16,14,24,18,18);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				foreach($data as $opciones)
				{
					$pdf->Cell($w[0],6,$opciones['IdRequisicion'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,$opciones['IdEmpleadoSolicita'],'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['Puesto']),0,15),'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,substr(utf8_decode($opciones['Nombre']),0,27),'LR',0,'L',$fill);
					$pdf->Cell($w[4],6,$opciones['Fecha'],'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['TotalAprox'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,$opciones['IdProducto'],'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,substr(utf8_decode($opciones['Descripcion']),0,20),'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['CostoAprox'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['Estado'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
			#endregion
			break;
		case 6: 
			#region Busqueda
			$FI = (isset($_POST['FI'])) ? $_POST['FI'] : '';
			$FF = (isset($_POST['FF'])) ? $_POST['FF'] : '';
			$sql="SELECT C.*, P.NombreP FROM comprasproductos AS C INNER JOIN proveedores as P ON C.IdProveedor = P.IdProveedor 
			WHERE C.Fecha BETWEEN '$FI' AND '$FF'";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			$FechaI = strtotime($FI);
			$FI = date("d/m/Y", $FechaI);
			$FechaF = strtotime($FF);
			$FF = date("d/m/Y", $FechaF);
			$pdf->Cell(0,0,'DE: ' . $FI . " A: " . $FF,0,1,'L');
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->Cell(0,0,'       __________    __________',0,0,'L');
			$pdf->Cell(0,10,'',0,1);
			$pdf->SetFont('Times','',7);
			#endregion
			#region Tabla
			$pdf->Ln(10);
			$header = array('IdCompra', 'IdProveedor', 'Nombre', 'Factura', 'Condiciones', 'Fecha', 'FechaVto', 'Subtotal', 'Iva', 'Total', 'Saldo');
			$w = array(13,16,48,16,14,13,13,13,13,13,13);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				$saldototal = 0;
				$compratotal = 0;
				foreach($data as $opciones)
				{
					$saldototal += $opciones['Saldo'];
					$compratotal += $opciones['Total'];
					$pdf->Cell($w[0],6,$opciones['IdCompra'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,$opciones['IdProveedor'],'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['NombreP']),0,31),'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,$opciones['Factura'],'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,utf8_decode($opciones['Condiciones']),'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['Fecha'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,$opciones['FechaVto'],'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,$opciones['Subtotal'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['Iva'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,$opciones['Total'],'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,$opciones['Saldo'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				$pdf->Cell(array_sum($w),0,'','T',1);
				$pdf->Cell(13,6,'TOTAL:','LR',0,'C',$fill);
				$pdf->Cell(146,6,'','LR',0,'R',$fill);
				$pdf->Cell(13,6,'$' . $compratotal,'LR',0,'R',$fill);
				$pdf->Cell(13,6,'$' . $saldototal,'LR',1,'R',$fill);
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
				
			#endregion
			break;
		case 7:
			#region Busqueda
			$FI = date("Y-m-d");
			$FF = date("Y-m-d",strtotime($FI."+ 7 days"));
			$sql="SELECT C.*, P.NombreP FROM comprasproductos AS C INNER JOIN proveedores as P ON C.IdProveedor = P.IdProveedor 
			WHERE C.Saldo > 0 AND C.FechaVto BETWEEN '$FI' AND '$FF'";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			$FechaI = strtotime($FI);
			$FI = date("d/m/Y", $FechaI);
			$FechaF = strtotime($FF);
			$FF = date("d/m/Y", $FechaF);
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->SetFont('Times','',7);
			#endregion
			#region Tabla
			$pdf->Ln(10);
			$header = array('IdCompra', 'IdProveedor', 'Nombre', 'Factura', 'Condiciones', 'Fecha', 'FechaVto', 'Subtotal', 'Iva', 'Total', 'Saldo');
			$w = array(13,16,31,16,16,16,16,16,13,16,16);
			$pdf->FancyTable($header,$w);
			// Datos 
				$fill = false;
				$saldototal = 0;
				$compratotal = 0;
				foreach($data as $opciones)
				{
					$saldototal += $opciones['Saldo'];
					$compratotal += $opciones['Total'];
					$pdf->Cell($w[0],6,$opciones['IdCompra'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,$opciones['IdProveedor'],'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,substr(utf8_decode($opciones['NombreP']),0,20),'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,$opciones['Factura'],'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,utf8_decode($opciones['Condiciones']),'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['Fecha'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,$opciones['FechaVto'],'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,$opciones['Subtotal'],'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['Iva'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,$opciones['Total'],'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,$opciones['Saldo'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				$pdf->Cell(array_sum($w),0,'','T',1);
				$pdf->Cell(16,6,'TOTAL:','LR',0,'C',$fill);
				$pdf->Cell(137,6,'','LR',0,'R',$fill);
				$pdf->Cell(16,6,'$' . $compratotal,'LR',0,'C',$fill);
				$pdf->Cell(16,6,'$' . $saldototal,'LR',1,'C',$fill);
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
				
			#endregion
			break;
		case 8:
			#region Busqueda
			$FI = (isset($_POST['FI'])) ? $_POST['FI'] : '';
			$FF = (isset($_POST['FF'])) ? $_POST['FF'] : '';
			$sql="SELECT PA.IdPago, PA.Fecha as FechaPago, PA.Referencia, PA.Importe, C.*, P.NombreP FROM pagoscompras as PA INNER JOIN 
			comprasproductos as C ON PA.IdCompra = C.IdCompra INNER JOIN proveedores as P ON C.IdProveedor = P.IdProveedor 
			WHERE PA.Fecha BETWEEN '$FI' AND '$FF'";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			$FechaI = strtotime($FI);
			$FI = date("d/m/Y", $FechaI);
			$FechaF = strtotime($FF);
			$FF = date("d/m/Y", $FechaF);
			$pdf->Cell(0,0,'DE: ' . $FI . " A: " . $FF,0,1,'L');
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->Cell(0,0,'       __________    __________',0,0,'L');
			$pdf->Cell(0,10,'',0,1);
			$pdf->SetFont('Times','',7);
			#endregion
			#region Tabla
			$header = array('IdPago', 'Fecha de Pago', 'IdCompra', 'IdProveedor', 'Nombre', 'Factura', 'Condiciones', 'Fecha', 'FechaVto', 'Subtotal', 'Iva', 'Total', 'Saldo','Referencia','Importe');
			$w = array(10,12,12,12,20,12,12,12,12,12,12,12,12,12,12);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				$importetotal = 0;
				foreach($data as $opciones)
				{
					$importetotal += $opciones['Importe'];
					$pdf->Cell($w[0],6,$opciones['IdPago'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,date('d/m/Y',strtotime($opciones['FechaPago'])),'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,$opciones['IdCompra'],'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,$opciones['IdProveedor'],'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,substr(utf8_decode($opciones['NombreP']),0,12),'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$opciones['Factura'],'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,utf8_decode($opciones['Condiciones']),'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,date('d/m/Y',strtotime($opciones['Fecha'])),'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,date('d/m/Y',strtotime($opciones['FechaVto'])),'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,$opciones['Subtotal'],'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,$opciones['Iva'],'LR',0,'C',$fill);
					$pdf->Cell($w[11],6,$opciones['Total'],'LR',0,'C',$fill);
					$pdf->Cell($w[12],6,$opciones['Saldo'],'LR',0,'C',$fill);
					$pdf->Cell($w[13],6,$opciones['Referencia'],'LR',0,'C',$fill);
					$pdf->Cell($w[14],6,$opciones['Importe'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				$pdf->Cell(array_sum($w),0,'','T',1);
				$pdf->Cell(16,6,'TOTAL:','LR',0,'C',$fill);
				$pdf->Cell(158,6,'','LR',0,'R',$fill);
				$pdf->Cell(12,6,'$' . $importetotal,'LR',1,'R',$fill);
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
				
			#endregion
			break;
		case 9:
			#region Busqueda
			$FI = (isset($_POST['FI'])) ? $_POST['FI'] : '';
			$FF = (isset($_POST['FF'])) ? $_POST['FF'] : '';
			$ids = (isset($_POST['IdEmpleado'])) ? $_POST['IdEmpleado'] : '';
			$nombre = "";
			$sql="SELECT Nombre FROM Empleados WHERE IdEmpleado=$ids";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data as $opciones):{
				$nombre = $opciones['Nombre'];
			}endforeach;
			$sql="SELECT V.*, D.*, E.IdEmpleado, E.Nombre, P.DescripcionP as Puesto, PR.Descripcion FROM valesconsumibles AS V INNER JOIN detvalesconsumibles AS D ON V.IdValeCons = D.IdValeCons INNER JOIN empleados as E 
			ON E.IdEmpleado = V.IdEmpleadoRecibe INNER JOIN area as A ON E.IdArea = A.IdArea INNER JOIN puestos as P ON P.IdPuesto = E.IdPuesto 
			INNER JOIN productos as PR ON PR.IdProducto = D.IdProducto WHERE V.IdEmpleadoRecibe=$ids AND FechaEmision BETWEEN '$FI' AND '$FF'";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			$FechaI = strtotime($FI);
			$FI = date("d/m/Y", $FechaI);
			$FechaF = strtotime($FF);
			$FF = date("d/m/Y", $FechaF);
			$pdf->Cell(0,0,'DE: ' . $FI . " A: " . $FF,0,1,'L');
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->Cell(0,0,'       __________    __________',0,1,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,0,"Empleado que Recibe: " . utf8_decode($nombre),0,1,'L');
			$pdf->Cell(0,0,'                                   ______________________________',0,1,'L');
			$pdf->Cell(0,10,'',0,1);
			$pdf->SetFont('Times','',7);
			#endregion
			#region Tabla
			$header = array('IdVale','IdRequisicion','IdEmpleado', 'Puesto', 'Nombre', 'FechaEmision', 'FechaSurte','Motivo', 'IdProducto', 'Descripcion', 'Cantidad');
			$w = array(10,16,14,16,22,16,16,25,16,20,12);
			$pdf->FancyTable($header,$w);
			// Datos
				$fill = false;
				foreach($data as $opciones)
				{
					$pdf->Cell($w[0],6,$opciones['IdValeCons'],'LR',0,'C',$fill);
					$pdf->Cell($w[1],6,$opciones['IdRequisicion'],'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,$opciones['IdEmpleadoRecibe'],'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,$opciones['Puesto'],'LR',0,'C',$fill);
					$pdf->Cell($w[4],6,substr(utf8_decode($opciones['Nombre']),0,13),'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,date('d/m/Y', strtotime($opciones['FechaEmision'])),'LR',0,'C',$fill);
					$pdf->Cell($w[6],6,date('d/m/Y', strtotime($opciones['FechaSurte'])),'LR',0,'C',$fill);
					$pdf->Cell($w[7],6,substr(utf8_decode($opciones['Motivo']),0,25),'LR',0,'C',$fill);
					$pdf->Cell($w[8],6,$opciones['IdProducto'],'LR',0,'C',$fill);
					$pdf->Cell($w[9],6,substr(utf8_decode($opciones['Descripcion']),0,17),'LR',0,'C',$fill);
					$pdf->Cell($w[10],6,$opciones['Cantidad'],'LR',0,'C',$fill);
					$pdf->Ln();
					$fill = !$fill;
				}
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
			#endregion
			break;
		case 10:
			#region Busqueda
			$FI = (isset($_POST['FI'])) ? $_POST['FI'] : '';
			$FF = (isset($_POST['FF'])) ? $_POST['FF'] : '';
			$sql="SELECT D.IdRequisicion, D.Fecha as FechaDevolucion, DE.*, E.Nombre, P.Descripcion, E.IdEmpleado, R.Fecha FROM devprodvale as D INNER JOIN detdevprodvale as DE ON D.IdDevolucion = DE.IdDevolucion INNER JOIN requisicionesproductos as R 
			ON R.IdRequisicion = D.IdRequisicion INNER JOIN empleados as E ON E.IdEmpleado = R.IdEmpleadoSolicita INNER JOIN productos as P ON 
			P.IdProducto = DE.IdProducto WHERE D.Fecha BETWEEN '$FI' AND '$FF'";
			$resultado = $conexion->prepare($sql);
			$resultado->execute();  
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
			$FechaI = strtotime($FI);
			$FI = date("d/m/Y", $FechaI);
			$FechaF = strtotime($FF);
			$FF = date("d/m/Y", $FechaF);
			$pdf->Cell(0,0,'DE: ' . $FI . " A: " . $FF,0,1,'L');
			$pdf->Cell(0,0,utf8_decode("Fecha de Impresión: " . date("d/m/Y")),0,1,'R');
			$pdf->Cell(0,0,'       __________    __________',0,0,'L');
			$pdf->Cell(0,10,'',0,1);
			$pdf->SetFont('Times','',7);
			#endregion
			#region Tabla
			$header = array('IdDevolucion', 'IdRequisicion', 'IdEmpleadoSolicita', 'Nombre', 'Fecha Vale',
			'Fecha Devolucion', 'IdProducto', 'Descripcion', 'Cantidad');
			$w = array(18,18,18,35,18,18,18,28,18);
			$pdf->FancyTable($header,$w);
			// Datos
			$fill = false;
			$importetotal = 0;
			foreach($data as $opciones)
			{
				$pdf->Cell($w[0],6,$opciones['IdDevolucion'],'LR',0,'C',$fill);
				$pdf->Cell($w[1],6,$opciones['IdRequisicion'],'LR',0,'C',$fill);
				$pdf->Cell($w[2],6,$opciones['IdEmpleado'],'LR',0,'C',$fill);
				$pdf->Cell($w[3],6,substr(utf8_decode($opciones['Nombre']),0,23),'LR',0,'C',$fill);
				$pdf->Cell($w[4],6,date('d/m/Y',strtotime($opciones['Fecha'])),'LR',0,'C',$fill);
				$pdf->Cell($w[5],6,date('d/m/Y',strtotime($opciones['FechaDevolucion'])),'LR',0,'C',$fill);
				$pdf->Cell($w[6],6,$opciones['IdProducto'],'LR',0,'C',$fill);
				$pdf->Cell($w[7],6,substr(utf8_decode($opciones['Descripcion']),0,23),'LR',0,'C',$fill);
				$pdf->Cell($w[8],6,$opciones['Cantidad'],'LR',0,'C',$fill);
				$pdf->Ln();
				$fill = !$fill;
			}
			// Línea de cierre
			$pdf->Cell(array_sum($w),0,'','T');
			
			#endregion
			break;
	}
$pdf->Output();

?>
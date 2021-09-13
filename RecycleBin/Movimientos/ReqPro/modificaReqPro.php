<?php require_once "../../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include '../../rsc/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
  <h1>Modificar Orden de Mantenimiento Interna</h1>
</div>
<br>
<form id="frm">
      <div class="container">
        
      
      <div class="row">
        <div class="form-group col-md-5">
          <?php
             $consulta = "SELECT * FROM ordenmanttoint WHERE Estado='Planeacion'";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <label for="InputIdOrdenInt" class="form-label">Selecciona Id a modificar (solo en estado planeación): </label>
          <select type="text" class="form-control" id="IdOrdenInt" name="">
          <option value="0">Seleccionar Orden</option>
          <?php foreach ($data as $opciones): ?>
                        
                        <option value ="<?php echo $opciones['IdOrdenInt'] ?>"><?php echo $opciones['Descripcion'] ?></option>
                  
          <?php endforeach ?>
          </select>
        </div>
        </div>

        <div class="row">
        <div class="form-group col-md-4">
        <!-- SELECT DE EQUIPO -->
        <?php
          $consulta = "SELECT IdEquipo, Descripcion FROM equipos Order By Descripcion ASC";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
          <label for="InputDescripcionPrograma" class="form-label" >Descripcion de Equipo</label>
          <select type="text" class="form-control" id="DescripcionEquipo" name="">
          <option value="0">Seleccionar Equipo</option>
          <?php foreach ($data as $opciones): ?>
                        
                        <option value ="<?php echo $opciones['IdEquipo'] ?>"><?php echo $opciones['Descripcion'] ?></option>
                  
                    <?php endforeach ?>
          </select>
        </div>
        
        
        
        <div class="form-group col-md-4">
          <label for="InputDescripcionPrograma" class="form-label" >Descripcion Programa de equipo</label>
          <select type="text" class="form-control" id="DescripcionPrograma" name="DescripcionPrograma">
          </select>
        </div>
        <!-- SCRIPT PARA EL PROGRAMA -->
        <script type="text/javascript">
	      $(document).ready(function(){
		    $('#DescripcionEquipo').val(0);
		      recargarLista();

		    $('#DescripcionEquipo').change(function(){
		    	recargarLista();
		    });
	      })
        </script>
        <script type="text/javascript">
        	function recargarLista(){
        		$.ajax({
        			type:"POST",
        			url:"bd/getEquipo.php",
        			data:"equipo=" + $('#DescripcionEquipo').val(),
        			success:function(r){
        				$('#DescripcionPrograma').html(r);
        			}
        		});
        	}
        </script>
        
        
        <div class="form-group col-md-3" id="IdProgramaE">  
          <!-- SCRIPT PARA EL ID PROGRAMA-->
          <script type="text/javascript">
	      $(document).ready(function(){
		    $('#DescripcionPrograma').val(0);
		      recharge();

		    $('#DescripcionPrograma').change(function(){
		    	recharge();
		    });
	      })
        </script>
        <script type="text/javascript">
        	function recharge(){
        		$.ajax({
        			type:"POST",
        			url:"bd/getIdPrograma.php",
        			data:"idp=" + $('#DescripcionPrograma').val(),
        			success:function(r){
        				$('#IdProgramaE').html(r);
        			}
        		});
        	}
          </script>
        </div>
        </div>
        
        
        
        
        <div class="row">
        <div class="form-group col-md-4">
        <!-- SELECT DE NOMBRES -->
        <?php
          $consulta = "SELECT IdEmpleado, Nombre FROM empleados Order By Nombre ASC";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
          <label for="inputCp" class="form-label">Nombre Empleado: </label>
          <select type="text" class="form-control" id="NombreEmpleado" >
          <option value="0">Seleccione un empleado</option>
          <?php foreach ($data as $opciones): ?>
                        
                        <option value ="<?php echo $opciones['IdEmpleado'] ?>"><?php echo $opciones['Nombre'] ?></option>
                    
                    <?php endforeach ?>
          </select>
        </div>
        
        
        
        
        <div class="form-group col-md-2" id="IdEmpleado">
        <!-- SCRIPT PARA EL ID EMPLEADO-->
          <script type="text/javascript">
	      $(document).ready(function(){
		    $('#NombreEmpleado').val(0);
		      recargar();

		    $('#NombreEmpleado').change(function(){
		    	recargar();
		    });
	      })
        </script>
        <script type="text/javascript">
        	function recargar(){
        		$.ajax({
        			type:"POST",
        			url:"bd/getIdEmpleado.php",
        			data:"empleado=" + $('#NombreEmpleado').val(),
        			success:function(r){
        				$('#IdEmpleado').html(r);
        			}
        		});
        	}
          </script>
          
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-6">
            <label for="inputTel" class="form-label">Descripcion de mantenimiento: </label>
            <textarea type="text" class="form-control" id="DescripcionMantenimiento" cols="20" rows="5">Edita la descripción</textarea>
        </div>
        </div>
        <div class="row">
        <div class="form-group col-3">
            <label for="" class="form-label">Fecha Registro: </label>
            <input type="date" class="form-control" id="FechaRegistro">
        </div>
        <div class="form-group col-3">
            <label for="" class="form-label">Fecha Esperada de Entrega: </label>
            <input type="date" class="form-control" id="FechaEntrega">
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
          <label for="" class="col-form-label">Nuevo Estado: </label>
          <select type="text" class="form-control" id="Estado">
            <option>Planeacion</option>
            <option>Programada</option>
          </select>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-3">
          <button type="button" class="btn btn-danger" onclick="modificarOrdenInt()">Actualizar</button>
        </div>
        </div>
      </div>
</form>
        


        <!-- VALIDAR TODO -->
    <script>
        function modificarOrdenInt()
        {
          let idorden, idprogra, nombre, idempleado, descmantto, fechar, fechae, estado;
          $(document).ready(function(){
          idorden =$.trim($("#IdOrdenInt").val());
          console.log(idorden); 
          idprogra= $.trim($("#IdP").val()); 
          console.log(idprogra); 
          idempleado = $.trim($("#IdEm").val());
          console.log(idempleado); 
          descmantto = $.trim($("#DescripcionMantenimiento").val());
          console.log(descmantto); 
          fechae = $.trim($("#FechaEntrega").val()); 
          console.log(fechae);
          fechar = $.trim($("#FechaRegistro").val());   
          console.log(fechar);    
          estado = $.trim($("#Estado").val());   
          opcion = 2;
              $.ajax({
                url: "bd/Ordenint.php",
                type: "POST",
                datatype:"json",    
                data:  {opcion:opcion, idorden:idorden, idprogra:idprogra, idempleado:idempleado, descmantto:descmantto, fechae:fechae, fechar:fechar, estado:estado},    
                success: function() {  
                  Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Orden Interna Modificada',
                    showConfirmButton: false,
                    footer: '<a href = "consultaromi.php">Ir a consultar</a>'
                  })   
                          
                 }
              });	
            });
            
            }
    </script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "../../vistas/parte_inf.php"?>
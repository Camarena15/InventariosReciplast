<?php require_once "../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include '../rsc/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
  <h1>Registrar Orden de Mantenimiento Interna</h1>
</div>
<br>
      <form id="frm">
      <div class="container">
      <div class="row">
        <div class="form-group col-md-2">
          <?php
             $consulta = "SELECT * FROM ordenmanttoint WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
          <label for="InputIdOrdenInt" class="form-label">Id Orden Interna: </label>
          <input type="number" class="form-control" readonly onmousedown="return false;" id="IdOrdenInt" value="<?php echo ($data + 1) ?>">
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
          <label for="InputDescripcionPrograma" class="form-label" >Descripción de Equipo</label>
          <select type="text" class="form-control" id="DescripcionEquipo" name="">
          <option value="0">Seleccionar Equipo</option>
          <?php foreach ($data as $opciones): ?>
                        
                        <option value ="<?php echo $opciones['IdEquipo'] ?>"><?php echo $opciones['Descripcion'] ?></option>
                  
                    <?php endforeach ?>
          </select>
          
        </div>
        
        
        
        <div class="form-group col-md-4">
          <label for="InputDescripcionPrograma" class="form-label" >Descripción Programa de equipo</label>
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
            <label for="inputTel" class="form-label">Descripción de mantenimiento: </label>
            <textarea type="text" class="form-control" id="DescripcionMantenimiento" cols="20" rows="5">Escribe aquí la descripción del mantto</textarea>
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
		    <div class="form-group col-md-3">
          <!-- SELECT PARA EL PRODUCTO -->
          <?php
          $consulta = "SELECT IdProducto, Descripcion FROM productos Order By Descripcion ASC";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
          <label for="inputAddress2" class="form-label">Descripción del producto: </label>
          <select type="number" class="form-control" id="DescripcionProducto" name="dp">
		      <option value="0">Seleccione un producto</option>
		      <?php foreach ($data as $opciones): ?>
                        
                        <option value ="<?php echo $opciones['IdProducto'] ?>"><?php echo $opciones['Descripcion'] ?></option>
                    
                    <?php endforeach ?>
          </select>
		      </select>
        </div>
		    <div class="form-group col-md-2" id="IdProducto">
            <!-- SCRIPT PARA EL ID PRODUCTO -->
          <script type="text/javascript">
	      $(document).ready(function(){
		    $('#DescripcionProducto').val(0);
		      reca();

		    $('#DescripcionProducto').change(function(){
		    	reca();
		    });
	      })
        </script>
        <script type="text/javascript">
        	function reca(){
        		$.ajax({
        			type:"POST",
        			url:"bd/getIdProducto.php",
        			data:"prod=" + $('#DescripcionProducto').val(),
        			success:function(r){
        				$('#IdProducto').html(r);
        			}
        		});
        	}
          </script>
            <label for="inputTel" class="form-label">Id Producto: </label>
            <input type="text" class="form-control" id="IdProducto" placeholder="1" readonly onmousedown="return false;">
        </div>
        <div class="form-group col-md-2" id="Cost">
            <!-- SCRIPT PARA EL COSTO -->
          <script type="text/javascript">
	      $(document).ready(function(){
		    $('#DescripcionProducto').val(0);
		      rec();

		    $('#DescripcionProducto').change(function(){
		    	rec();
		    });
	      })
        </script>
        <script type="text/javascript">
        	function rec(){
        		$.ajax({
        			type:"POST",
        			url:"bd/getCosto.php",
        			data:"costo=" + $('#DescripcionProducto').val(),
        			success:function(r){
        				$('#Cost').html(r);
        			}
        		});
        	}
          </script>
        </div>
		    <div class="form-group col-md-2">
            <label for="" class="form-label">Cantidad: </label>
            <input type="number" class="form-control" id="Cantidad">
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
          <button type="button" class="btn btn-danger" onclick="validar()">Agregar</button>
        </div>
      </div>
      </form>
      

      <br></br>
      <div class="container text-center">
        <h5>Productos registrados para mantenimiento</h5>
      </div>
      <div class="container">
        <table class="table table-stripped" id="tablaProductos">
            <thead>
                <tr>
                  <th scope="col">Movimiento</th>
                  <th scope="col">Descripcion</th>
                    <th scope="col">IdProducto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody id="tbodydatos">
            </tbody>
        </table>
        <div class="col-2">
          <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
        </div>
      </div>

      <!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
      <script>
        function validar()
        {
            var idproducto, desc, cant, precio;
            idproducto=document.getElementById('IdProd').value;
            desc=document.getElementById('DescripcionProducto').textContent;
            cant=document.getElementById('Cantidad').value;
            precio=document.getElementById('Precio').value;
            exp=/\w+@\w+\.+[a-z]/;

            if(idproducto=='' || desc=='' || cant=='' || precio=='')
            {
                alert("Todos los campos son obligatorios");
                return false;
            }
            
            registrarTabla();
        }
        var cont=0;
        function registrarTabla()
        {
            var combo = document.getElementById("DescripcionProducto");
            var selected = combo.options[combo.selectedIndex].text;
            var cantidad = $("#Cantidad").val();
            var idProducto  = $("#IdProd").val();
            var precio  = $("#Precio").val();

            var id = "";
            var cantidad1 = 0;
            var precio1 = 0;

            var encontrado = false;

            $("#tablaProductos tbody tr").each(function(i, e){
              var tr = $(e);
              var td = $(e).find("td").eq(1);

              id = $(td).find("input").eq(1).val();
              cantidad1 = $(td).find("input").eq(2).val();
              precio1 = $(td).find("input").eq(3).val();

              var fila = "";

              if (id == idProducto) {
              // si se encontró un ID: encontrado!
              encontrado = true;

              var tcan = parseInt(cantidad) + parseInt(cantidad1);
              var tpre = parseFloat(precio);

              tr.remove();
              cont++;
              fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont + '</td><td><input type="hidden" value="' + selected + '"><input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + tcan + '"><input type="hidden" value="' + tpre + '">' + selected + '</td><td>' + idProducto + '</td><td>' + tcan + '</td><td>' + tpre + '</td></tr>';
              $('#tbodydatos').append(fila);
              return false;
              }
            });
             // si es el primer elemento o no se encontró ID, se añade una neuva fila
             // código de arriba movido aquí cambiando un poco la condición
             // realmente el `cont == 0` ya no hace falta, porque si la tabla está vacía encontrado será false
             if (cont == 0 || !encontrado) {
               cont++;
               fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont + '</td><td><input type="hidden" value="' + selected + '"><input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + cantidad + '"><input type="hidden" value="' + precio + '">' + selected + '</td><td>' + idProducto + '</td><td>' + cantidad + '</td><td>' + precio +'</td></tr>';
               $('#tbodydatos').append(fila);
               return;
             }
        }
            
    </script>

     <!-- VALIDAR TODO -->
    <script>
    function validarTodo()
        {
            var idproducto, descu, canti, pre, idorden, descEquipo, descProgra, idprogra, nombre, idempleado, descmantto, fecha1, fecha2;
            idproducto=document.getElementById('IdProd').value;
            descu=document.getElementById('DescripcionProducto').value;
            canti=document.getElementById('Cantidad').value;
            pre=document.getElementById('Precio').value;
            descEquipo=document.getElementById('DescripcionEquipo').value;
            descProgra=document.getElementById('DescripcionPrograma').value;
            idprogra=document.getElementById('IdP').value;
            nombre=document.getElementById('NombreEmpleado').value;
            idempleado=document.getElementById('IdEm').value;
            descmantto=document.getElementById('DescripcionMantenimiento').value;
            idorden=document.getElementById('IdOrdenInt').value;
            exp=/\w+@\w+\.+[a-z]/;

            if(idproducto=='' || descu=='' || canti=='' || pre=='' || descEquipo=='' || descProgra=='' || idprogra==''
            || nombre=='' || idempleado=='' || descmantto=='' || idorden=='')
            {
                alert("Todos los campos son obligatorios");
                return false;
            }
            
            registrarOrdenInt();
        }
        function registrarOrdenInt()
        {
          var arregloId=new Array();
          let celdasId = document.querySelectorAll('td + td + td');

          for(let i = 0; i < celdasId.length; ++i){
             arregloId[i] = celdasId[i].firstChild.data;
             console.log(arregloId[i]);
          }
          let idorden, idprogra, nombre, idempleado, descmantto, fechar, fechae;
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
          opcion = 1;
              $.ajax({
                url: "bd/Ordenint.php",
                type: "POST",
                datatype:"json",    
                data:  {opcion:opcion, idorden:idorden, idprogra:idprogra, idempleado:idempleado, descmantto:descmantto, fechae:fechae, fechar:fechar, 'arregloId': JSON.stringify(arregloId)},    
                success: function() {  
                  Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Orden Interna Registrada',
                    showConfirmButton: false,
                    footer: '<a href = "consultaromi.php">Ir a consultar</a>'
                  })     
                          
                 }
              });	
            });
            
            }
    </script>

   


<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<br>
<br>
<div row>
<div class="d-flex justify-content-center">
<!-- FIN del contenido principal -->
<?php require_once "../vistas/parte_inf.php"?>
</div>
</div>

$(document).ready(function() {
    var IdArea, DescripcionA;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/bd-cat/areascrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdArea"},
            {"data": "DescripcionA"}
        ],    
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });     
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formulario').submit(function(e){                         
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        IdArea =$.trim($("#IdArea").val());
        DescripcionA =$.trim($("#DescripcionA").val());                            
            $.ajax({
              url: "bd/bd-cat/areascrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdArea:IdArea, DescripcionA:DescripcionA, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        IdArea=null;
        $("#formulario").trigger("reset");
        $(".modal-header").css( "background-color", "#28a745");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Producto");
        $('#modalCRUD').modal('show');	    
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");	        
        IdArea = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        DescripcionA = fila.find('td:eq(1)').text();
        $("#IdArea").val(IdArea);
        $("#DescripcionA").val(DescripcionA);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdArea = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdArea+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/bd-cat/areascrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdArea:IdArea},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
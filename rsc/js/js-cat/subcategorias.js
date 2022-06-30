$(document).ready(function() {
    var Id, IdCategoria, IdSubCategoria, Descripcion;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/bd-cat/subcategoriascrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdSubCategoria"},
            {"data": "DescripcionC"},
            {"data": "DescripcionSC"}
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
        IdCategoria = $.trim($('#IdCategoria').val());      
        Descripcion = $.trim($('#Descripcion').val());                              
            $.ajax({
              url: "bd/bd-cat/subcategoriascrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdCategoria:IdCategoria, IdSubCategoria:IdSubCategoria, Descripcion:Descripcion, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');
        setTimeout(function() {
            allowEdition();
        }, 500);											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta
        IdSubCategoria=null;   
        $("#formulario").trigger("reset");
        $(".modal-header").css( "background-color", "#28a745");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de SubCategoría");
        $('#modalCRUD').modal('show');	    
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");
        IdSubCategoria = parseInt(fila.find('td:eq(0)').text());//capturo el ID
        IdCategoria = parseInt(fila.find('td:eq(1)').text()); 
        Descripcion = fila.find('td:eq(2)').text();
        $("#IdCategoria").val(IdCategoria);
        $("#Descripcion").val(Descripcion);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Categoria");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdSubCategoria = parseInt($(this).closest("tr").find('td:eq(0)').text());	
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdSubCategoria+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/bd-cat/subcategoriascrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdSubCategoria:IdSubCategoria},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
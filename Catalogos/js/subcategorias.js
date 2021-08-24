$(document).ready(function() {
    var Id, IdCategoria, IdSubCategoria, Descripcion;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/subcategoriascrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "Id"},
            {"data": "IdCategoria"},
            {"data": "IdSubCategoria"},
            {"data": "Descripcion"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>Editar</i></button>"}
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
        IdCategoria =$.trim($("#IdCategoria").val());
        IdSubCategoria =$.trim($("#IdSubCategoria").val());
        Descripcion = $.trim($('#Descripcion').val());                               
            $.ajax({
              url: "bd/subcategoriascrud.php",
              type: "POST",
              datatype:"json",    
              data:  {Id:Id, IdCategoria:IdCategoria, IdSubCategoria:IdSubCategoria, Descripcion:Descripcion, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        Id=null;
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
        Id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        IdCategoria =parseInt(fila.find('td:eq(1)').text());
        IdSubCategoria = parseInt(fila.find('td:eq(2)').text());
        Descripcion = fila.find('td:eq(3)').text();
        $("#IdCategoria").val(IdCategoria);
        $("#IdSubCategoria").val(IdSubCategoria);
        $("#Descripcion").val(Descripcion);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        Id = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+Id+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/subcategoriascrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, Id:Id},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
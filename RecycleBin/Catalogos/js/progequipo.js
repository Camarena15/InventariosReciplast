$(document).ready(function() {
    var IdPrograma, IdEquipo, Descripcion, TipoFrecuencia, Frecuencia;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/progequiposcrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdPrograma"},
            {"data": "IdEquipo"},
            {"data": "Descripcion"},
            {"data": "TipoFrecuencia"},
            {"data": "Frecuencia"},
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
        IdEquipo =$.trim($("#IdEquipo").val());
        Descripcion =$.trim($("#Descripcion").val());
        TipoFrecuencia = $.trim($('#TipoFrecuencia').val());   
        Frecuencia = $.trim($("#Frecuencia").val());                           
            $.ajax({
              url: "bd/progequiposcrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdPrograma:IdPrograma, IdEquipo:IdEquipo, Descripcion:Descripcion, TipoFrecuencia:TipoFrecuencia, Frecuencia:Frecuencia, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        IdPrograma=null;
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
        IdPrograma = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        IdEquipo =parseInt(fila.find('td:eq(1)').text());
        Descripcion = fila.find('td:eq(2)').text();
        TipoFrecuencia = fila.find('td:eq(3)').text();
        Frecuencia = parseInt(fila.find('td:eq(4)').text());
        $("#IdEquipo").val(IdEquipo);
        $("#Descripcion").val(Descripcion);
        $("#TipoFrecuencia").val(TipoFrecuencia);
        $("#Frecuencia").val(Frecuencia);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdPrograma = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdPrograma+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/progequiposcrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdPrograma:IdPrograma},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
$(document).ready(function() {
    var IdEmpleado, IdArea, IdPuesto, Nombre, FechaNac, Domicilio, Colonia, Ciudad, CP, Edo, Tel, Celular, Estado;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/bd-cat/empleadoscrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdEmpleado"},
            {"data": "IdArea"},
            {"data": "IdPuesto"},
            {"data": "Nombre"},
            {"data": "FechaNac"},
            {"data": "Domicilio"},
            {"data": "Colonia"},
            {"data": "Ciudad"},
            {"data": "CP"},
            {"data": "Edo"},
            {"data": "Tel"},
            {"data": "Celular"},
            {"data": "Estado"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar' disabled='true'><i class='material-icons'>Editar</i></button>"}
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
        IdPuesto =$.trim($("#IdPuesto").val());
        Nombre = $.trim($('#Nombre').val());   
        FechaNac = $.trim($("#FechaNac").val());
        Domicilio = $.trim($("#Domicilio").val());
        Colonia = $.trim($("#Colonia").val()); 
        Ciudad = $.trim($("#Ciudad").val());
        CP = $.trim($("#CP").val());  
        Edo = $.trim($("#Edo").val());
        Tel = $.trim($("#Tel").val());
        Celular = $.trim($("#Celular").val());  
        Estado = $.trim($("#Estado").val());                            
            $.ajax({
              url: "bd/bd-cat/empleadoscrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdEmpleado:IdEmpleado, IdArea:IdArea, IdPuesto:IdPuesto, Nombre:Nombre, FechaNac:FechaNac, Domicilio:Domicilio, Colonia:Colonia, Ciudad:Ciudad, CP:CP, Edo:Edo, Tel:Tel, Celular:Celular, Estado:Estado, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        IdEmpleado=null;
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
        IdEmpleado = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        IdArea =parseInt(fila.find('td:eq(1)').text());
        IdPuesto = parseInt(fila.find('td:eq(2)').text());
        Nombre = fila.find('td:eq(3)').text();
        FechaNac = fila.find('td:eq(4)').text();
        Domicilio = fila.find('td:eq(5)').text();
        Colonia = fila.find('td:eq(6)').text();
        Ciudad = fila.find('td:eq(7)').text();
        CP = fila.find('td:eq(8)').text();
        Edo = fila.find('td:eq(9)').text();
        Tel = fila.find('td:eq(10)').text();
        Celular = fila.find('td:eq(11)').text();
        Estado = fila.find('td:eq(12)').text();
        $("#IdArea").val(IdArea);
        $("#IdPuesto").val(IdPuesto);
        $("#Nombre").val(Nombre);
        $("#FechaNac").val(FechaNac);
        $("#Domicilio").val(Domicilio);
        $("#Colonia").val(Colonia);
        $("#Ciudad").val(Ciudad);
        $("#CP").val(CP);
        $("#Edo").val(Edo);
        $("#Tel").val(Tel);
        $("#Celular").val(Celular);
        $("#Estado").val(Estado);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdEmpleado = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdEmpleado+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/bd-cat/empleadoscrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdEmpleado:IdEmpleado},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
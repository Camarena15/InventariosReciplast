$(document).ready(function() {
    var IdProveedor, Nombre, Domicilio, Colonia, Ciudad, CP, Estado, Tel, Celular, Representante, DescripcionTipoProv, Saldo;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/proveedorescrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdProveedor"},
            {"data": "Nombre"},
            {"data": "Domicilio"},
            {"data": "Colonia"},
            {"data": "Ciudad"},
            {"data": "CP"},
            {"data": "Estado"},
            {"data": "Tel"},
            {"data": "Celular"},
            {"data": "Representante"},
            {"data": "DescripcionTipoProv"},
            {"data": "Saldo"},
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
        Nombre = $.trim($('#Nombre').val());   
        Domicilio = $.trim($("#Domicilio").val());
        Colonia = $.trim($("#Colonia").val()); 
        Ciudad = $.trim($("#Ciudad").val());
        CP = $.trim($("#CP").val());  
        Estado = $.trim($("#Estado").val());
        Tel = $.trim($("#Tel").val());
        Celular = $.trim($("#Celular").val());  
        Representante = $.trim($("#Representante").val());    
        DescripcionTipoProv = $.trim($("#DescripcionTipoProv").val());
        Saldo = $.trim($("#Saldo").val());                        
            $.ajax({
              url: "bd/proveedorescrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdProveedor:IdProveedor, Nombre:Nombre,  Domicilio:Domicilio, Colonia:Colonia, Ciudad:Ciudad, CP:CP, Estado:Estado, Tel:Tel, Celular:Celular, Representante:Representante, DescripcionTipoProv:DescripcionTipoProv, Saldo:Saldo, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        IdProveedor=null;
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
        IdProveedor = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        Nombre = fila.find('td:eq(1)').text();
        Domicilio = fila.find('td:eq(2)').text();
        Colonia = fila.find('td:eq(3)').text();
        Ciudad = fila.find('td:eq(4)').text();
        CP = fila.find('td:eq(5)').text();
        Estado = fila.find('td:eq(6)').text();
        Tel = fila.find('td:eq(7)').text();
        Celular = fila.find('td:eq(8)').text();
        Representante = fila.find('td:eq(9)').text();
        DescripcionTipoProv = fila.find('td:eq(10)').text();
        $("#Nombre").val(Nombre);
        $("#Domicilio").val(Domicilio);
        $("#Colonia").val(Colonia);
        $("#Ciudad").val(Ciudad);
        $("#CP").val(CP);
        $("#Estado").val(Estado);
        $("#Tel").val(Tel);
        $("#Celular").val(Celular);
        $("#Representante").val(Representante);
        $("#DescripcionTipoProv").val(DescripcionTipoProv);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdProveedor = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdProveedor+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/proveedorescrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdProveedor:IdProveedor},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
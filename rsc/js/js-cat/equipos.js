$(document).ready(function() {
    var IdEquipo, IdProveedor, IdArea, Nombre, Descripcion, Marca, Modelo, NoSerie, FechaAdq, FechaGarantia, FechaUltMant, FechaProxMant, HorasTrabajadas, HorasUltimoCorte, Estado;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/bd-cat/equiposcrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdEquipo"},
            {"data": "IdProveedor"},
            {"data": "IdArea"},
            {"data": "Nombre"},
            {"data": "Descripcion"},
            {"data": "Marca"},
            {"data": "Modelo"},
            {"data": "NoSerie"},
            {"data": "FechaAdq"},
            {"data": "FechaGarantia"},
            {"data": "FechaUltMant"},
            {"data": "FechaProxMant"},
            {"data": "HorasTrabajadas"},
            {"data": "HorasUltimoCorte"},
            {"data": "Estado"},
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
        IdProveedor =$.trim($("#IdProveedor").val());
        IdArea =$.trim($("#IdArea").val());
        Nombre = $.trim($('#Nombre').val());   
        Descripcion = $.trim($("#Descripcion").val());
        Marca = $.trim($("#Marca").val());
        Modelo = $.trim($("#Modelo").val()); 
        NoSerie = $.trim($("#NoSerie").val());
        FechaAdq = $.trim($("#FechaAdq").val());  
        FechaGarantia = $.trim($("#FechaGarantia").val());
        FechaUltMant = $.trim($("#FechaUltMant").val());
        FechaProxMant = $.trim($("#FechaProxMant").val());  
        HorasTrabajadas = $.trim($("#HorasTrabajadas").val());
        HorasUltimoCorte = $.trim($("#HorasUltimoCorte").val());
        Estado = $.trim($("#Estado").val());                             
            $.ajax({
              url: "bd/bd-cat/equiposcrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdEquipo:IdEquipo, IdProveedor:IdProveedor, IdArea:IdArea, Nombre:Nombre, Descripcion:Descripcion, Marca:Marca, Modelo:Modelo, NoSerie:NoSerie, FechaAdq:FechaAdq, FechaGarantia:FechaGarantia, FechaUltMant:FechaUltMant, FechaProxMant:FechaProxMant, HorasTrabajadas:HorasTrabajadas, HorasUltimoCorte:HorasUltimoCorte, Estado:Estado, opcion:opcion},    
              success: function(data) {
                tabla.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        IdEquipo=null;
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
        IdEquipo = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        IdProveedor =parseInt(fila.find('td:eq(1)').text());
        IdArea = parseInt(fila.find('td:eq(2)').text());
        Nombre = fila.find('td:eq(3)').text();
        Descripcion = fila.find('td:eq(4)').text();
        Marca = fila.find('td:eq(5)').text();
        Modelo = fila.find('td:eq(6)').text();
        NoSerie = fila.find('td:eq(7)').text();
        FechaAdq = fila.find('td:eq(8)').text();
        FechaGarantia = fila.find('td:eq(9)').text();
        FechaUltMant = fila.find('td:eq(10)').text();
        FechaProxMant = fila.find('td:eq(11)').text();
        HorasTrabajadas = parseFloat(fila.find('td:eq(12)').text());
        HorasUltimoCorte = parseFloat(fila.find('td:eq(13)').text());
        Estado = fila.find('td:eq(14)').text();
        $("#IdProveedor").val(IdProveedor);
        $("#IdArea").val(IdArea);
        $("#Nombre").val(Nombre);
        $("#Descripcion").val(Descripcion);
        $("#Marca").val(Marca);
        $("#Modelo").val(Modelo);
        $("#NoSerie").val(NoSerie);
        $("#FechaAdq").val(FechaAdq);
        $("#FechaGarantia").val(FechaGarantia);
        $("#FechaUltMant").val(FechaUltMant);
        $("#FechaProxMant").val(FechaProxMant);
        $("#HorasTrabajadas").val(HorasTrabajadas);
        $("#HorasUltimoCorte").val(HorasUltimoCorte);
        $("#Estado").val(Estado);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdEquipo = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdEquipo+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/bd-cat/equiposcrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdEquipo:IdEquipo},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
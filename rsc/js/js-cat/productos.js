$(document).ready(function() {
    var IdProducto, IdSubCategoria, Descripcion, Maximo, Minimo, PuntoReorden, Existencia, CostoProm, UltCosto, UnidadMedida, Marca, Modelo, NoParte;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/bd-cat/prgcrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdProducto"},
            {"data": "DescripcionSC"},
            {"data": "Descripcion"},
            {"data": "Maximo"},
            {"data": "Minimo"},
            {"data": "PuntoReorden"},
            {"data": "Existencia"},
            {"data": "CostoProm"},
            {"data": "UltCosto"},
            {"data": "UnidadMedida"},
            {"data": "Marca"},
            {"data": "Modelo"},
            {"data": "NoParte"},
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
        IdSubCategoria =$.trim($("#IdSubCategoria").val());
        Descripcion =$.trim($("#Descripcion").val());
        Maximo = $.trim($('#Maximo').val());   
        Minimo = $.trim($("#Minimo").val());
        PuntoReorden = $.trim($("#PuntoReorden").val());
        Existencia = $.trim($("#Existencia").val()); 
        CostoProm = $.trim($("#CostoProm").val());
        UltCosto = $.trim($("#UltCosto").val());  
        UnidadMedida = $.trim($("#UnidadMedida").val());
        Marca = $.trim($("#Marca").val());
        Modelo = $.trim($("#Modelo").val());  
        NoParte = $.trim($("#NoParte").val());                            
            $.ajax({
              url: "bd/bd-cat/prgcrud.php",
              type: "POST",
              datatype:"json",    
              data:  {IdProducto:IdProducto, IdSubCategoria:IdSubCategoria, Descripcion:Descripcion, Maximo:Maximo, Minimo:Minimo, PuntoReorden:PuntoReorden, Existencia:Existencia, CostoProm:CostoProm, UltCosto:UltCosto, UnidadMedida:UnidadMedida, Marca:Marca, Modelo:Modelo, NoParte:NoParte, opcion:opcion},    
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
        IdProducto=null;
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
        IdProducto = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        IdSubCategoria =parseInt(fila.find('td:eq(1)').text());
        Descripcion = fila.find('td:eq(2)').text();
        Maximo = fila.find('td:eq(3)').text();
        Minimo = fila.find('td:eq(4)').text();
        PuntoReorden = fila.find('td:eq(5)').text();
        UnidadMedida = fila.find('td:eq(9)').text();
        Marca = fila.find('td:eq(10)').text();
        Modelo = fila.find('td:eq(11)').text();
        NoParte = fila.find('td:eq(12)').text();
        $("#IdSubCategoria").val(IdSubCategoria);
        $("#Descripcion").val(Descripcion);
        $("#Maximo").val(Maximo);
        $("#Minimo").val(Minimo);
        $("#PuntoReorden").val(PuntoReorden);
        $("#UnidadMedida").val(UnidadMedida);
        $("#Marca").val(Marca);
        $("#Modelo").val(Modelo);
        $("#NoParte").val(NoParte);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        IdProducto = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+IdProducto+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/bd-cat/prgcrud.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, IdProducto:IdProducto},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    
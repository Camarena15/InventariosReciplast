$(document).ready(function() {
    var idUsuario, Nombre, Contrasena, Contrasena2, Privilegio, opcion;
    opcion = 4;
        
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/users.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "idUsuario"},
            {"data": "Nombre"},
            {"data": "Privilegio"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar' onclick='verifyUser();'><i class='material-icons'>Editar</i></button>"}
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
        Contrasena = "";
        idUsuario =$.trim($("#idUsuario").val());
        Nombre =$.trim($("#Nombre").val());
        Contrasena = $.trim($('#Contrasena').val());
        Contrasena2 = $.trim($('#Contrasena2').val());   
        Privilegio = $.trim($("#Privilegio").val());
        if (opcion != 2 && verifyUserName(Nombre)){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El nombre de usuario ya existe',
                showConfirmButton: false,
                timer: 1500
            })
            return false;
        }
        else if (Contrasena != Contrasena2){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Las contraseñas no coinciden, asegurese de capturar la contraseña correcta',
                showConfirmButton: false,
                timer: 1500
            })
            return false;
        }else{
            $.ajax({
                url: "bd/users.php",
                type: "POST",
                datatype:"json",    
                data:  {idUsuario:idUsuario, Nombre:Nombre, Contrasena:Contrasena, Privilegio:Privilegio, opcion:opcion},    
                success: function(data) {
                  tabla.ajax.reload(null, false);
                 }
              });
            $('#modalCRUD').modal('hide');
            setTimeout(function() {
                changuePriv();
            }, 500);
        }		        
        											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        idUsuario=null;
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
        idUsuario =parseInt(fila.find('td:eq(0)').text());
        Nombre = fila.find('td:eq(1)').text();
        Privilegio = fila.find('td:eq(2)').text();
        if (Privilegio != "Actualizar y Consultar")
            $("#Privilegio").val(1);
        else
            $("#Privilegio").val(2);
        $("#idUsuario").val(idUsuario);
        $("#Nombre").val(Nombre);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        idUsuario = parseInt($(this).closest("tr").find('td:eq(0)').text());		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+idUsuario+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/users.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, idUsuario:idUsuario},    
              success: function() {
                  tabla.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });

     function changuePriv(){
        var arregloId = new Array();
        let celdasId = document.querySelectorAll('#tablaP tbody tr td');
        var c = 0;
        for (let i = 0; i < celdasId.length / 4; ++i) {
            arregloId[i] = celdasId[c + 2].firstChild.data;
            c += 4;
        }
        c=0;
        for(let i=0; i<arregloId.length; i++){
            if(arregloId[i] == 1){
                celdasId[c+2].firstChild.data = "Solo Consultar";
            }else if (arregloId[i] == 2){
                celdasId[c+2].firstChild.data = "Actualizar y Consultar";
            }
            c+=4;
        }
    }

    function verifyUserName(Nombre){
        var arregloId = new Array();
        let celdasId = document.querySelectorAll('#tablaP tbody tr td');
        var c = 0;
        for (let i = 0; i < celdasId.length / 4; ++i) {
            arregloId[i] = celdasId[c + 1].firstChild.data;
            c += 4;
            if (arregloId[i]==Nombre)
                return true;
        }
        return false;
    }

    });    
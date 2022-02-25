$(document).ready(function() {
    var IdPago, IdCompra, Referencia, Fecha, Importe;
    opcion = 5;
    
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/movimientoscrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdPago"},
            {"data": "IdCompra"},
            {"data": "NombreP"},
            {"data": "Referencia"},
            {"data": "Fecha"},
            {"data": "Importe"}
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
        },
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
    });
});    


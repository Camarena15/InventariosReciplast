$(document).ready(function() {
    var IdDevolucion, IdValeCons, Fecha;
    opcion = 2;
    
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/movimientoscrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdDevolucion"},
            {"data": "IdValeCons"},
            {"data": "Nombre"},
            {"data": "Fecha"}
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


$(document).ready(function() {
    var IdCompra, IdProveedor, Factura, Condiciones, Fecha, FechaVto, Subtotal, Iva, Total, Saldo;
    opcion = 1;
    
    tabla = $('#tablaP').DataTable({  
        "ajax":{            
            "url": "bd/movimientoscrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "IdCompra"},
            {"data": "IdProveedor"},
            {"data": "NombreP"},
            {"data": "Factura"},
            {"data": "Condiciones"},
            {"data": "Fecha"},
            {"data": "FechaVto"},
            {"data": "Subtotal"},
            {"data": "Iva"},
            {"data": "Total"},
            {"data": "Saldo"}
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
    /*tabla.on('search.dt', function() {
        load();
    });*/
});    


<?php require_once "vistas/parte_superior.php"?>
<div class="container">
    <h1>Consulta de Compras de Productos</h1>
</div>
<br>
<div class="container caja">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="tablaP" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>IdCompra</th>
                            <th>Proveedor</th>
                            <th>Factura</th>
                            <th>Condiciones</th>
                            <th>Fecha</th>
                            <th>FechaVto</th>
                            <th>Subtotal</th>
                            <th>Iva</th>
                            <th>Total</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3">
        <select class="form-control" id="detalles">
        </select>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#detalles').val(0);
            getDetalles();

            $('#detalles').change(function() {
                getDetalles();
            });
        })
        </script>
        <script type="text/javascript">
        function getDetalles() {
            var opcion = 1;
            var idmov = $('#detalles').val();
            $.ajax({
                type: "POST",
                url: "bd/getDetalles.php",
                data: {
                    idmov: idmov,
                    opcion: opcion
                },
                success: function(r) {
                    $('#detallestabla').html(r);
                }
            });
        }
        </script>
    </div>
</div>
<br>
<br>
<div class="container">
    <h1>Consulta Detalles de Compras de Productos</h1>
</div>
<br>
<div id="detallestabla"></div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
<script type="text/javascript" src="compro.js"></script>
<script>
function load() {
    var info = tabla.page.info();
    var opcion = 1;
    console.log(info.start+1 + "-" + info.end);
    $.ajax({
        url: "bd/selectcomid.php",
        type: "POST",
        datatype: "json",
        data: {
            ri: (info.start + 1),
            rf: info.end,
            se: tabla.search(),
            opcion: opcion
        },
        success: function(r) {
            $('#detalles').html(r);
        }
    });
}

window.onload = setTimeout(function() {
    load();
}, 500);

$('#tablaP').on('search.dt', function() {
    setTimeout(function() {
        load();
    }, 500);
});

$('#tablaP').on('page.dt', function() {
    load();
});
</script>
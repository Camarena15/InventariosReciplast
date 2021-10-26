<?php require_once "vistas/parte_superior.php"?>
<div class="container">
    <h1>Consulta de Devolución de Productos de Vales Consumibles</h1>
</div>
<br>
<div class="container caja">
<div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="tablaP" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>IdDevolucion</th>
                            <th>IdRequisicion</th>
                            <th>Fecha</th>
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
    <div class="col-md-1"></div>
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
            var opcion = 2;
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
    <h1>Consulta Detalles de Devolución de Productos de Vales Consumibles</h1>
</div>
<br>
<div id="detallestabla"></div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
<script type="text/javascript" src="devprod.js"></script>
<script>
function load() {
    var info = tabla.page.info();
    var opcion = 2;
    $.ajax({
        url: "bd/selectcomid.php",
        type: "POST",
        datatype: "json",
        data: {
            ri: (info.start + 1),
            rf: info.end,
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

/*$('#tablaP').on('search.dt', function() {
    load();
});*/
$('#tablaP').on('page.dt', function() {
    load();
});
</script>
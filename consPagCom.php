<?php require_once "vistas/parte_superior.php"?>
<div class="container">
    <h1>Consulta de Pagos de Compras de Productos</h1>
</div>
<br>
<div class="container caja">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="tablaP" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>IdPago</th>
                            <th>IdCompra</th>
                            <th>Referencia</th>
                            <th>Fecha</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
<script type="text/javascript" src="pagcom.js"></script>
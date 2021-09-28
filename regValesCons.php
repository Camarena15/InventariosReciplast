<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Vales Consumibles</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM valesconsumibles WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdRequisicion" class="form-label">Id Vale: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdValeCons"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <!-- SELECT DE NOMBRES -->
                <?php
          $consulta = "SELECT E.Nombre, R.* FROM requisicionesproductos AS R INNER JOIN Empleados AS E ON 
          R.IdEmpleadoSolicita = E.IdEmpleado WHERE R.Estado='Surtida'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
                <label for="inputCp" class="form-label">Seleccionar Requisición: (sólo requisiciones surtidas)</label>
                <select type="text" class="form-control" id="Requisicion">
                    <option value="0">Seleccione una requisición</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdRequisicion'] ?>"><?php echo $opciones['IdRequisicion'] ?> ->
                        <?php echo $opciones['Nombre']?> (<?php echo $opciones['Fecha']?>)</option>

                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#Requisicion').val(0);
            getDatosReq();

            $('#Requisicion').change(function() {
                getDatosReq();
            });
        })
        </script>
        <script type="text/javascript">
        function getDatosReq() {
            $.ajax({
                type: "POST",
                url: "bd/getDatosReq.php",
                data: "requisicion=" + $('#Requisicion').val(),
                success: function(r) {
                    $('#DatosRequisicion').html(r);
                }
            });
            $.ajax({
                type: "POST",
                url: "bd/getDetReq2.php",
                data: "requisicion=" + $('#Requisicion').val(),
                success: function(r) {
                    $('#tbodydatos').html(r);
                }
            });
        }
        </script>

        <div id="DatosRequisicion"></div>
        <div class="row">
            <div class="form-group col-4">
                <?php
                    $consulta = "SELECT * FROM proveedores Order By IdProveedor ASC";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();  
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                <label for="inputAddress2" class="form-label">Seleccionar Proveedor: </label>
                <select type="number" class="form-control" id="IdProveedor" name="dp">
                    <option value="0">Seleccione un proveedor</option>
                    <?php foreach ($data as $opciones): ?>
                    <option value="<?php echo $opciones['IdProveedor'] ?>"><?php echo $opciones['Nombre'] ?>
                    </option>
                    <?php endforeach ?>
                </select>
                </select>
            </div>
            <div class="form-group col-md-3">
                <!-- SCRIPT PARA EL ID PRODUCTO -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#IdProveedor').val(0);
                    getIdPro();

                    $('#IdProveedor').change(function() {
                        getIdPro();
                    });
                })
                </script>
                <script type="text/javascript">
                function getIdPro() {
                    var prv = document.getElementById('IdProveedor').value;
                    var r = "";
                    if (prv == 0) {
                        r = "<label for='inputAddress2' class='form-label'>Id Proveedor: </label>";
                    } else {
                        r = "<label for='inputAddress2' class='form-label'>Id Proveedor: </label><input type='text' class='form-control' id='IdP' readonly onmousedown='return false;' value='" +
                            prv + "'>";
                    }
                    $("#IdPro").html(r);
                }
                </script>
                <div id="IdPro"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-3">
                <label for="" class="form-label">Fecha de Registro: </label>
                <input type="date" class="form-control" id="Fecha">
            </div>
            <div class="form-group col-3">
                <label for="" class="form-label">Fecha de Vencimiento: </label>
                <input type="date" class="form-control" id="FechaVto">
            </div>
            <div class="form-group col-3">
                <label for="" class="form-label">Factura: </label>
                <input type="text" class="form-control" id="Factura" maxlength="10">
            </div>
            <div class="form-group col-3">
                <label for="" class="form-label">Condiciones: </label>
                <select type="number" class="form-control" id="Condiciones" name="dp">
                    <option value="0">Seleccione una condición</option>
                    <option value="1">Contado</option>
                    <option value="2">Crédito</option>
                </select>
            </div>
        </div>
</form>


<br></br>
<div class="container text-center">
    <h5>Productos en Vale Consumible Registrados</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Seleccionar<br>-</th>
                <th scope="col">IdProducto<br>-</th>
                <th scope="col">Cantidad Requerida <BR>-</BR></th>
                <th scope="col">Cantidad <br>-</th>
                <th scope="col">Precio<br>-</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
        </div>
    </div>
</div>

<!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
<script>
function desactiva(n, c) {
    var caja = document.getElementById("cacom" + n);
    if (c == true)
        caja.disabled = false;
    else{
        caja.disabled = true;
        caja.value = 0;
    }
    calcularCosto();
}

function calcularCosto() {
    var subtotal, iva, miva, total;
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 5; ++i) {
        arregloId[c] = celdasId[c].firstChild.checked;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.value;
        arregloId[c + 4] = celdasId[c + 4].firstChild.data;
        c += 5;
    }
    c = 0;
    subtotal = 0;
    for (let i = 0; i < arregloId.length / 5; i++) {
        if (arregloId[c] == true) {
            subtotal += arregloId[c + 3] * arregloId[c + 4];
        } else {

        }
        c += 5;
    }
    miva = document.getElementById("miva").value;
    iva = subtotal * (miva / 100);
    total = subtotal + iva;
    document.getElementById("Subtotal").value = Number.parseFloat(subtotal).toFixed(2);
    document.getElementById("Iva").value = Number.parseFloat(iva).toFixed(2);
    document.getElementById("Total").value = Number.parseFloat(total).toFixed(2);
}
</script>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
    var requi, provee, fechar, fechav, fact, condi, subtotal, iva, total, saldo;
    requi = document.getElementById('Requisicion').value;
    provee = document.getElementById('IdProveedor').value;
    fechar = document.getElementById('Fecha').value;
    fechav = document.getElementById('FechaVto').value;
    fact = document.getElementById('Factura').value;
    condi = document.getElementById('Condiciones').value;
    subtotal = document.getElementById('Subtotal').value;
    iva = document.getElementById('Iva').value;
    total = document.getElementById('Total').value;
    //saldo = document.getElementById('Saldo').value;

    exp = /\w+@\w+\.+[a-z]/;

    if (requi == 0 || provee == 0 || fechar == '' || fechav=='' || fact == '' || condi == 0 || subtotal == '' || iva == '' || total == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarComPro();
}

function registrarComPro() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 5; ++i) {
        arregloId[c] = celdasId[c].firstChild.checked;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.value;
        arregloId[c + 4] = celdasId[c + 4].firstChild.data;
        c += 5;
    }
    let IdCompra, IdRequisicion, IdProveedor, Factura, Condiciones, Fecha, FechaVto, Subtotal, Iva, Total, Saldo;
    $(document).ready(function() {
        IdCompra = $.trim($("#IdCompra").val());
        IdRequisicion = $.trim($("#Requisicion").val());
        IdProveedor = $.trim($("#IdProveedor").val());
        Factura = $.trim($("#Factura").val());
        Condiciones = $("#Condiciones option:selected").text();
        Fecha = $.trim($("#Fecha").val());
        FechaVto = $.trim($("#FechaVto").val());
        Subtotal = $.trim($("#Subtotal").val());
        Iva = $.trim($("#Iva").val());
        Total = $.trim($("#Total").val());
        Saldo = Total;
        opcion = 1;
        $.ajax({
            url: "bd/ComPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdCompra: IdCompra,
                IdRequisicion: IdRequisicion,
                IdProveedor: IdProveedor,
                Factura: Factura,
                Condiciones: Condiciones,
                Fecha: Fecha,
                FechaVto: FechaVto,
                Subtotal: Subtotal,
                Iva: Iva,
                Total: Total,
                Saldo: Saldo,
                'arregloId': JSON.stringify(arregloId)
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Compra de Productos Registrada',
                    showConfirmButton: false,
                    footer: '<a href = "consComPro.php">Ir a consultar</a>'
                })

            }
        });
    });

}
</script>




<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<br>
<br>
<div row>
    <div class="d-flex justify-content-center">
        <!-- FIN del contenido principal -->
        <?php require_once "vistas/parte_inf.php"?>
    </div>
</div>
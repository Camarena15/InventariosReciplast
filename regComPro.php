<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Compras de Productos</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM comprasproductos WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdRequisicion" class="form-label">Id Compra: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdCompra"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>
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
        <div class="row">
            <div class="form-group col-md-3">
                <!-- SELECT PARA EL PRODUCTO -->
                <?php
          $consulta = "SELECT DISTINCT P.IdProducto, P.Descripcion FROM productos as P INNER JOIN detallerequisicionproductos as D ON 
          D.IdProducto = P.IdProducto INNER JOIN requisicionesproductos AS R ON R.IdRequisicion = D.IdRequisicion 
          WHERE R.Estado = 'Ejecucion' AND D.Cantidad > D.CantidadSurtida Order By Descripcion ASC";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();  
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        ?>
                <label for="inputAddress2" class="form-label">Descripción del producto: </label>
                <select type="number" class="form-control" id="DescripcionProducto" name="dp">
                    <option value="0">Seleccione un producto</option>
                    <?php foreach ($data as $opciones): ?>

                    <option value="<?php echo $opciones['IdProducto'] ?>"><?php echo $opciones['Descripcion'] ?>
                    </option>

                    <?php endforeach ?>
                </select>
                </select>
            </div>
            <div class="form-group col-md-2" id="IdProducto">
                <!-- SCRIPT PARA EL ID PRODUCTO -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#DescripcionProducto').val(0);
                    reca();

                    $('#DescripcionProducto').change(function() {
                        reca();
                    });
                })
                </script>
                <script type="text/javascript">
                function reca() {
                    $.ajax({
                        type: "POST",
                        url: "bd/getIdProducto.php",
                        data: "prod=" + $('#DescripcionProducto').val(),
                        success: function(r) {
                            $('#IdProducto').html(r);
                        }
                    });
                }
                </script>
                <label for="inputTel" class="form-label">Id Producto: </label>
                <input type="text" class="form-control" id="IdProducto" placeholder="1" readonly
                    onmousedown="return false;">
            </div>
            <div class="form-group col-md-2" id="Cost">
                <!-- SCRIPT PARA EL COSTO -->
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#DescripcionProducto').val(0);
                    rec();

                    $('#DescripcionProducto').change(function() {
                        rec();
                    });
                })
                </script>
                <script type="text/javascript">
                function rec() {
                    $.ajax({
                        type: "POST",
                        url: "bd/getCosto.php",
                        data: "costo=" + $('#DescripcionProducto').val(),
                        success: function(r) {
                            $('#Cost').html(r);
                        }
                    });
                }
                </script>
            </div>
            <div class="form-group col-md-2">
                <label for="" class="form-label">Cantidad: </label>
                <input type="number" class="form-control" id="Cantidad" min="0" step=".01">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-danger" onclick="validar()">Agregar</button>
            </div>
        </div>
</form>


<br></br>
<div class="container text-left">
    <h6 style="color: red;">(Seleccione únicamente los productos que <br> se registrarán en ésta compra)</h6>
</div>
<div class="container text-center">
    <h5>Productos Requeridos</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Movimiento</th>
                <th scope="col">Descripcion</th>
                <th scope="col">IdProducto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Unitario</th>
                <th scope="col">Importe</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-3">
            <label for="" class="form-label">Subtotal: </label>
            <input type="text" class="form-control" id="Subtotal" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-3">
            <label for="" class="form-label">Iva:</label>
            <input type="text" class="form-control" id="Iva" disabled>
        </div>
        <div class="col-md-1">
            <label for="" class="form-label">Iva(%):</label>
            <input style="font-size: 10px; width: 75px;" type="number" class="form-control" id="miva" value="16" min="0"
                max="99" onchange="calcularCosto()">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <label for="" class="form-label">Total: </label>
            <input type="text" class="form-control" id="Total" disabled>
        </div>
    </div>
</div>

<!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
<script>
    function validar() {
    var idproducto, desc, cant, precio;
    idproducto = document.getElementById('IdProd').value;
    desc = document.getElementById('DescripcionProducto').textContent;
    cant = document.getElementById('Cantidad').value;
    precio = document.getElementById('Precio').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (idproducto == '' || desc == '' || cant == '' || precio == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarTabla();
}

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
var cont = 0;
function registrarTabla() {
    var combo = document.getElementById("DescripcionProducto");
    var selected = combo.options[combo.selectedIndex].text;
    var cantidad = $("#Cantidad").val();
    var idProducto = $("#IdProd").val();
    var precio = $("#Precio").val();

    var id = "";
    var cantidad1 = 0;
    var precio1 = 0;

    var encontrado = false;

    $("#tablaProductos tbody tr").each(function(i, e) {
        var tr = $(e);
        var td = $(e).find("td").eq(1);

        id = $(td).find("input").eq(1).val();
        cantidad1 = $(td).find("input").eq(2).val();
        precio1 = $(td).find("input").eq(3).val();

        var fila = "";

        if (id == idProducto) {
            // si se encontró un ID: encontrado!
            encontrado = true;

            var tcan = parseFloat(cantidad) + parseFloat(cantidad1);
            var tpre = parseFloat(precio);

            tr.remove();
            cont++;
            fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont +
                '</td><td><input type="hidden" value="' + selected + '"><input type="hidden" value="' +
                idProducto + '"><input type="hidden" value="' + tcan + '"><input type="hidden" value="' + tpre +
                '">' + selected + '</td><td>' + idProducto + '</td><td>' + Number.parseFloat(tcan).toFixed(2) + '</td><td>' + Number.parseFloat(tpre).toFixed(2) +
                '</td><td>' + Number.parseFloat(tcan*tpre).toFixed(2) + '</td></tr>';
            $('#tbodydatos').append(fila);
            calcularCosto();
            return false;
        }
    });
    // si es el primer elemento o no se encontró ID, se añade una neuva fila
    // código de arriba movido aquí cambiando un poco la condición
    // realmente el `cont == 0` ya no hace falta, porque si la tabla está vacía encontrado será false
    if (cont == 0 || !encontrado) {
        cont++;
        fila = '<tr class="selected" id="fila' + cont + '"><td>' + cont + '</td><td><input type="hidden" value="' +
            selected + '"><input type="hidden" value="' + idProducto + '"><input type="hidden" value="' + cantidad +
            '"><input type="hidden" value="' + precio + '">' + selected + '</td><td>' + idProducto + '</td><td>' +
            Number.parseFloat(cantidad).toFixed(2) + '</td><td>' + Number.parseFloat(precio).toFixed(2) + '</td><td>' + Number.parseFloat(cantidad*precio).toFixed(2) + '</td></tr>';
        $('#tbodydatos').append(fila);
        calcularCosto();
        return;
    }
}

function calcularCosto() {
    var subtotal, iva, miva, total;
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 6; ++i) {
        arregloId[i] = Number(celdasId[c+5].firstChild.data);
        c += 6;
    }
    c = 0;
    subtotal = 0;
    for (let i = 0; i < arregloId.length; i++) {
        subtotal += arregloId[i];
    }
    miva = document.getElementById("miva").value;
    iva = subtotal * (miva / 100);
    total = Number(subtotal) + Number(iva);
    console.log(total);
    document.getElementById("Subtotal").value = Number.parseFloat(subtotal).toFixed(2);
    document.getElementById("Iva").value = Number.parseFloat(iva).toFixed(2);
    document.getElementById("Total").value = Number.parseFloat(total).toFixed(2);
}
</script>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
    var provee, fechar, fechav, fact, condi, subtotal, iva, total, saldo;
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

    if (provee == 0 || fechar == '' || fechav=='' || fact == '' || condi == 0 || subtotal == '' || iva == '' || total == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarComPro();
}

function registrarComPro() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 6; ++i) {
        arregloId[c] = celdasId[c].firstChild.data;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.data;
        arregloId[c + 4] = celdasId[c + 4].firstChild.data;
        arregloId[c + 5] = celdasId[c + 5].firstChild.data;
        c += 6;
    }
    let IdCompra, IdProveedor, Factura, Condiciones, Fecha, FechaVto, Subtotal, Iva, Total, Saldo;
    $(document).ready(function() {
        IdCompra = $.trim($("#IdCompra").val());
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
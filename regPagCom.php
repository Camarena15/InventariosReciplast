<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Pagos de Compras de Productos</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM pagoscompras WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdRequisicion" class="form-label">Id Pago: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdPago"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>

        <div class="row">

            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Inicial: </label>
                <input type="date" class="form-control" id="FI">
            </div>
            <div class="form-group col-md-3">
                <label for="" class="form-label">Fecha Final: </label>
                <input type="date" class="form-control" id="FF">
            </div>
            <div class="form-group col-md-4">
                <?php
                  $consulta = "SELECT DISTINCTROW E.Nombre, E.IdProveedor FROM comprasproductos AS OM INNER JOIN proveedores AS E ON OM.IdProveedor = E.IdProveedor WHERE 1";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();        
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label for="" class="form-label">Nombre de Proveedor: </label>
                <select type="text" class="form-control" id="IdProveedor">
                    <option value="0">Seleccione un proveedor</option>
                    <?php foreach ($data as $opciones): ?>
                    <option value="<?php echo $opciones['IdProveedor'] ?>"><?php echo $opciones['Nombre'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-warning" onclick="busquedaCompras()">Buscar</button>
            </div>
        </div>

        <br>
        <div class="container">
            <h3>Compras encontradas:</h1>
        </div>
        <hr>
        <div class="container">
            <table class="table table-stripped table-dark" id="tabla1">
            </table>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-4" id="">
                <label for="">Seleccionar Compra: </label>
                <select type="text" class="form-control" id="Compras" name="">
                </select>
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#Compras').val(0);
                    getDatosCompras();

                    $('#Compras').change(function() {
                        getDatosCompras();
                    });
                })
                </script>
                <script type="text/javascript">
                function getDatosCompras() {
                    $.ajax({
                        type: "POST",
                        url: "bd/getDatCom.php",
                        data: "compra=" + $('#Compras').val(),
                        success: function(r) {
                            $('#infocompra').html(r);
                        }
                    });
                }
                </script>
            </div>
        </div>
        <div id="infocompra">

        </div>
        
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn btn-success" onclick="validarTodo()">Nuevo</button>
            </div>
        </div>
        <br>


</form>




<!-- SCRIPT PARA AGREGAR A LA TABLA Y VALIDAR -->
<script>
function busquedaCompras() {
    var fi, ff;
    fi = document.getElementById('FI').value;
    ff = document.getElementById('FF').value;
    exp = /\w+@\w+\.+[a-z]/;

    if (fi == 0 || ff == 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione correctamente el periodo',
            showConfirmButton: false,
            timer: 1500
        })
        return false;

    } else {
        registrar1();
        registrarselect();
    }

}

function registrar1() {
    let fi, ff, ide;
    $(document).ready(function() {
        ide = $.trim($("#IdProveedor").val());
        fi = $.trim($("#FI").val());
        ff = $.trim($("#FF").val());
        $.ajax({
            url: "bd/tabla1com.php",
            type: "POST",
            datatype: "json",
            data: {
                ide: ide,
                fi: fi,
                ff: ff
            },
            success: function(r) {
                $('#tabla1').html(r);
            }
        });
    });

}

function registrarselect() {
    let ide, fi, ff;
    $(document).ready(function() {
        ide = $.trim($("#IdProveedor").val());
        fi = $.trim($("#FI").val());
        ff = $.trim($("#FF").val());
        $.ajax({
            url: "bd/selectcom.php",
            type: "POST",
            datatype: "json",
            data: {
                ide: ide,
                fi: fi,
                ff: ff
            },
            success: function(r) {
                $('#Compras').html(r);
            }
        });
    });

}
</script>

<!-- VALIDAR TODO -->
<script>
function validarTodo() {
    var IdCompra, Referencia, Fecha, Importe;
    IdCompra = $("#Compras").val();
    Referencia = $("#Referencia").val();
    Fecha = $("#Fecha").val();
    Importe = $("#Importe").val();
    console.log(IdCompra + "-" + Referencia + "-" + Fecha + "-" + Importe);
    exp = /\w+@\w+\.+[a-z]/;

    if (IdCompra == 0 || Referencia == '' || Fecha == '' || Importe == "") {
        alert("Todos los campos son obligatorios");
        return false;
    }

    registrarPago();
}

function registrarPago() {
    let IdCompra, Referencia, Fecha, Importe, Condiciones, Proveedor;
    $(document).ready(function() {
        IdCompra = $.trim($("#Compras").val());
        Referencia = $.trim($("#Referencia").val());
        Fecha = $.trim($("#Fecha").val());
        Importe = $.trim($("#Importe").val());
        Condiciones = $.trim($("#Condiciones").val());
        Proveedor = $.trim($("#Proveedor").val());
        console.log(Condiciones + "/" + Proveedor);
        opcion = 1;
        $.ajax({
            url: "bd/PagCom.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdCompra: IdCompra,
                Referencia: Referencia,
                Fecha: Fecha,
                Importe: Importe,
                Condiciones: Condiciones,
                Proveedor: Proveedor
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Pago Registrado',
                    showConfirmButton: false,
                    footer: '<a href = "consPagCom.php">Ir a consultar</a>'
                })

            }
        });
    });

}
</script>





<br>
<br>
<div row>
    <div class="d-flex justify-content-center">
        <!-- FIN del contenido principal -->
    </div>
</div>
<?php require_once "vistas/parte_inf.php"?>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
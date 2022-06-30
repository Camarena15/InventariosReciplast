<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Registrar Devolución de Productos <br> de Vales Consumibles</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <div class="row">
            <div class="form-group col-md-2">
                <?php
             $consulta = "SELECT * FROM devprodvale WHERE 1";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();        
             $data=$resultado->rowCount();
          ?>
                <label for="InputIdDevolucion" class="form-label">Id-Devolución: </label>
                <input type="number" class="form-control" readonly onmousedown="return false;" id="IdDevolucion"
                    value="<?php echo ($data + 1) ?>">
            </div>
        </div>
        <hr>
        <!--div class="row">
            <--div class="form-group col-md-4">
                <-- SELECT DE NOMBRES
                <?php
                    /*$consulta = "SELECT DISTINCT E.Nombre, R.* FROM valesconsumibles AS R INNER JOIN empleados AS E ON 
                    R.IdEmpleadoRecibe = E.IdEmpleado INNER JOIN  detvalesconsumibles AS D ON D.IdValeCons = R.IdValeCons 
                    WHERE D.CantidadSurtida > 0 AND D.CantidadSurtida <> D.CantidadDevuelta ORDER BY R.FechaSurte";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();  
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);*/
                    ?>
            </div-->
        <!----------------------------------------------------------->
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
                  $consulta = "SELECT DISTINCT E.Nombre, R.* FROM valesconsumibles AS R INNER JOIN empleados AS E ON 
                  R.IdEmpleadoRecibe = E.IdEmpleado INNER JOIN  detvalesconsumibles AS D ON D.IdValeCons = R.IdValeCons 
                  WHERE D.CantidadSurtida > 0 AND D.CantidadSurtida <> D.CantidadDevuelta ORDER BY R.FechaSurte";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();        
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label for="" class="form-label">Nombre de Empleado: (opcional) </label>
                <select type="text" class="form-control" id="Empleado">
                    <option value="0">Seleccione un empleado</option>
                    <?php foreach ($data as $opciones): ?>
                    <option value="<?php echo $opciones['IdEmpleadoRecibe'] ?>"><?php echo $opciones['Nombre'] ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-warning" onclick="buscar()">Buscar</button>
            </div>
        </div>

        <br>
        <div class="container">
            <h3>Vales encontrados:</h1>
        </div>
        <div class="container">
            <table class="table table-stripped table-dark" id="tabla1">
            </table>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputCp" class="form-label">Seleccionar Vale:</label>
                <select type="text" class="form-control" id="ValeCons"></select>
            </div>
        </div>
        <!----------------------------------------------------------->

    <div id="DatosRequisicion"></div>
    <div class="form-group col-3">
            <label for="" class="form-label"> <br> Fecha: </label>
            <input type="date" class="form-control" id="Fecha">
        </div>
    <hr>
</form>


<br></br>
<div class="container text-left">
    <h6 style="color: red;">(Seleccione únicamente los productos que <br> se devolverán)</h6>
</div>
<div class="container text-center">
    <h5>Productos Devueltos Registrados</h5>
</div>
<div class="container">
    <table class="table table-stripped" id="tablaProductos">
        <thead>
            <tr>
                <th scope="col">Seleccionar</th>
                <th scope="col">IdProducto</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad Actual Surtida</th>
                <th scope="col">Cantidad a Devolver</th>
            </tr>
        </thead>
        <tbody id="tbodydatos">
        </tbody>
    </table>
    <div class="col-2">
        <button type="button" class="btn btn-success" onclick="validarTodo()">Registrar</button>
    </div>
</div>

<!-- VALIDAR TODO -->
<script>
$(document).ready(function() {
    $('#ValeCons').val(0);
    getDatosVale();

    $('#ValeCons').change(function() {
        getDatosVale();
    });
})

function getDatosVale() {
    $.ajax({
        type: "POST",
        url: "bd/getDatosVale.php",
        data: "vale=" + $('#ValeCons').val(),
        success: function(r) {
            $('#DatosRequisicion').html(r);
        }
    });
    $.ajax({
        type: "POST",
        url: "bd/getDetReq2.php",
        data: "vale=" + $('#ValeCons').val(),
        success: function(r) {
            $('#tbodydatos').html(r);
        }
    });
}

function buscar() {
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
        registrarselect();
    }

}

function registrarselect() {
    let ide, fi, ff;
    $(document).ready(function() {
        ide = $.trim($("#Empleado").val());
        fi = $.trim($("#FI").val());
        ff = $.trim($("#FF").val());
        $.ajax({
            url: "bd/selectreq-2.php",
            type: "POST",
            datatype: "json",
            data: {
                ide: ide,
                fi: fi,
                ff: ff
            },
            success: function(r) {
                $('#ValeCons').html(r);
            }
        });
    });

}

function desactiva(n, c) {
    var caja = document.getElementById("cacom" + n);
    if (c == true)
        caja.disabled = false;
    else {
        caja.disabled = true;
        caja.value = 0;
    }
}

function validarTodo() {
    var IdValeCons, Fecha, IdDevolucion, max;
    IdValeCons = document.getElementById('ValeCons').value;
    Fecha = document.getElementById('Fecha').value;
    IdDevolucion = document.getElementById('IdDevolucion');
    exp = /\w+@\w+\.+[a-z]/;

    if (IdDevolucion == '' || IdValeCons == 0 || Fecha == '') {
        alert("Todos los campos son obligatorios");
        return false;
    }
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 5; i++) {
        if (parseFloat(celdasId[c+3].firstChild.data, 10) < celdasId[c+4].firstChild.value){
            alert("La cantidad devuelta no debe ser mayor que la cantidad surtida");
            return false;
        }
        c += 5;
    }

    regDevProdV();
}

function regDevProdV() {
    var arregloId = new Array();
    let celdasId = document.querySelectorAll('#tbodydatos td');
    var c = 0;
    for (let i = 0; i < celdasId.length / 5; i++) {
        arregloId[c] = celdasId[c].firstChild.checked;
        arregloId[c + 1] = celdasId[c + 1].firstChild.data;
        arregloId[c + 2] = celdasId[c + 2].firstChild.data;
        arregloId[c + 3] = celdasId[c + 3].firstChild.data;
        arregloId[c + 4] = celdasId[c + 4].firstChild.value;
        c += 5;
    }
    let IdDevolucion, IdValeCons, Fecha;
    $(document).ready(function() {
        IdDevolucion = $.trim($("#IdDevolucion").val());
        IdValeCons = $.trim($("#ValeCons").val());
        Fecha = $.trim($("#Fecha").val());
        opcion = 1;
        $.ajax({
            url: "bd/DevProd.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdDevolucion: IdDevolucion,
                IdValeCons: IdValeCons,
                Fecha: Fecha,
                'arregloId': JSON.stringify(arregloId)
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Devolución de Productos de Vale Consumible Registrada',
                    showConfirmButton: false,
                    footer: '<a href = "consDevProd.php">Ir a consultar</a>'
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
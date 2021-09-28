<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->
<?php 
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Cambiar Estado de Requisición de Productos</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <p>(Únicamente se mostrarán las requisiciones en fase de planeación)</p>
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
                  $consulta = "SELECT DISTINCTROW E.Nombre, E.IdEmpleado FROM requisicionesproductos AS OM INNER JOIN empleados AS E ON OM.IdEmpleadoSolicita = E.IdEmpleado WHERE OM.Estado='Planeacion';";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();        
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label for="" class="form-label">Nombre de Empleado: </label>
                <select type="text" class="form-control" id="IdEmpleado">
                    <option value="0">Seleccione un empleado</option>
                    <?php foreach ($data as $opciones): ?>
                        <option value="<?php echo $opciones['IdEmpleado'] ?>"><?php echo $opciones['Nombre'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-warning" onclick="validar1()">Buscar</button>
            </div>
        </div>

        <br>
        <div class="container">
            <h3>Requisiciones encontradas:</h1>
        </div>
        <hr>
        <div class="container">
            <table class="table table-stripped table-dark" id="tabla1">
            </table>
        </div>
        <br>


        <div class="row">
            <div class="form-group col-md-5" id="">
                <label for="">Seleccionar Requisición: </label>
                <select type="text" class="form-control" id="Requisiciones" name="">

                </select>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-success" onclick="validar2()" style="height: 130px; width: 130px;">Ejecutar Requisición</button>
            <!--</div>
            <div class="col-md-3">-->
                <button type="button" class="btn btn-danger" onclick="validar3()" style="height: 130px; width: 130px;">Cancelar Requisición</button>
            </div>
        </div>

    </div>
</form>

<!-- SCRIPT PARA EL SELECT 2-->
<script>
function registrarselect() {
    let ide, fi, ff;
    $(document).ready(function() {
        ide = $.trim($("#IdEmpleado").val());
        fi = $.trim($("#FI").val());
        ff = $.trim($("#FF").val());
        $.ajax({
            url: "bd/selectreq.php",
            type: "POST",
            datatype: "json",
            data: {
                ide: ide,
                fi: fi,
                ff: ff
            },
            success: function(r) {
                $('#Requisiciones').html(r);
            }
        });
    });

}
</script>

<!-- VALIDAR 1 -->
<script>
function validar1() {
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
</script>

<!-- VALIDAR 2-->
<script>
function validar2() {
    var requ;
    requ = document.getElementById("Requisiciones").value;
    exp = /\w+@\w+\.+[a-z]/;

    if (requ != 0) {
        registrar2();
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione una requisición',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }

}
</script>

<!-- VALIDAR 3 -->
<script>
function validar3() {
    var requ;
    requ = document.getElementById("Requisiciones").value;
    exp = /\w+@\w+\.+[a-z]/;

    if (requ != 0) {
        registrar3();
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Seleccione una requisición',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }

}
</script>

<!-- REGISTRAR 1 -->
<script>
function registrar1() {
    let fi, ff, ide;
    $(document).ready(function() {
        ide = $.trim($("#IdEmpleado").val());
        fi = $.trim($("#FI").val());
        ff = $.trim($("#FF").val());
        $.ajax({
            url: "bd/tabla1req.php",
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
</script>

<!-- REGISTRAR 2 -->
<script>
function registrar2() {
    let IdRequisicion, Estado;
    $(document).ready(function() {
        IdRequisicion = $.trim($("#Requisiciones").val());
        Estado = "Ejecucion";
        opcion = 2;
        $.ajax({
            url: "bd/ReqPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdRequisicion: IdRequisicion,
                Estado: Estado
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'La Requisición seleccionada ha pasado al estado de Ejecución',
                    showConfirmButton: false,
                    footer: '<a href = "consReqPro.php">Ir a consultar</a>'
                })

            }
        });
    });

}
</script>

<!-- REGISTRAR 3 -->
<script>
function registrar3() {
  let IdRequisicion, Estado;
    $(document).ready(function() {
        IdRequisicion = $.trim($("#Requisiciones").val());
        Estado = "Cancelada";
        opcion = 2;
        $.ajax({
            url: "bd/ReqPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdRequisicion: IdRequisicion,
                Estado: Estado
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'La Requisición seleccionada se ha cancelado!',
                    showConfirmButton: false,
                    footer: '<a href = "consReqPro.php">Ir a consultar</a>'
                })

            }
        });
    });

}
</script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
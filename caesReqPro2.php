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
                  $consulta = "SELECT DISTINCTROW E.Nombre, E.IdEmpleado FROM requisicionesproductos AS OM INNER JOIN empleados AS E ON OM.IdEmpleadoSolicita = E.IdEmpleado WHERE OM.Estado='Planeación';";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();        
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label for="" class="form-label">Nombre de Empleado: (opcional) </label>
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

    </div>
</form>

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

function busquedaInicial(){
    $('#frm').submit(function(e){e.preventDefault();});
    let fi, ff, ide, d;
    $(document).ready(function() {
        ide = $.trim($("#IdEmpleado").val());
        fi = "2000-00-00";
        d = new Date();
        if ((d.getMonth() + 1) < 10)
            ff = d.getFullYear() + "/0" + (d.getMonth() + 1)  + "/" + (d.getDate() + 1);
        else
            ff = d.getFullYear() + "/" + (d.getMonth() + 1)  + "/" + d.getDate();
        console.log(fi + " " + ff);
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
window.onload = busquedaInicial();
</script>

<!-- REGISTRAR 2 -->
<script>
function registrar2(IdRequisicion) {
    let Estado;
    $(document).ready(function() {
        Estado = "Ejecución";
        opcion = 2;
        $.ajax({
            url: "bd/ReqPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdRequisicion: parseInt(IdRequisicion),
                Estado: Estado
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'La Requisición seleccionada ha pasado al estado de Ejecución',
                    showConfirmButton: false,
                    footer: '<a href = "caesReqPro2.php">Regresar</a>'
                })

            }
        });
        
    });

}
</script>

<!-- REGISTRAR 3 -->
<script>
function registrar3(IdRequisicion) {
  let Estado;
    $(document).ready(function() {
        Estado = "Cancelada";
        opcion = 2;
        $.ajax({
            url: "bd/ReqPro.php",
            type: "POST",
            datatype: "json",
            data: {
                opcion: opcion,
                IdRequisicion: parseInt(IdRequisicion),
                Estado: Estado
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'La Requisición seleccionada se ha cancelado!',
                    showConfirmButton: false,
                    footer: '<a href = "caesReqPro2.php">Regresar</a>'
                })

            }
        });
    });

}
</script>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
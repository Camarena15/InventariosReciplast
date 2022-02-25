<?php require_once "vistas/parte_superior.php"?>

<!-- INICIO del contenido principal -->
<?php 
date_default_timezone_set('America/Mexico_City');
include 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>
<div class="container">
    <h1>Administrar Información</h1>
</div>
<br>
<form id="frm">
    <div class="container">
        <hr>
        <h3>Respaldo</h3>
        <hr>
        <h5>Respaldar Información</h4>
            <br>
            <p>Escriba a continuación el nombre del archivo que contendrá el respaldo de Inventarios:</p>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="" class="form-label">Nombre del archivo: </label>
                    <input type="text" class="form-control" id="filename" min="1" max="20"
                        placeholder="Respaldo_<?php echo date('d-m-Y');?>">
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <button type="button" class="btn btn-secondary" onclick="validaDatosRespaldar();">Crear
                        respaldo</button>
                </div>
            </div>
            <br>

    </div>
</form>

<!-- VALIDAR 2-->
<script>
function validaDatosRespaldar() {
    var filename;
    filename = document.getElementById("filename").value;
    exp = /[a-z\d\-_]/gi;

    if (exp.test(filename)) {
        creaRespaldo(filename);
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Escriba un nombre correcto para el archivo',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }

}
</script>

<!-- REGISTRAR 2 -->
<script>
function creaRespaldo(filename) {
    $(document).ready(function() {
        filename = $.trim(filename);
        $.ajax({
            url: "bd/admdbinfo.php",
            type: "POST",
            datatype: "json",
            data: {
                filename: filename
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto!',
                    text: 'Se ha creado una copia de seguridad!',
                    showConfirmButton: false
                });

            }
        });
        setTimeout(function(){
            console.log("bd/backups/" + filename + ".sql");
            location.href = "bd/backups/" + filename + ".sql";
        }, 1500);
    });

}
</script>

<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
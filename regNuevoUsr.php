<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Administrar Usuarios</h1></div>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">Nuevo</i></button>    
            </div>    
        </div>    
    </div>    
    <br>  

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaP" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Privilegio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>                           
                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div>   

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario">    
            <div class="modal-body">
            <div class="form-group">
                        <label for="" class="col-form-label">ID: </label>
                            <input type="text" class="form-control" id="idUsuario" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Usuario: </label>
                            <input type="text" class="form-control" id="Nombre">
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Nueva Contraseña: </label>
                            <input type="password" class="form-control" id="Contrasena">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Repetir Contraseña: </label>
                            <input type="password" class="form-control" id="Contrasena2">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Privilegios: </label>
                            <select type="text" class="form-control" id="Privilegio">
			                    <option value="1">Solo Consultar</option>
                                <option value="2">Actualizar y Consultar</option></select>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inf.php"?>
<script type="text/javascript" src="users.js"></script>
<script>
    function changuePriv(){
        var arregloId = new Array();
        let celdasId = document.querySelectorAll('#tablaP tbody tr td');
        var c = 0;
        for (let i = 0; i < celdasId.length / 4; ++i) {
            arregloId[i] = celdasId[c + 2].firstChild.data;
            c += 4;
        }
        c=0;
        for(let i=0; i<arregloId.length; i++){
            if(arregloId[i] == 1){
                celdasId[c+2].firstChild.data = "Solo Consultar";
            }else if (arregloId[i] == 2){
                celdasId[c+2].firstChild.data = "Actualizar y Consultar";
            }
            c+=4;
        }
    }
    window.onload = setTimeout(function() {
        changuePriv();
    }, 500);
    $('#tablaP').on('page.dt', function() {
        setTimeout(function() {
            changuePriv();
        }, 500);
    });
    function verifyUser(){
        setTimeout(function() {
            if ($("#Nombre").val() == $("#userN").text()){
                $("#Privilegio").prop("disabled",true);
            } else {
                $("#Privilegio").prop("disabled",false);
            }
        }, 500);   
    }
    
</script>
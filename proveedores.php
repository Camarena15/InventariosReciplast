<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de Proveedores</h1></div>
<div class="container">
        <?php if ($priv==2) echo '<div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">Nuevo</i></button>    
            </div>    
        </div>';?>    
    </div>    
    <br>  

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaP" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>IdProveedor</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Colonia</th>
                            <th>Ciudad</th>
                            <th>CP</th>
                            <th>Estado</th>
                            <th>Tel</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Representante</th>
                            <th>Descripción Tipo Proveedor</th>
                            <th>Saldo</th>
                            <th>Acciones</th>
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
                            <label for="" class="col-form-label">Nombre: </label>
                            <input type="text" class="form-control" id="NombreP" required maxlength='50'>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Domicilio: </label>
                            <input type="text" class="form-control" id="Domicilio" required maxlength='40'>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Colonia: </label>
                            <input type="text" class="form-control" id="Colonia" required maxlength='40'>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Ciudad: </label>
                            <input type="text" class="form-control" id="Ciudad" required maxlength='40'>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-3">
                            <label for="" class="col-form-label">CP: </label>
                            <input class="form-control" id="CP" pattern="[0-9]{5}" placeholder="Ejemplo: 45450">
                        </div>
                        
                        <div class="form-group col-md-5">
                            <label for="" class="col-form-label">Estado: </label>
                            <input type="text" class="form-control" id="Estado" maxlength='25'>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Teléfono: </label>
                            <input type="tel" class="form-control" id="Tel">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Celular: </label>
                            <input type="tel" class="form-control" id="Celular">
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Email: </label>
                            <input type="email" class="form-control" id="Email">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Representante: </label>
                            <input type="text" class="form-control" id="Representante" maxlength='40'>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Descripción Tipo Proveedor: </label>
                            <input type="text" class="form-control" id="DescripcionTipoProv" maxlength='100'>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Saldo: </label>
                            <input type="text" class="form-control" id="Saldo">
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
<script type="text/javascript" src="rsc/js/js-cat/proveedores.js"></script>  
<script type="text/javascript">
    function allowEdition(){
        setTimeout(function() {
            $(".btnEditar").prop("disabled", false);
        }, 500);
    }
    <?php if ($priv==2) echo "allowEdition();
    $('#tablaP').on('page.dt', function() {
    	allowEdition();
    });
    $('#tablaP').on('search.dt', function() {
        setTimeout(function() {
            allowEdition();
        }, 500);
    });";?>

</script>
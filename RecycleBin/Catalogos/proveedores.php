<?php require_once "../../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de Proveedores</h1></div>
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
                            <th>IdProveedor</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Colonia</th>
                            <th>Ciudad</th>
                            <th>CP</th>
                            <th>Estado</th>
                            <th>Tel</th>
                            <th>Celular</th>
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
                            <input type="text" class="form-control" id="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Domicilio: </label>
                            <input type="text" class="form-control" id="Domicilio">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Colonia: </label>
                            <input type="text" class="form-control" id="Colonia">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Ciudad: </label>
                            <input type="text" class="form-control" id="Ciudad">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">CP: </label>
                            <input type="number" class="form-control" id="CP">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Estado: </label>
                            <input type="text" class="form-control" id="Edo">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Tel: </label>
                            <input type="number" class="form-control" id="Tel">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Celular: </label>
                            <input type="number" class="form-control" id="Celular">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Representante: </label>
                            <input type="text" class="form-control" id="Representante">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Descripción Tipo Proveedor: </label>
                            <input type="text" class="form-control" id="DescripcionTipoProv">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Saldo: </label>
                            <input type="text" class="form-control" id="Saldo">
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
<?php require_once "../../vistas/parte_inf.php"?>
<script type="text/javascript" src="js/proveedores.js"></script>  
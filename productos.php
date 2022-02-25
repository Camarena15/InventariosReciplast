<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de Productos</h1></div>
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
                            <th>IdProducto</th>
                            <th>IdSubCategoría</th>
                            <th>Descripción</th>
                            <th>Máximo</th>
                            <th>Mínimo</th>
                            <th>PuntoReorden</th>
                            <th>Existencia</th>
                            <th>Costo Promedio</th>
                            <th>Último Costo</th>
                            <th>Unidad de Medida</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>No Parte</th>
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
                        <label>SubCategoria: <select name="" class="form-control" id="IdSubCategoria" required='required'>

                        <?php 

                            include_once 'bd/conexion.php';
                            $objeto = new Conexion();
                            $conexion = $objeto->Conectar();
                            $consulta = "SELECT * FROM subcategorias  WHERE 1 ORDER BY DescripcionSC";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();        
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($data as $opciones): ?>
                        
                            <option value ="<?php echo $opciones['IdSubCategoria'] ?>"><?php echo $opciones['DescripcionSC'] ?></option>
                        
                        <?php endforeach ?>
                        </select> </label>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Descripción: </label>
                            <input type="text" class="form-control" id="Descripcion" required maxlength='50'>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-3">
                            <label for="" class="col-form-label">Máximo: </label>
                            <input type="number" class="form-control" id="Maximo">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Mínimo: </label>
                            <input type="number" class="form-control" id="Minimo">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Punto de Reorden: </label>
                            <input type="number" class="form-control" id="PuntoReorden">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-3">
                            <label for="" class="col-form-label">Existencia: </label>
                            <input type="number" class="form-control" id="Existencia" min="0" step="0.01">
                        </div>
                       
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Costo Promedio: </label>
                            <input type="number" class="form-control" id="CostoProm" min="0" step="0.01">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="col-form-label">Ult Costo: </label>
                            <input type="number" class="form-control" id="UltCosto" min="0" step="0.01">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="col-form-label">Unidad de Media: </label>
                            <select type="text" class="form-control" id="UnidadMedida">
			                <option>Piezas</option>
			                <option>Litros</option>
			                <option>Kilos</option>
			                <option>Metros</option>
			                </select>
                        </div>
                        </div>                                                                                                               
                        <div class="row">
                        <div class="form-group col-md-5">
                            <label for="" class="col-form-label">Marca: </label>
                            <input type="text" class="form-control" id="Marca" maxlength='30'>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="" class="col-form-label">Modelo: </label>
                            <input type="text" class="form-control" id="Modelo" maxlength='20'>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-5">
                            <label for="" class="col-form-label">No. Parte: </label>
                            <input type="text" class="form-control" id="NoParte" maxlength='30'>
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
<script type="text/javascript" src="rsc/js/js-cat/productos.js"></script>  
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
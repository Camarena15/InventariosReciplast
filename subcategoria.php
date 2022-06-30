<?php require_once "vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de SubCategorías</h1></div>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <?php if ($priv==2) echo ' <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">Nuevo</i></button>';?>    
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
                            <th>IdSubcategoría</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
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
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label>Categoría: <select name="venta" class="form-control" id="IdCategoria" required='required'>

                    <?php 

                        include_once 'bd/conexion.php';
                        $objeto = new Conexion();
                        $conexion = $objeto->Conectar();
                        $consulta = "SELECT * FROM categorias  WHERE 1 ORDER BY DescripcionC";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();        
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($data as $opciones): ?>
                    
                        <option value ="<?php echo $opciones['IdCategoria'] ?>"><?php echo $opciones['DescripcionC'] ?></option>
                    
                    <?php endforeach ?>
                    </select> </label>
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">Descripción:</label>
                    <input type="text" class="form-control" id="Descripcion" maxlength='40'>
                    </div>
                    </div>
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
<script type="text/javascript" src="rsc/js/js-cat/subcategorias.js"></script>  
<script type="text/javascript">
    function allowEdition(){
        setTimeout(function() {
            $(".btnEditar").prop("disabled", false);
        }, 750);
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
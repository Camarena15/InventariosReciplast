<?php require_once "../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de Programas de Equipos</h1></div>
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
                            <th>IdPrograma</th>
                            <th>Equipo</th>
                            <th>Descripción</th>
                            <th>Tipo Frecuencia</th>
                            <th>Frecuencia</th>
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
                        <label>Equipo: <select name="" class="form-control" id="IdEquipo">

                        <?php 

                            include_once '../rsc/bd/conexion.php';
                            $objeto = new Conexion();
                            $conexion = $objeto->Conectar();
                            $consulta = "SELECT * FROM equipos  WHERE 1";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();        
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($data as $opciones): ?>
                        
                            <option value ="<?php echo $opciones['IdEquipo'] ?>"><?php echo $opciones['Nombre'] ?></option>
                        
                        <?php endforeach ?>
                        </select> </label>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Descripción: </label>
                            <input type="text" class="form-control" id="Descripcion">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Tipo Frecuencia: </label>
                            <input type="text" class="form-control" id="TipoFrecuencia">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Frecuencia: </label>
                            <input type="text" class="form-control" id="Frecuencia">
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
<?php require_once "../vistas/parte_inf.php"?>
<script type="text/javascript" src="js/progequipo.js"></script>  
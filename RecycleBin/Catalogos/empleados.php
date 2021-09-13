<?php require_once "../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de Empleados</h1></div>
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
                            <th>IdEmpleado</th>
                            <th>Area</th>
                            <th>Puesto</th>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Domicilio</th>
                            <th>Colonia</th>
                            <th>Ciudad</th>
                            <th>CP</th>
                            <th>Estado</th>
                            <th>Telefono</th>
                            <th>Celular</th>
                            <th>Estado Laboral</th>
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
                        <label>Área: <select name="" class="form-control" id="IdArea">

                        <?php 

                            include_once '../rsc/bd/conexion.php';
                            $objeto = new Conexion();
                            $conexion = $objeto->Conectar();
                            $consulta = "SELECT * FROM area  WHERE 1";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();        
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($data as $opciones): ?>
                        
                            <option value ="<?php echo $opciones['IdArea'] ?>"><?php echo $opciones['Descripcion'] ?></option>
                        
                        <?php endforeach ?>
                        </select> </label>
                        </div>
                        <div class="form-group">
                        <label>Puesto: <select name="" class="form-control" id="Puesto">

                        <?php 

                            include_once '../rsc/bd/conexion.php';
                            $objeto = new Conexion();
                            $conexion = $objeto->Conectar();
                            $consulta = "SELECT * FROM puestos  WHERE 1";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();        
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($data as $opciones): ?>
                        
                            <option value ="<?php echo $opciones['IdPuesto'] ?>"><?php echo $opciones['Descripcion'] ?></option>
                        
                        <?php endforeach ?>
                        </select> </label>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Nombre: </label>
                            <input type="text" class="form-control" id="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha de Nacimiento: </label>
                            <input type="date" class="form-control" id="FechaNac">
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
                            <label for="" class="col-form-label">Estado Laboral: </label>
                            <input type="text" class="form-control" id="Estado">
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
<script type="text/javascript" src="js/empleados.js"></script>  
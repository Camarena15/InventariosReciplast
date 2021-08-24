<?php require_once "../vistas/parte_superior.php"?>
<!-- INICIO del contenido principal -->

<div class="container"><h1>Catálogo de Equipos</h1></div>
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
                            <th>IdEquipo</th>
                            <th>Proveedor</th>
                            <th>Área</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>No. Serie</th>
                            <th>Fecha Adquisición</th>
                            <th>Fecha Garantía</th>
                            <th>Fecha Último Mantenimiento</th>
                            <th>Fecha Próximo Mantenimiento</th>
                            <th>Horas Trabajadas</th>
                            <th>Horas Último Corte</th>
                            <th>Estado</th>
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
                        <label>Proveedor: <select name="" class="form-control" id="IdProveedor">

                        <?php 

                            include_once '../rsc/bd/conexion.php';
                            $objeto = new Conexion();
                            $conexion = $objeto->Conectar();
                            $consulta = "SELECT * FROM proveedores WHERE 1";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();        
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($data as $opciones): ?>
                        
                            <option value ="<?php echo $opciones['IdProveedor'] ?>"><?php echo $opciones['Nombre'] ?>--<?php echo $opciones['DescripcionTipoProv'] ?></option>
                        
                        <?php endforeach ?>
                        </select> </label>
                        </div>
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
                            <label for="" class="col-form-label">Nombre: </label>
                            <input type="text" class="form-control" id="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Descripcion: </label>
                            <input type="text" class="form-control" id="Descripcion">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Marca: </label>
                            <input type="text" class="form-control" id="Marca">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Modelo: </label>
                            <input type="text" class="form-control" id="Modelo">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">No. Serie: </label>
                            <input type="text" class="form-control" id="NoSerie">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha de Adquisición: </label>
                            <input type="text" class="form-control" id="FechaAdq">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha de Garantía: </label>
                            <input type="text" class="form-control" id="FechaGarantia">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha Último Mantenimiento: </label>
                            <input type="text" class="form-control" id="FechaUltMant">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha Próximo Mantenimiento: </label>
                            <input type="text" class="form-control" id="FechaProxMant">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Horas Trabajadas: </label>
                            <input type="text" class="form-control" id="HorasTrabajadas">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Horas Ultimo Corte: </label>
                            <input type="text" class="form-control" id="HorasUltimoCorte">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Estado: </label>
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
<script type="text/javascript" src="js/equipos.js"></script>  
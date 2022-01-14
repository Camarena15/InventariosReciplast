<!DOCTYPE html>
<?php
    session_start();
    $arreglo[][]=0;
    $_SESSION['detalle']=$arreglo;
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - Reciplast de Occidente S.P.R. de R.L. de C.V.</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../rsc/css/img/logo.ico">
    <!-- Custom fonts for this template-->
    <!--<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../rsc/css/sb-admin-2.min.css" rel="stylesheet">
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../../vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../../vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../rsc/css/content.css"> 
    <link rel="stylesheet" href="http://reciplast.com.mx/css/carousel.css">
</head>

<body>
    <div id="container">
        <header>
            <nav class="navbar-expand-md navbar-dark fixed-top bg-dark" id="headnav">
                <a class="navbar-brand" href="../../index.php">Reciplast de Occidente, S.P.R. de R.L. de S.A.</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul>
                    <li class="active">
                        <a class="nav-link dropdown-toggle" href="#ususubmenu" id="userinfo" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Administrador
                        </a>
                        <ul class="dropdown-menu bg-dark" id="ususubmenu">
                            <li><a id="profilebtn" class="dropdown-item" href="/RecycleBin/profile.php">Mi Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="clearfix"></div>
        <aside id="my-sidebar">
            <ul id="sidebarul">
                <li>
                    <img src="../../rsc/css/img/Icon2.png" id="brand-icon">
                </li>
                <li class="nav-item"><a class="nav-link" href="../../index.php">
                        <h5>Inicio</h5>
                    </a></li>
                <li class="active">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="collapse" data-target="#catsubmenu" 
                    aria-expanded="true" aria-controls="catsubmenu">
                        Catálogos
                    </a>
                    <ul class="collapse lisst-unstyled" id="catsubmenu"  data-parent="#sidebarul">
                    <li class="dropdown-header" href="#">Catálogos Disponibles:<hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/RecycleBin/Catalogos/areas.php">Áreas</a></li>
                        <li><a class="dropdown-item" href="/RecycleBin/Catalogos/categorias.php">Categorías</a></li>
                        <li><a class="dropdown-item" href="/RecycleBin/Catalogos/empleados.php">Empleados</a></li>
                        <li><a class="dropdown-item" href="/RecycleBin/Catalogos/productos.php">Productos</a></li>
                        <li><a class="dropdown-item" href="/RecycleBin/Catalogos/proveedores.php">Proveedores</a></li>
                        <li><a class="dropdown-item" href="/RecycleBin/Catalogos/puestos.php">Puestos</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a class="nav-link dropdown-toggle" href="#" id="movimientos" role="button" data-target="#movsubmenu"
                        data-toggle="collapse" aria-expanded="true" ariacontrols="movsubmenu">
                        Movimientos
                    </a>
                    <ul class="collapse lisst-unstyled" id="movsubmenu" data-parent="#sidebarul">
                        <li class="active">
                            <a class="nav-link dropdown-toggle" href="#comprapro" id="compras" role="button"
                                data-bs-toggle="collapse" aria-expanded="false" style="font-size: 0.8em;">
                                Compras de Productos</a></li>
                                <ul class="collapse lisst-unstyled" id="comprapro" data-parent="sidebarul">
                                    <li><a class="dropdown-item" href="regComPro.php">Registrar</a></li>
                                    <li><a class="dropdown-item" href="consComPro">Consultar</a></li>
                                </ul>
                        <li class="active">
                            <a class="nav-link dropdown-toggle" href="#devpro" id="depro" role="button"
                                data-bs-toggle="collapse" aria-expanded="false" style="font-size: 0.8em;">
                                Devolución de Productos<br> de Vales</a></li>
                                <ul class="collapse lisst-unstyled" id="devpro">
                                    <li><a class="dropdown-item" href="regDevProd.php">Registrar</a></li>
                                    <li><a class="dropdown-item" href="consDevProd.php">Consultar</a></li>
                                </ul>
                        <li class="active">
                            <a class="nav-link dropdown-toggle" href="#pagospro" id="papro" role="button"
                                data-bs-toggle="collapse" aria-expanded="false" style="font-size: 0.8em;">
                                Pagos de Compras de Productos</a></li>
                                <ul class="collapse lisst-unstyled" id="pagospro">
                                    <li><a class="dropdown-item" href="regPagoCompra">Registrar</a></li>
                                    <li><a class="dropdown-item" href="consPagoCompra">Consultar</a></li>
                                </ul>
                        <li class="active">
                            <a class="nav-link dropdown-toggle" href="#reqpro" id="repro" role="button"
                                data-bs-toggle="collapse" aria-expanded="false" style="font-size: 0.8em;">
                                Requisición de Productos</a></li>
                                <ul class="collapse lisst-unstyled" id="reqpro">
                                    <li><a class="dropdown-item" href="regReqPro.php">Registrar</a></li>
                                    <li><a class="dropdown-item" href="caesReqPro.php">Cambiar Estado</a></li>
                                    <li><a class="dropdown-item" href="consReqPro.php">Consultar</a></li>
                                </ul>
                        <li class="active">
                            <a class="nav-link dropdown-toggle" href="#valescons" id="valcon" role="button"
                                data-bs-toggle="collapse" aria-expanded="false" style="font-size: 0.8em;">
                                Vales Consumibles</a></li>
                                <ul class="collapse lisst-unstyled" id="valescons">
                                    <li><a class="dropdown-item" href="regValesCons.php">Registrar</a></li>
                                    <li><a class="dropdown-item" href="consValeCons.php">Consultar</a></li>
                                </ul>
                    </ul>
                </li>
                <li class="active">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="collapse" data-target="#infsubmenu" 
                    aria-expanded="true" aria-controls="infsubmenu">
                        Informes
                    </a>
                    <ul class="collapse lisst-unstyled" id="infsubmenu">
                        <li><a class="dropdown-item" href="#">Relación de Existencias<br> de Productos por<br> Categoría</a></li>
                        <li><a class="dropdown-item" href="#">Lista de Productos a<br> Surtir</a></li>
                        <li><a class="dropdown-item" href="#">Relación de <br>Proveedores</a></li>
                        <li><a class="dropdown-item" href="#">Relación de <br>Empleados</a></li>
                        <li><a class="dropdown-item" href="#">Lista de Requisiciones<br> de Productos<br> por Estado</a></li>
                        <li><a class="dropdown-item" href="#">Lista de Requisiciones<br> de Servicios<br> por Estado</a></li>
                        <li><a class="dropdown-item" href="#">Compras de Productos<br> en un Periodo</a></li>
                        <li><a class="dropdown-item" href="#">Relación de Compras<br> de Productos a Vencer</a></li>
                        <li><a class="dropdown-item" href="#">Compras de Servicios<br> en un Periodo</a></li>
                        <li><a class="dropdown-item" href="#">Relación de Compras<br> de Servicios a Vencer</a></li>
                        <li><a class="dropdown-item" href="#">Pagos de Compras de<br> Productos en un <br>Periodo</a></li>
                        <li><a class="dropdown-item" href="#">Pagos de Compras de<br> Servicios en un <br>Periodo</a></li>
                        <li><a class="dropdown-item" href="#">Relación de Vales de<br> Consumibles en un <br>Periodo por Empleado</a></li>
                        <li><a class="dropdown-item" href="#">Relación de Devolución<br> de Refacciones de <br>Mantto en un Periodo</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <section id="content" style="background-image: none;">
<?php
    session_start();
    $priv;
    if (!isset($_SESSION["usuario"])) {
        header("Location:index.php");
    }else {
        include("conexion.php");
        $usuName = $_SESSION["usuario"];
        $pass = $_SESSION["password"];
        $consulta = "SELECT Sistema, Privilegio FROM usuarios WHERE `Nombre`= '$usuName' AND `Contrasena`= '$pass'";
        $resultados = mysqli_query($conexion,$consulta);
        $fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC);
        $sistema = $fila["Sistema"];
        $priv=$fila["Privilegio"];
        if($sistema <> "I"){
            header("Location:index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Inventario - Reciplast de Occidente S.P.R. de R.L. de C.V.</title>
    <link rel="shortcut icon" type="image/x-icon" href="rsc/css/img/logo.ico">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="rsc/css/sb-admin-2.min.css" rel="stylesheet">
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    
    <link rel="stylesheet" href="rsc/css/content.css"> 
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <br>
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="principal.php">
                <div class="sidebar-brand-ico">
                <img height="100px" width="100px" src="rsc/css/img/Icon.jpg">
                    <i class="#"></i>
                </div>
                </a>
            <br>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="principal.php">
                    <i class="#"></i>
                    <span>Página Principal</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Servicios
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="#"></i>
                    <span>Catálogos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Catálogos Disponibles:</h6>
                        <a class="collapse-item" href="areas.php">Áreas</a>
                        <a class="collapse-item" href="categorias.php">Categorías</a>
                        <a class="collapse-item" href="empleados.php">Empleados</a>
                        <a class="collapse-item" href="productos.php">Productos</a>
                        <a class="collapse-item" href="proveedores.php">Proveedores</a>
                        <a class="collapse-item" href="puestos.php">Puestos</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Movimientos
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordmantint"
                    aria-expanded="true" aria-controls="ordmantint">
                    <i class="#"></i>
                    <span>Compras de Productos</span>
                </a>
                <div id="ordmantint" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php if ($priv==2) echo '
                        <a class="collapse-item" href="regComPro.php">Registrar</a>';?>
                        <a class="collapse-item" href="consComPro">Consultar</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vmi"
                    aria-expanded="true" aria-controls="vmi">
                    <i class="#"></i>
                    <span>Devolución de Productos</span>
                </a>
                <div id="vmi" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($priv==2) echo ' 
                        <a class="collapse-item" href="regDevProd.php">Registrar</a>'?>
                        <a class="collapse-item" href="consDevProd.php">Consultar</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dmi"
                    aria-expanded="true" aria-controls="dmi">
                    <i class="#"></i>
                    <span>Pagos de Compras de Productos</span>
                </a>
                <div id="dmi" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                    <?php if ($priv==2) echo '
                        <a class="collapse-item" href="regPagCom.php">Registrar</a>'?>
                        <a class="collapse-item" href="consPagCom.php">Consultar</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fmi"
                    aria-expanded="true" aria-controls="fmi">
                    <i class="#"></i>
                    <span>Requisición de Productos</span>
                </a>
                <div id="fmi" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($priv==2) echo ' 
                        <a class="collapse-item" href="regReqPro.php">Registrar</a>
                        <a class="collapse-item" href="caesReqPro.php">Cambiar Estado</a>'?>
                        <a class="collapse-item" href="consReqPro.php">Consultar</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ome"
                    aria-expanded="true" aria-controls="ome">
                    <i class="#"></i>
                    <span>Vales Consumibles</span>
                </a>
                <div id="ome" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($priv==2) echo ' 
                        <a class="collapse-item" href="regValesCons.php">Registrar</a>'?>
                        <a class="collapse-item" href="consValeCons.php">Consultar</a>
                        
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="#"></i>
                    <span>Informes</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Informes Disponibles:</h6>
                        <a class="collapse-item" href="R_exisprod.php">Relación de Existencias<br> de Productos por<br> Categoría</a>
                        <a class="collapse-item" href="R_liprosur.php">Lista de Productos a<br> Surtir</a>
                        <a class="collapse-item" href="R_relprov.php">Relación de <br>Proveedores</a>
                        <a class="collapse-item" href="R_relemp.php">Relación de <br>Empleados</a>
                        <a class="collapse-item" href="R_reqest.php">Lista de Requisiciones<br> de Productos<br> por Estado</a>
                        <a class="collapse-item" href="R_coprope.php">Compras de Productos<br> en un Periodo</a>
                        <a class="collapse-item" href="R_coprove.php">Relación de Compras<br> de Productos a Vencer</a>
                        <a class="collapse-item" href="R_paprope.php">Pagos de Compras de<br> Productos en un <br>Periodo</a>
                        <a class="collapse-item" href="R_revalcon.php">Relación de Vales de<br> Consumibles en un <br>Periodo por Empleado</a>
                        <a class="collapse-item" href="R_redepro.php">Relación de Devolución<br> de Productos de <br>Vales en un Periodo</a>
                    </div>
                </div>
            </li>
            <?php if ($priv==2) echo '
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                Sistema
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsettings"
                    aria-expanded="true" aria-controls="collapsettings">
                    <i class="#"></i>
                    <span>Ajustes</span>
                </a>
                <div id="collapsettings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="regNuevoUsr.php">Administrar Usuarios</a>
                    </div>
                </div>
            </li>';?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="contenido">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="userN"><?php echo $_SESSION["usuario"]?></span>
                                <img class="img-profile rounded-circle"
                                    src="rsc/css/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>
                    
                </nav>
                <?php

                    
                ?>
                <!-- End of Topbar -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - Reciplast de Occidente S.P.R. de R.L. de C.V.</title>
    <link rel="shortcut icon" type="image/x-icon" href="rsc/css/img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://reciplast.com.mx/css/carousel.css">
    <link rel="stylesheet" href="rsc/css/content.css"> 

</head>

<body>
    <div id="container">
        <header>
            <nav class="navbar-expand-md navbar-dark fixed-top bg-dark" id="headnav">
                <a class="navbar-brand" href="../index.php">Reciplast de Occidente, S.P.R. de R.L. de S.A.</a>
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
            <ul>
                <li>
                    <img src="rsc/css/img/Icon2.png" id="brand-icon">
                </li>
                <li class="nav-item"><a class="nav-link" href="../index.php">
                        <h5>Inicio</h5>
                    </a></li>
                <li class="active">
                    <a class="nav-link dropdown-toggle" href="#catsubmenu" id="catalogos" role="button"
                        data-bs-toggle="collapse" aria-expanded="false">
                        Catálogos
                    </a>
                    <ul class="collapse lisst-unstyled" id="catsubmenu">
                        <li class="dropdown-header" href="#">Catálogos Disponibles:<hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Áreas</a></li>
                        <li><a class="dropdown-item" href="#">Categorías</a></li>
                        <li><a class="dropdown-item" href="#">SubCategorías</a></li>
                        <li><a class="dropdown-item" href="#">Componentes</a></li>
                        <li><a class="dropdown-item" href="#">Empleados</a></li>
                        <li><a class="dropdown-item" href="#">Equipos</a></li>  
                        <li><a class="dropdown-item" href="#">Programa Equipo</a></li>
                        <li><a class="dropdown-item" href="/Catalogos/productos.php">Productos</a></li>
                        <li><a class="dropdown-item" href="#">Proveedores</a></li>
                        <li><a class="dropdown-item" href="/RecycleBin/profile.php">Puestos</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a class="nav-link dropdown-toggle" href="#movsubmenu" id="movimientos" role="button"
                        data-bs-toggle="collapse" aria-expanded="false">
                        Movimientos
                    </a>
                    <ul class="collapse lisst-unstyled" id="movsubmenu">
                        <li><a class="dropdown-item" href="#">Caja Herramientas</a></li>
                        <li><a class="dropdown-item" href="#">Compras de Productos</a></li>
                        <li><a class="dropdown-item" href="#">Compras de Servicio</a></li>
                        <li><a class="dropdown-item" href="#">Devolución de Productos de Mantto</a></li>
                        <li><a class="dropdown-item" href="#">Pagos de Compras de Productos</a></li>
                        <li><a class="dropdown-item" href="#">Pagos de Compras de Servicios</a></li>
                        <li><a class="dropdown-item" href="#">Requisición de Productos</a></li>
                        <li><a class="dropdown-item" href="#">Requisición de Servicios</a></li>
                        <li><a class="dropdown-item" href="#">Vales Consumibles</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a class="nav-link dropdown-toggle" href="#infsubmenu" id="informes" role="button"
                        data-bs-toggle="collapse" aria-expanded="false">
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

        <section id="content">
            <img src="rsc/css/img/Icon.jpg" alt="Logo" class="img-fluid" style="width: 100px; float: right;">
            <br><br><br><br><br>
            <h2 style="color: white; float: right;">Reciplast de Occidente S.P.R. de R.L. de C.V.</h2>
            <br><br>
            <h3 style="color: white; float: right;">Comprometidos con el medio ambiente</h3>
        </section>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Reciplast de Occidente de S.P.R. de R.L. de C.V.</span><hr>
                    <span>Emmanuel Camarena Becerra</span>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha384-S58meLBGKxIiQmJ/pJ8ilvFUcGcqgla+mWH9EEKGm6i6rKxSTA2kpXJQJ8n7XK4w"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="rsc/js/styles.js"></script>

</body>

</html>
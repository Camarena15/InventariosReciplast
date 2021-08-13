<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="rsc/css/img/logo.ico">
    <title>Iniciar Sesión - Reciplast de Occidente S.P.R. de R.L. de C.V.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://reciplast.com.mx/css/carousel.css">
    <link rel="stylesheet" href="http://reciplast/rsc/css/content.css">
</head>
<body id="bodylogin">
    <div id="container">
    <header>
            <nav class="navbar-expand-md navbar-dark fixed-top bg-dark" id="headnav">
                <a class="navbar-brand" href="">Reciplast de Occidente, S.P.R. de R.L. de S.A.</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
    </header>
    <div class="clearfix"></div>
    <section id="content">
    <img src="rsc/css/img/Icon.jpg" id="imglogin">
    <div id="framelogin">
    <h1>INTRODUCE TUS DATOS</h1>
    <form action="comprueba_login.php" method="post">
        <table><tr>
            <td class="izqu">
                Usuario: 
            </td>
            <td class="der">
                <input type="text" name="login" class="form-control" maxlength="20">
            </td>
        </tr>
        <tr>
            <td class="izqu">
                Contraseña: 
            </td>
            <td class="der">
                <input type="password" name="password" class="form-control"  maxlength="20">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <input class="btn btn-dark" type="submit" value="Iniciar Sesión" name="enviar">
            </td>
        </tr>
        </table>
        
    </form>
    </div>
    </section>
    </div>
</body>
</html>
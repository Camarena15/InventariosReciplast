<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="rsc/css/img/logo.ico">
    <title>Documentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://reciplast.com.mx/css/carousel.css">
    <link rel="stylesheet" href="rsc/css/content.css">
</head>
<body id="body-bcknd">
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
    <img src="rsc/css/img/Icon.jpg" alt="" srcset="" style="float:right; width: 200px; padding: 5px;">
    <h1>INTRODUCE TUS DATOS</h1>
    <form action="comprueba_login.php" method="post">
        <table><tr>
            <td class="izqu">
                Login:
            </td>
            <td class="der">
                <input type="text" name="login">
            </td>
        </tr>
        <tr>
            <td class="izqu">
                Password:
            </td>
            <td class="der">
                <input type="password" name="password">
            </td>
        </tr>
        <tr>
            <td collspan="2">
                <input class="btn btn-dark" type="submit" value="LOGIN" name="enviar">
            </td>
        </tr>
        </table>
        
    </form>
    
    </section>
    </div>
</body>
</html>
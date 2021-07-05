<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("Location:login.php");
        }
    ?>
    <h1>Bienvenidos Usuarios</h1>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam totam 
        corporis ex, quam odio amet asperiores optio voluptates dicta ut pariatur, soluta debitis atque odit fugit, aliquam unde? Aliquid, architecto.</p>
        <a href="usuarios_registrados1.php">Volver</a><br><br>
        <a href="cierre.php">Cierra Sesion</a><br><br>
    <?php
    
        echo "Usuario: " . $_SESSION["usuario"] . "<br><br>";

    ?>
    
</body>
</html>
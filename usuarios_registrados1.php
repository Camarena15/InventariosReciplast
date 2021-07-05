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
    <hr>
    <table style="border: inset 1px;">
        <tr>
            <td colspan="3">Zona usuarios Registrados</td>
        </tr>
        <tr>
            <td style="border: inset 1px;"><a href="usuarios_registrados2.php">Pagina 1</a></td>
            <td style="border: inset 1px;"><a href="usuarios_registrados3.php">Pagina 2</a></td>
            <td style="border: inset 1px;"><a href="usuarios_registrados4.php">Pagina 3</a></td>
        </tr>
    </table>
    <hr>
    <?php
    
        echo "Hola: " . $_SESSION["usuario"] . "<br><br>";

    ?>
    
</body>
</html>
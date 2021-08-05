<?php 
        require("datos_conexion.php");
        //conectar por PROCEDIMIENTOS
        $conexion = mysqli_connect($db_host,$db_usuario,$db_pass,$db_nombre);

        if (mysqli_connect_errno()){
            echo "Fallo al conectar con la BBDD";
            exit();
        }
        mysqli_set_charset($conexion,"utf-8");
    ?>
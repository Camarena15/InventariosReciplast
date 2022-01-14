<?php

        try {

            $base = new PDO ("mysql:host=db5003537921.hosting-data.io:3306; dbname=dbs2878085;", "dbu1577258", "w52NXfdnj.isC2B");
            
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "SELECT * FROM usuarios WHERE `Nombre`= :login AND `Contrasena`= :password";
            
            $resultado = $base->prepare($sql);

            $login=htmlentities(addslashes($_POST["login"])); /*Convierte cualquier simbolo en htm*/
            
            $password=htmlentities(addslashes($_POST["password"]));
            
            $resultado->bindValue(":login", $login);

            $resultado->bindValue(":password", $password);

            $resultado->execute();

            $numero_registro = $resultado->rowCount();


            if($numero_registro != 0){
                session_start();
                $_SESSION["usuario"]=$_POST["login"];
                $_SESSION["password"]=$_POST["password"];
                header("location:principal.php");

            } else {

                header("location:index.php");

            }


        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    
    ?>
<?php
date_default_timezone_set('America/Mexico_City');
//Introduzca aquí la información de su base de datos y el nombre del archivo de copia de seguridad.
require("datos_conexion.php");
$db_host="db5003537921.hosting-data.io";
$salida_sql = (isset($_POST['filename'])) ? $_POST['filename'] : '';
$salida_sql = "backups/" . $salida_sql . '.sql';
//Por favor, no haga ningún cambio en los siguientes puntos
//Exportación de la base de datos y salida del status
$command="mysqldump -h$db_host -u$db_usuario -p$db_pass --opt $db_nombre > $salida_sql";
exec($command,$output,$worked);
?>
<?php 
class Conexion{	  
    public static function Conectar() {        
        //define('servidor', 'db5003537921.hosting-data.io:3306');
        define('servidor', 'localhost');
        define('nombre_bd', 'dbs2878085');
        define('usuario', 'dbu1577258');
        define('password', 'w52NXfdnj.isC2B');					        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}
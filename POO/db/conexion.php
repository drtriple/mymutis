<?php

//Conexión a usar en el proyecto es: PDO permite conectar a diversos motores de base

//mysqli: Conexión a mysql para trabajar orientación a objetos.

//mysql: Conexión a mysql pero sin orientación a objetos.

class Conexion{
    private static $conexion = NULL;
    private function __construct(){}

    public static function Conectar(){
        //$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        self::$conexion = new PDO('mysql:host=localhost;dbname=mymutisc_mutis','mymutisc_administrador','?u5&Dt(7FjXw',$pdo_options);
        return self::$conexion;
    }

    static function Desconectar($conexion){
        $conexion = null;
    }
}


//$baseDatos = Conexion::Conectar();
//echo "Conectar";
?>
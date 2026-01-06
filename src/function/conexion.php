<?php

class Cconexion{
    static function ConexionBD(){

        $host = 'MSI';
        $db = 'TUC';
        $user = 'sa';
        $password = '123456';
        $puerto = 1433;
    
        try {
            $conn = new PDO ("sqlsrv:Server=$host,$puerto;Database=$db",$user,$password);
            //echo "Conexión exitosa a la base de datos: $db";
            return $conn;
            
        } catch (PDOException $exp) {
            echo ("No se logro conectar correctamente con la base de datos: $db, error: $exp");
        }

       
    }
}


?>
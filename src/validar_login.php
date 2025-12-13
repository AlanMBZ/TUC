<?php
class Cvalidar_login {
    static function validarUsuario($usuario, $contrasena) {

        $conn = Cconexion::ConexionBD();

        $sql = "SELECT 1 FROM usuario 
                WHERE correo = :correo AND contrasena = :contrasena";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        return $stmt->fetch() ? true : false;
    }
}
?>

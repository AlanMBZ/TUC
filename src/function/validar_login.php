<?php
class Cvalidar_login {
    static function validarUsuario($correo, $contrasena) {

        $conn = Cconexion::ConexionBD();

        $sql = "SELECT matricula, rol 
                FROM usuario
                WHERE correo = :correo AND contrasena = :contrasena";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // false si no existe
    }
}
?>

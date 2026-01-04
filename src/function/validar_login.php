<?php
class Cvalidar_login {

    static function validarUsuario($correo, $contrasena) {

        $conn = Cconexion::ConexionBD();

        $sql = "SELECT matricula, rol, estado
                FROM usuario
                WHERE correo = :correo
                  AND contrasena = :contrasena";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // No existe usuario
        if (!$usuario) {
            return [
                'ok' => false,
                'mensaje' => 'Correo o contraseña incorrectos'
            ];
        }

        // Usuario pendiente
        if ($usuario['estado'] == 0) {
            return [
                'ok' => false,
                'mensaje' => 'Tu cuenta está pendiente de validación'
            ];
        }

        // Usuario rechazado
        if ($usuario['estado'] == 2) {
            return [
                'ok' => false,
                'mensaje' => 'Tu registro fue rechazado'
            ];
        }

        // Usuario aprobado
        return [
            'ok' => true,
            'matricula' => $usuario['matricula'],
            'rol' => $usuario['rol']
        ];
    }
}
?>
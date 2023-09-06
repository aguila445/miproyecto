<?php
class Usuario_model extends CI_Model {

    public function validar($login, $password) {
        // Consulta para validar el usuario y contraseña
        $query = $this->db->get_where('usuario', array('login' => $login, 'password' => md5($password)));

        return $query;
    }

    public function registrarNuevoUsuario($login, $password, $email, $tipo) {
        // Datos para insertar un nuevo usuario
        $data = array(
            'login' => $login,
            'password' => md5($password),
            'email' => $email,
            'tipo' => $tipo // Esto podría ser 'cliente', 'conductor', 'administrador', etc.
        );

        // Insertar el nuevo usuario en la base de datos
        $this->db->insert('usuario', $data);

        // Devolver el ID del usuario insertado
        return $this->db->insert_id();
    }

    public function obtenerUsuarioPorID($idUsuario) {
        // Obtener un usuario por su ID
        $query = $this->db->get_where('usuario', array('idUsuario' => $idUsuario));

        return $query->row();
    }

    public function actualizarUsuario($idUsuario, $data) {
        // Actualizar la información de un usuario
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $data);
    }

    public function eliminarUsuario($idUsuario) {
        // Eliminar un usuario por su ID
        $this->db->delete('usuario', array('idUsuario' => $idUsuario));
    }


    
    public function registrarUsuario($nombre, $email) {
        // Generar un nombre de usuario único
        $login = $this->generarNombreUsuario($nombre);
        
        // Generar una contraseña segura
        $password = $this->generarPassword();

        // Insertar los datos en la base de datos
        $data = array(
            'login' => $login,
            'password' => password_hash($password, PASSWORD_BCRYPT), // Hashear la contraseña
            'email' => $email,
            // Otras columnas de la tabla usuarios
        );

        $this->db->insert('usuarios', $data);

        // Enviar el correo electrónico con las credenciales
        $this->enviarCredencialesPorCorreo($login, $password, $email);
    }

    private function generarNombreUsuario($nombre) {
        // Generar un nombre de usuario a partir del nombre del usuario (puedes personalizar esto)
        $nombre = strtolower($nombre);
        $nombre = str_replace(' ', '_', $nombre);
        $nombre = substr($nombre, 0, 10); // Limitar a 10 caracteres, por ejemplo
        $login = $nombre . rand(100, 999); // Agregar un número aleatorio único
        return $login;
    }

    private function generarPassword() {
        // Generar una contraseña segura (puedes personalizar esto)
        return bin2hex(random_bytes(8)); // Generar una contraseña de 16 caracteres hexadecimal
    }

    private function enviarCredencialesPorCorreo($login, $password, $email) {
        // Aquí implementa el código para enviar un correo electrónico con las credenciales
        // Puedes usar la librería de envío de correo electrónico de CodeIgniter o alguna otra
        // Asegúrate de configurar la función de envío de correo electrónico en tu aplicación.
    }
}
?>

<?php
class Conductor_model extends CI_Model {

    public function listaconductores() {
        // Obtener la lista de conductores habilitados
        $this->db->select('*');
        $this->db->from('conductor');
        $this->db->where('estado', 'habilitado');
        return $this->db->get();
    }

    public function listaconductoresdeshabilitado() {
        // Obtener la lista de conductores deshabilitados
        $this->db->select('*');
        $this->db->from('conductor');
        $this->db->where('estado', 'deshabilitado');
        return $this->db->get();
    }

    public function agregarconductor($data) {
        // Agregar un nuevo conductor a la base de datos
        $this->db->insert('conductor', $data);
    }

    public function eliminarconductor($idConductor) {
        // Eliminar un conductor por su ID
        $this->db->where('idConductor', $idConductor);
        $this->db->delete('conductor');
    }

    public function recuperarconductor($idConductor) {
        // Obtener información de un conductor por su ID
        $this->db->select('*');
        $this->db->from('conductor');
        $this->db->where('idConductor', $idConductor);
        return $this->db->get();
    }

    public function modificarconductor($idConductor, $data) {
        // Modificar la información de un conductor por su ID
        $this->db->where('idConductor', $idConductor);
        $this->db->update('conductor', $data);
    }
}
?>

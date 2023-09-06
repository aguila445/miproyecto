<?php
class Cliente_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Insertar un nuevo cliente en la base de datos
    public function agregarCliente($data)
    {
        $this->db->insert('cliente', $data);
    }

    // Obtener información de un cliente por su ID
    public function obtenerClientePorID($idCliente)
    {
        $this->db->where('idCliente', $idCliente);
        return $this->db->get('cliente')->row_array();
    }

    // Actualizar información de un cliente
    public function modificarCliente($idCliente, $data)
    {
        $this->db->where('idCliente', $idCliente);
        $this->db->update('cliente', $data);
    }

    // Eliminar un cliente por su ID
    public function eliminarCliente($idCliente)
    {
        $this->db->where('idCliente', $idCliente);
        $this->db->delete('cliente');
    }

    // Lista de todos los clientes
    public function listaClientes()
    {
        return $this->db->get('cliente')->result_array();
    }
}
?>

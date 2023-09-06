<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo de cliente
        $this->load->model('Cliente_model', 'cliente_model');
    }

    public function index()
    {
        // Obtener la lista de todos los clientes
        $data['cliente'] = $this->cliente_model->listaClientes();
        // Cargar la vista que muestra la lista de clientes
        $this->load->view('cliente_lista', $data);
    }

    public function agregar()
    {
        // Mostrar un formulario para agregar un nuevo cliente
        $this->load->view('cliente_agregar');
    }

    public function guardar()
    {
        // Obtener los datos del formulario
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'email' => $this->input->post('email'),
            'latitud' => $this->input->post('latitud'),
            'longitud' => $this->input->post('longitud'),
            'estado' => $this->input->post('estado')
        );

        // Insertar el nuevo cliente en la base de datos
        $this->cliente_model->agregarCliente($data);

        // Redirigir a la lista de clientes
        redirect('cliente/index');
    }

    public function editar($idCliente)
    {
        // Obtener la información del cliente por su ID
        $data['cliente'] = $this->cliente_model->obtenerClientePorID($idCliente);

        // Mostrar el formulario de edición
        $this->load->view('cliente_editar', $data);
    }

    public function actualizar($idCliente)
    {
        // Obtener los datos del formulario
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'email' => $this->input->post('email'),
            'latitud' => $this->input->post('latitud'),
            'longitud' => $this->input->post('longitud'),
            'estado' => $this->input->post('estado')
        );

        // Actualizar la información del cliente en la base de datos
        $this->cliente_model->modificarCliente($idCliente, $data);

        // Redirigir a la lista de clientes
        redirect('cliente/index');
    }

    public function eliminar($idCliente)
    {
        // Eliminar el cliente por su ID
        $this->cliente_model->eliminarCliente($idCliente);

        // Redirigir a la lista de clientes
        redirect('cliente/index');
    }
}


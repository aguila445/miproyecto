<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('login')) 
        {
            // Si el usuario ya está autenticado, redirígelo a su panel correspondiente
            if ($this->session->userdata('tipo') == 'cliente') {
                redirect('cliente/panel', 'refresh');
            } elseif ($this->session->userdata('tipo') == 'conductor') {
                redirect('conductor/panel', 'refresh');
            } else {
                // Puedes manejar otros tipos de usuarios aquí
                // Por ejemplo, si tienes usuarios administradores
                redirect('admin/panel', 'refresh');
            }
        } 
        else 
        {
            $data['msg'] = $this->uri->segment(3);
            $this->load->view('login', $data);
        }
    }

    public function validarusuario()
    {
        $login = $_POST['login'];
        $password = md5($_POST['password']);

        // Supongo que tienes métodos para validar usuarios en tus modelos respectivos
        // Reemplaza 'cliente_model' y 'conductor_model' por tus modelos reales
        $cliente = $this->cliente_model->validar($login, $password);
        $conductor = $this->conductor_model->validar($login, $password);

        if ($cliente->num_rows() > 0) {
            $row = $cliente->row();
            $this->session->set_userdata('idusuario', $row->idCliente);
            $this->session->set_userdata('login', $row->login);
            $this->session->set_userdata('tipo', 'cliente');
            redirect('cliente/panel', 'refresh');
        } elseif ($conductor->num_rows() > 0) {
            $row = $conductor->row();
            $this->session->set_userdata('idusuario', $row->idConductor);
            $this->session->set_userdata('login', $row->login);
            $this->session->set_userdata('tipo', 'conductor');
            redirect('conductor/panel', 'refresh');
        } else {
            redirect('usuario/index/1', 'refresh');
        }
    }

    public function panel()
    {
        if ($this->session->userdata('login')) {
            $tipo = $this->session->userdata('tipo');
            if ($tipo == 'cliente') {
                // Redirige al panel del cliente
                redirect('clientes/panel', 'refresh');
            } elseif ($tipo == 'conductor') {
                // Redirige al panel del conductor
                redirect('conductor/panel', 'refresh');
            } else {
                // Puedes manejar otros tipos de usuarios aquí
                // Por ejemplo, si tienes usuarios administradores
                redirect('admin/panel', 'refresh');
            }
        } else {
            redirect('usuario/index/2', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('usuario/index/3', 'refresh');
    }


    public function registrar() {
        // Cargar el modelo de usuarios
        $this->load->model('Usuario_model');

        // Recuperar los datos del formulario de registro
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');

        // Llamar al método para registrar el usuario
        $this->Usuario_model->registrarUsuario($nombre, $email);

        // Redireccionar o mostrar una vista de confirmación
        // Redirigir al usuario a una página de confirmación o mostrar un mensaje de éxito
    }
}
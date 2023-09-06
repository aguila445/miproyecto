<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('login')) 
        {
            redirect('usuarios/panel', 'refresh');
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

        $consulta = $this->usuario_model->validar($login, $password);

        if ($consulta->num_rows() > 0)
         {
            foreach ($consulta->result() as $row) {
                $this->session->set_userdata('idusuario', $row->idUsuario);
                $this->session->set_userdata('login', $row->login);
                $this->session->set_userdata('tipo', $row->tipo);
                redirect('usuarios/panel', 'refresh');
            }
        } else {
            redirect('usuarios/index/1', 'refresh');
        }
    }
    public function panel()
    {
        if ($this->session->userdata('login')) {
            $tipo=$this->session->userdata('tipo');
            if ($tipo=='admi') {
                redirect('estudiante/indexlte', 'refresh');
            }
            else {
                redirect('estudiante/invitadolte', 'refresh');
            }
        } else {
            redirect('usuarios/index/2', 'refresh');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('usuarios/index/3', 'refresh');
    }
}

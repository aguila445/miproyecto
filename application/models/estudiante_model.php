<?php
    class Estudiante_model extends CI_Model{
        public function listaestudiantes()
        {
            $this->db->select('*');
            $this->db->from('estudiante');
            $this->db->where('habilitado','1');
            return $this->db->get();
        }
        public function listaestudiantedeshabilitado()
        {
            $this->db->select('*');
            $this->db->from('estudiante');
           $this->db->where('habilitado','0');
            return $this->db->get();
        }

        public function agregarestudiante($data)
        {
            $this->db->insert('estudiante',$data); //$data es un array relacional, se contruye en agregabd
        }

        public function eliminarestudiante($idEstudiante)
        {
            $this->db->where('idEstudiante',$idEstudiante);// El primero es de la base de datos
            $this->db->delete('estudiante');
            //$data es un array relacional, se contruye en agregabd
        }
        public function recuperarestudiante($idEstudiante)
        {
            $this->db->select('*');
            $this->db->from('estudiante');
            $this->db->where('idEstudiante',$idEstudiante);// El primero es de la base de datos, el segundo se recibe del parametro
            return $this->db->get();
        }

        public function modificarestudiante($idEstudiante,$data)
        {
            $this->db->where('idEstudiante',$idEstudiante);// El primero es de la base de datos, el segundo se recibe del parametro
            $this->db->update('estudiante',$data);
        }

    }
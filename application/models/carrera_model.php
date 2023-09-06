<?php
    class Carrera_model extends CI_Model{
        public function listaCarreras()
        {
            $this->db->select('*');
            $this->db->from('carrera');
            return $this->db->get();
        }
        
      public function inscribirconductor($idCarrera,$data)
      {
        $this->db->trans_start();   //aqui inicia la transaccion
    
        $this->db->insert('conductor',$data);  //insertamos conductor
        $idconductor=$this->db->insert_id();   //recupera el ultimo id insertado

        $data2['idCarrera']=$idCarrera; // creamos data2
        $data2['idconductor']=$idconductor;   //creamos data2
        $this->db->insert('inscripcion',$data2); //hasta aqui no hay transacciones, solo registra en la tabla inscripcion
    
        $this->db->trans_complete();    //aqui termina la transaccion
        
        if($this->db->trans_status()==false)
        {
            return false;
        }
    } 

    }
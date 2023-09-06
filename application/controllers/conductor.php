<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Conductor extends CI_Controller
    {
        public function indexlte()
        {
            if ($this->session->userdata('login')) {
                $conductores = $this->conductor_model->listaconductores();
                $data['conductor'] = $conductores;
    
                $this->load->view('inclte/cabecera');
                $this->load->view('inclte/menusuperior');
                $this->load->view('inclte/menulateral');
                $this->load->view('conductor/cond_listalte', $data);
                $this->load->view('inclte/pie');
            } else {
                redirect('usuario/index', 'refresh');
            }
        }
    
        public function subircurriculum()
        {
            if ($this->session->userdata('login')) {
                $data['idConductor'] = $_POST['idConductor'];
                $this->load->view('inclte/cabecera');
                $this->load->view('inclte/menusuperior');
                $this->load->view('inclte/menulateral');
                $this->load->view('conductor/subirform', $data);
                $this->load->view('inclte/pie');
            } else {
                redirect('usuario/index/2', 'refresh');
            }
        }
    
        public function subir()
        {
            if ($this->session->userdata('login')) {
                $idConductor = $_POST['idConductor'];
                $nombreArchivo = $idConductor . ".pdf";
    
                $config['upload_path'] = './uploads/conductor/';
                $config['file_name'] = $nombreArchivo;
    
                $direccion = "./uploads/conductores/" . $nombreArchivo;
                if (file_exists($direccion)) {
                    unlink($direccion);
                }
    
                $config['allowed_types'] = 'pdf';
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload()) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $data['curriculum'] = $nombreArchivo;
                    $this->conductor_model->modificarconductor($idConductor, $data);
                    $this->upload->data();
                }
                redirect('conductor/indexlte', 'refresh');
            } else {
                redirect('usuario/index/2', 'refresh');
            }
        }
    
        // Resto de los métodos adaptados según tus necesidades
        // ...
    
        public function invitadolte()
        {
            if ($this->session->userdata('login')) {
                $this->load->view('inclte/cabecera');
                $this->load->view('inclte/menusuperior');
                $this->load->view('inclte/menulateral');
                $this->load->view('conductor/cond_invitado');
                $this->load->view('inclte/pie');
            } else {
                redirect('usuario/index/2', 'refresh');
            }
        }
    
    

    public function listapdf()
    {
        if($this->session->userdata('login'))
        {  $lista=$this->conductor_model->listaconductores();
            $lista=$lista->result();

            $this->pdf=new pdf();
            $this->pdf->AddPage();
            $this->pdf->AliasNbPages();
            $this->pdf->SetTitle("lista de conductores");
            $this->pdf->SetLeftMargin(15);
            $this->pdf->SetRightMargin(15);
            $this->pdf->SetFillColor(210,210,210);
            $this->pdf->SetFont('Arial','B',11);
            //I italic  U underline  B bold  '' normal--ES EL ORDEN EN EL PARENTESIS
            $this->pdf->Ln(5);
            $this->pdf->Cell(30);
            $this->pdf->SetLeftMargin(120,10,'LISTA DE conductores',0,0,'c',1);
            // ancho,alto,texto o contenido,borde,generacion sgte celda
            //0 derecha 1 sgte linea 2 debajo
            // alineacion lcr, fill 0 1 

            $this->pdf->Ln(10);
            $this->pdf->SetFont('Arial','9');

            $num=1;
            foreach($lista as $row)
            {
                $nombre=$row->nombre;
                $primerApellido=$row->primerApellido;
                $segundoApellido=$row->segundoApellido;

                $this->pdf->Cell(7,5,$num,'TBLR',0,'L',0);
                $this->pdf->Cell(7,5,$nombre,'TBLR',0,'L',0);
                $this->pdf->Cell(7,5,$primerApellido,'TBLR',0,'L',0);
                $this->pdf->Cell(7,5,$segundoApellido,'TBLR',0,'L',0);
                $this->pdf->Ln(5);
                $num++;

            }

            $this->pdf->output("lista de conductores.pdf","I");
            //I mostrar en navegador
            //D forzar descarga
        }
    }

public function proformapdf()
{
    $this->pdf=new pdf();
    $this->pdf->AddPage();
    $this->pdf->AliasNbPages();
    $this->pdf->SetTitle("proforma");
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);

    $ruta=base_url()."img/pclogo.lpg";
    // importar imagenes
    $this->pdf->Image($ruta,10,20,30,18);//-> coordenadas y medidas (x,y,ancho,alto)

    $this->pdf->SetFont('courirer','B',10);  //fuente

    $this->pdf->Ln(10); //salto de linea    
    $this->pdf->Cell(20);
    $this->pdf->Cell(100,3,'COMPUTER SERVICE','TBLR',0,'L',0);  //TBLR->MARGEN,0->0->ORIENTACION DELA SGTE CELDA
    
    $this->pdf->ln(3);
    $this->pdf->Cell(20);
    $this->pdf->Cell(100,3,'calle bolivia N°133','',0,'l',0);
    
    $this->pdf->ln(3);
    $this->pdf->Cell(20);
    $this->pdf->Cell(100.3.'cochabamba-bolivia','',0,'L',0);

    $this->pdf->SetFont('courier','',8);
    $this->pdf->SetFillColor(51,204,51);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->SetDrawColor(23,15,23);
    $this->pdf->Cell(180,10,'PROFORMA','TBLR',0,'C',1);
    
    $this->pdf->Ln(15);

    $this->pdf->SetTextColor(0,0,0);
    $this->pdf->SetFont('courier','B',8);

    $this->pdf->Cell(30,5,'$fecha','tblr',0,'C',0);
    $fecha=date("d/m/Y");
    $this->pdf->Cell(30,5,$fecha,'tblr',0,'c',0);

    $this->pdf->Cell(5,5,'','',0,'C',0);

    $this->pdf->Cell(25,5,'cliente:','tblr',0,'c',0);
    $this->pdf->Cell(90,5,'juan pablo crespo mendez','tblr',0,'c',0);

    $this->pdf->Ln(5);

    $this->pdf->Cell(25,5,'validez:','tblr',0,'c',0);
    $this->pdf->Cell(30,5,utf8_decode('10 días'),'tblr',0,'c',0);

    $this->pdf->Cell(5,5,'','',0,'c',0);

    $this->pdf->Cell(25,5,'codigo:','tblr',0,'c',0);
    $this->pdf->Cell(90,5,'jpcm-1023','tblr',0,'c',0);

    $this->pdf->Ln(5);

    $this->pdf->Cell(65);
    $this->pdf->Cell(25,5,'NIT/CI:','tblr',0,'c',0);
    $this->pdf->Cell(30,5,'65438732','tblr',0,'c',0);

    $this->pdf->Ln(10);
        //configurar tabla de productos
    $this->pdf->SetFont('courier','B',8);
    $this->pdf->SetFillColor(51,204,51);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->SetDrawColor(23,15,23);
    $this->pdf->Cell(10,10,'COD','TBLR',0,'C',1);
    $this->pdf->Cell(110,10,'DESCRIPCION','TBLR',0,'C',1);
    $this->pdf->Cell(20,10,'CANTIDAD','TBLR',0,'C',1);
    $this->pdf->Cell(20,10,'P. UNITARIO','TBLR',0,'C',1);
    $this->pdf->Cell(20,10,'SUBTOTAL','TBLR',0,'C',1);
    $this->pdf->Ln(5);

    $this->pdf->SetFont('courier','B',8);
    $this->pdf->SetTextColor(0,0,0);
    $this->pdf->SetDrawColor(0,0,0);
    $this->pdf->Cell(10,5,'1524','TBLR',0,'C',1);
    $this->pdf->Cell(110,5,'MOUSE DE GAMA ALTA','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'5','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'20','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'10','TBLR',0,'C',1);
    $this->pdf->Ln(5);

    $this->pdf->SetFont('courier','B',8);
    $this->pdf->SetTextColor(0,0,0);
    $this->pdf->SetDrawColor(0,0,0);
    $this->pdf->Cell(10,5,'1024','TBLR',0,'C',1);
    $this->pdf->Cell(110,5,'TECLADO GAMER','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'1','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'100','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'200','TBLR',0,'C',1);
    $this->pdf->Ln(5);

    $this->pdf->SetFont('courier','B',8);
    $this->pdf->SetTextColor(0,0,0);
    $this->pdf->SetDrawColor(0,0,0);
    $this->pdf->Cell(10,5,'1004','TBLR',0,'C',1);
    $this->pdf->Cell(110,5,'MOUSE FLAT SCREEN','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'1','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'1000','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'1000','TBLR',0,'C',1);
    $this->pdf->Ln(5);

    $this->pdf->Cell(140);
    $this->pdf->Cell(20,5,'TOTAL BS.','TBLR',0,'C',1);
    $this->pdf->Cell(20,5,'1300','TBLR',0,'C',1);
    
    //para colocar imagen delante del contenido
    $ruta2=base_url()."img/front.png";
    $this->pdf->Image($ruta2,0,0,220,300);

    $this->pdf->output("proforma1.pdf","I");



    $this->pdf->output("proforma.pdf","I");  // I--> nueva ventana, D--> descarga
}
}


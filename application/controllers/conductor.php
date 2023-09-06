<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Conductor extends CI_Controller
{
    public function indexlte()
    {
        if($this->session->userdata('login'))
        {
            $lista=$this->conductor_model->listaconductores();
            $data['conductores']=$lista;
    
            $this ->load->view('inclte/cabecera');
            $this ->load->view('inclte/menusuperior');
            $this ->load->view('inclte/menulateral');
            $this ->load->view('est_listalte',$data);
            $this ->load->view('inclte/pie');
        }
        else
        {
            redirect('usuarios/index','refresh');
        }
        
    }
    public function subircurriculum()
    {
        if ($this->session->userdata('login')) {
            $data['idEstudiante'] = $_POST['idEstudiante'];
            $this->load->view('inclte/cabecera');
            $this->load->view('inclte/menusuperior');
            $this->load->view('inclte/menulateral');
            $this->load->view('subirform', $data);
            $this->load->view('inclte/pie');
        } else {
            redirect('usuarios/index/2', 'refresh');
        }
    }
    public function subir()
    {
        if ($this->session->userdata('login')) {
            $idEstudiante = $_POST['idEstudiante'];
            $nombreArchivo = $idEstudiante . ".pdf";

            $config['upload_path'] = './uploads/estudiantes/';
            $config['file_name'] = $nombreArchivo;

            $direccion = "./uploads/estudiantes/" . $nombreArchivo;
            if (file_exists($direccion)) 
            {
                unlink($direccion);
            }

            $config['allowed_types'] = 'png|pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) 
            {
                $data['error'] = $this->upload->display_errors();
            }
            else
             {
                $data['curriculum'] = $nombreArchivo;
                $this->estudiante_model->modificarestudiante($idEstudiante, $data);
                $this->upload->data();
            }
            redirect('estudiante/indexlte', 'refresh');
        } 
        else 
        {
            redirect('usuarios/index/2', 'refresh');
        }
    }
    
    public function agregar()
    {
        //mostrar un formulario(vista) para agregar nuevo estudiante
        $this ->load->view('inclte/cabecera');
        $this ->load->view('inclte/menusuperior');
        $this ->load->view('inclte/menulateral');
        $this ->load->view('inscribirform',);
        $this ->load->view('inclte/pie');
    }

    public function inscribir()
    {
            $data['infocarrera']=$this->carrera_model->listaCarreras();

            $this ->load->view('inclte/cabecera');
            $this ->load->view('inclte/menu');
            $this ->load->view('inscribirform',$data);
            $this ->load->view('inclte/pie');
    }

    public function inscribirdb()// se construye $data
    {
        //$data es un array relacional
        // atrib. DB       Y   FORMULARIO
        $data['nombre']=$_POST['nombre'];
        $data['primerApellido']=$_POST['apellido1'];// el primero es de la db y el segundo del formulario
        $data['segundoApellido']=$_POST['apellido2'];
        $data['idCarrera']=$_POST['curriculum'];
        
        $this->carrera_model->inscribirEstudiante($idCarrera,$data);//invocamos el metodo

        redirect('estudiante/indexlte','refresh');
    }
    

    public function agregardb()// se construye $data
    {
        //cargar libreria form_validation solo para este metodo
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre','nombre de ususario','required|min_length[5]|max_length[12],array('required'=>'se requiere el nombre','min_length'=>'por lo menos 5 caracteres','max_length'=>'maximo 12 caracteres'));
        //defino reglas y mensajes
        $this->form_validation->set_rules('apellido1','primer apellido','required|min_length[5]|max_length[12],array('required'=>'se requiere el nombre','min_length'=>'por lo menos 5 caracteres','max_length'=>'maximo 12 caracteres'));

        if($this->form_validation->run()==FALSE)
        {
            //si no supera la validacion, cargamos nuevamente el formulario
            $this ->load->view('inclte/cabecera');
            $this ->load->view('inclte/menusuperior');
            $this ->load->view('inclte/menulateral');
            $this ->load->view('est_formulario');
            $this ->load->view('inclte/pie');            
        }
        else
        {
        $data['nombre']=$_POST['nombre'];
        $data['primerApellido']=$_POST['apellido1'];// el primero es de la db y el segundo del formulario
        $data['segundoApellido']=$_POST['apellido2'];
        $data['nota']=$_POST['nota'];
        }
        //$data es un array relacional
        // atrib. DB       Y   FORMULARIO
        $data['nombre']=$_POST['nombre'];
        $data['primerApellido']=$_POST['apellido1'];// el primero es de la db y el segundo del formulario
        $data['segundoApellido']=$_POST['apellido2'];
        $data['nota']=$_POST['nota'];
        

        $this->estudiante_model->agregarestudiante($data);//invocamos el metodo

        redirect('estudiante/indexlte','refresh');
    }

    public function eliminardb()
    {
        $idEstudiante=$_POST['idEstudiante'];// tal como está en el formulario
        $this->estudiante_model->eliminarestudiante($idEstudiante);
        redirect('estudiante/indexlte','refresh');
    }
   
    public function modificar()
    {
        $idEstudiante=$_POST['idEstudiante'];
        $data['infProducto']=$this->estudiante_model->recuperarestudiante($idEstudiante);

        $this ->load->view('inclte/cabecera');
        $this ->load->view('inclte/menusuperior');
        $this ->load->view('inclte/menulateral');
        $this ->load->view('est_modificar',$data);
        $this ->load->view('inclte/pie');
    }

    public function modificardb()
    {
        $idEstudiante=$_POST['idEstudiante'];
        // el primero como en base
        $data['nombre']=$_POST['nombre'];
        $data['primerApellido']=$_POST['apellido1'];
        $data['segundoApellido']=$_POST['apellido2'];
        $this->estudiante_model->modificarestudiante($idEstudiante,$data);

        redirect('estudiante/indexlte','refresh');
    }
    public function deshabilitarbd()
    {
        $idEstudiante=$_POST['idEstudiante'];
        $data['habilitado']='0';

        $this->estudiante_model->modificarestudiante($idEstudiante,$data);

        redirect('estudiante/indexlte','refresh');

    }
    public function deshabilitados()
	{
        $lista=$this->estudiante_model->listaestudiantedeshabilitado();
        $data['estudiante']=$lista;

        $this ->load->view('inclte/cabecera');
        $this ->load->view('inclte/menusuperior');
        $this ->load->view('inclte/menulateral');
		$this->load->view('est_listadeshabilitado',$data);
        $this ->load->view('inclte/pie');
		
	}
    public function habilitarbd()
    {
        $idEstudiante=$_POST['idEstudiante'];
        $data['habilitado']='1';

        $this->estudiante_model->modificarestudiante($idEstudiante,$data);

        redirect('estudiante/deshabilitados','refresh');

    }
    public function invitadolte()
    {
        if ($this->session->userdata('login')) {
            $this ->load->view('inclte/cabecera');
            $this ->load->view('inclte/menusuperior');
            $this ->load->view('inclte/menulateral');
            $this->load->view('est_invitado');
            $this->load->view('inclte/pie');
        } else {
            redirect('usuarios/index/2', 'refresh');
        }
    }

    public function listapdf()
    {
        if($this->session->userdata('login'))
        {  $lista=$this->estudiante_model->listaestudiantes();
            $lista=$lista->result();

            $this->pdf=new pdf();
            $this->pdf->AddPage();
            $this->pdf->AliasNbPages();
            $this->pdf->SetTitle("lista de estudiantes");
            $this->pdf->SetLeftMargin(15);
            $this->pdf->SetRightMargin(15);
            $this->pdf->SetFillColor(210,210,210);
            $this->pdf->SetFont('Arial','B',11);
            //I italic  U underline  B bold  '' normal--ES EL ORDEN EN EL PARENTESIS
            $this->pdf->Ln(5);
            $this->pdf->Cell(30);
            $this->pdf->SetLeftMargin(120,10,'LISTA DE ESTUDIANTES',0,0,'c',1);
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

            $this->pdf->output("lista de estudiantes.pdf","I");
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

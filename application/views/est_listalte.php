<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de Conductores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Conductores habilitados </h3>
                <br>
                <a href="<?php echo base_url();?>index.php/estudiante/agregar">
                    <button type="button" class="btn btn-primary">Crear Conductor</button>
                </a>
                <a href="<?php echo base_url(); ?>index.php/estudiante/deshabilitados">
                  <button type="button" class="btn btn-warning">Ver lista deshabilitados</button>
                </a>
                <a href="<?php echo base_url(); ?>index.php/estudiante/inscribir">
                  <button type="button" class="btn btn-warning">Inscribir</button>
                </a>

                <a href="<?php echo base_url(); ?>index.php/usuarios/logout">
                  <button type="button" class="btn btn-warning">Cerrar sesion</button>
                </a>
<br>
<h3>
  login:<?php echo $this->session->userdata('login');?><br>
  id:<?php echo $this->session->userdata('idusuario');?><br>
  tipo:<?php echo $this->session->userdata('tipo');?><br>
</h3>

<hr>
<a href="<?php echo base_url(); ?>index.php/estudiante/listapdf" target="blank">
  <button type="submit" class="btn btn-prinary btn-block">proforma pdf</button>
</a>


<hr>
<a href="<?php echo base_url(); ?>index.php/estudiante/listapdf" target="blank">
  <button type="submit" class="btn btn-success btn-block">lista de estudiantes en pdf</button>
</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>n°</th> 
                      <th>nombre</th>
                      <th>apellido1</th>
                      <th>apellido2</th>
                      <th>Creacion</th>
                      <th>Curriculum</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                      <th>deshabilitar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $indice=1;//CONTADOR CORRELATIVO
                        foreach($conductores->result()as $row)
                        { 
                            //Debe coincidir los nombres de la tabla en la BD
                            //El id nunca debe mostrarse  
                    ?>
                        <tr>
                          <td><?php echo $indice;?></td>
                          <td><?php echo $row->nombre;?></td>
                          <td><?php echo $row->primerApellido;?></td>
                          <td><?php echo $row->segundoApellido;?></td>
                          <td><?php echo $row->email;?></td>
                          <td><?php echo $row->numeroMovil;?></td>
                          <td><?php echo $row->foto;?></td>
                          <td><?php echo $row->estado;?></td>
                          <td><?php echo formatearFecha($row->creado);?></td>
                          <td><?php echo ($row->curriculum);?></td>
                         
                          
                          <!--Se ocupa subir fotos-->
                          <td>
                                    <?php
                                    $curriculum = $row->curriculum;
                                    if ($curriculum == "") 
                                    {
                                    ?>
                                        <img width="100" src="<?php echo base_url(); ?>uploads/estudiantes/pdficon.png">
                                    <?php
                                    } else 
                                    {
                                    ?>
                                    <a href="<?php echo base_url(); ?>uploads/estudiantes/<?php echo $curriculum; ?>" target="_blank">
                                    <img width="100" src="<?php echo base_url(); ?>uploads/estudiantes/default.png">
                                    </a>
                                       
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    echo form_open_multipart('estudiante/subircurriculum');
                                    ?>
                                    <input type="hidden" name="idEstudiante" value="<?php echo $row->idEstudiante; ?>">
                                    <button type="submit" class="btn btn-warning">Subir</button>
                                    <?php
                                    echo form_close();
                                    ?>
                                </td>
                                <!--final para fotos-->
                          <td>
                                <?php
                                    echo form_open_multipart('estudiante/modificar')
                                ?>
                                    <input type="hidden" name="idEstudiante" value="<?php echo $row->idEstudiante;?>">
                                    <!--Se ocupa el tipo hidden para ocultar los id en la página-->

                                    <button type="submit" class="btn btn-primary">Modificar</button>
                                <?php
                                    echo form_close()
                                ?> 
                          </td>
                          <td>
                                <?php
                                    echo form_open_multipart('estudiante/eliminardb')
                                ?>
                                    <input type="hidden" name="idEstudiante" value="<?php echo $row->idEstudiante;?>">
                                    <!--Se ocupa el tipo hidden para ocultar los id en la página-->
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                <?php
                                    echo form_close()
                                ?> 
                          </td>
                          <td>
                                <?php
                                    echo form_open_multipart('estudiante/deshabilitarbd');
                                ?>
                                  <input type="hidden" name="idEstudiante" value="<?php echo $row->idEstudiante; ?>">
                                  <button type="submit" class="btn btn-warning">DESHABILITAR</button>        
                                <?php
                                    echo form_close();
                                ?>        
                          </td>
                        </tr>
                    <?php
                    $indice++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
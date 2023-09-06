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
                <a href="<?php echo base_url();?>index.php/conductor/agregar">
                    <button type="button" class="btn btn-primary">Crear Conductor</button>
                </a>
                <a href="<?php echo base_url(); ?>index.php/conductor/deshabilitados">
                  <button type="button" class="btn btn-warning">Ver lista deshabilitados</button>
                </a>
                <a href="<?php echo base_url(); ?>index.php/conductor/inscribir">
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
<a href="<?php echo base_url(); ?>index.php/conductor/listapdf" target="blank">
  <button type="submit" class="btn btn-prinary btn-block">proforma pdf</button>
</a>


<hr>
<a href="<?php echo base_url(); ?>index.php/conductor/listapdf" target="blank">
  <button type="submit" class="btn btn-success btn-block">lista de conductores en pdf</button>
</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="tablaConductores" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Apellido 1</th>
            <th>Apellido 2</th>
            <th>Email</th>
            <th>Número de Móvil</th>
            <th>Foto</th>
            <th>Estado</th>
            <th>Creación</th>
            <th>Curriculum</th>
            <th>Modificar</th>
            <th>Eliminar</th>
            <th>Deshabilitar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $indice = 1;
        foreach ($conductores->result() as $row) {
        ?>
        <tr>
            <td><?php echo $indice; ?></td>
            <td><?php echo $row->nombre; ?></td>
            <td><?php echo $row->primerApellido; ?></td>
            <td><?php echo $row->segundoApellido; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->numeroMovil; ?></td>
            <td>
                <?php
                // Mostrar la foto del conductor si la tienes guardada en la base de datos
                if (!empty($row->foto)) {
                ?>
                <img src="<?php echo base_url('ruta/a/la/foto/' . $row->foto); ?>" alt="Foto del Conductor" width="50">
                <?php
                } else {
                    echo "No disponible";
                }
                ?>
            </td>
            <td>
                <?php
                // Mostrar el estado del conductor (habilitado o deshabilitado)
                if ($row->estado == 1) {
                    echo '<span class="badge badge-success">Habilitado</span>';
                } else {
                    echo '<span class="badge badge-danger">Deshabilitado</span>';
                }
                ?>
            </td>
            <td><?php echo formatearFecha($row->creado); ?></td>
            <td>
                <?php
                $curriculum = $row->curriculum;
                if ($curriculum == "") {
                ?>
                <img width="100" src="<?php echo base_url(); ?>uploads/conductores/pdficon.png">
                <?php
                } else {
                ?>
                <a href="<?php echo base_url(); ?>uploads/conductores/<?php echo $curriculum; ?>" target="_blank">
                    <img width="100" src="<?php echo base_url(); ?>uploads/conductores/default.png">
                </a>
                <?php
                }
                ?>
                <?php
                echo form_open_multipart('conductor/subircurriculum');
                ?>
                <input type="hidden" name="idConductor" value="<?php echo $row->idConductor; ?>">
                <button type="submit" class="btn btn-warning">Subir</button>
                <?php
                echo form_close();
                ?>
            </td>
            <td>
                <?php
                echo form_open('conductor/modificar')
                ?>
                <input type="hidden" name="idConductor" value="<?php echo $row->idConductor; ?>">
                <button type="submit" class="btn btn-primary">Modificar</button>
                <?php
                echo form_close()
                ?>
            </td>
            <td>
                <?php
                echo form_open('conductor/eliminardb')
                ?>
                <input type="hidden" name="idConductor" value="<?php echo $row->idConductor; ?>">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <?php
                echo form_close()
                ?>
            </td>
            <td>
                <?php
                echo form_open_multipart('conductor/deshabilitarbd');
                ?>
                <input type="hidden" name="idConductor" value="<?php echo $row->idConductor; ?>">
                <button type="submit" class="btn btn-warning">Deshabilitar</button>
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
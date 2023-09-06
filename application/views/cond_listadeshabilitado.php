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
                <h3 class="card-title"> Lista de Conductores deshabilitados </h3>
                <br>
                <a href="<?php echo base_url(); ?>index.php/conductor/indexlte">
                    <button type="button" class="btn btn-warning">Ver lista habilitados</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- /todo depues del body -->
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
            <th>Acciones</th>
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
                // Aquí puedes mostrar la foto del conductor si la tienes guardada en la base de datos
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
            <td>
                <?php
                // Acciones para habilitar o deshabilitar al conductor
                if ($row->estado == 1) {
                    echo form_open('conductor/deshabilitarbd');
                    echo '<input type="hidden" name="idConductor" value="' . $row->idConductor . '">';
                    echo '<button type="submit" class="btn btn-danger">Deshabilitar</button>';
                    echo form_close();
                } else {
                    echo form_open('conductor/habilitarbd');
                    echo '<input type="hidden" name="idConductor" value="' . $row->idConductor . '">';
                    echo '<button type="submit" class="btn btn-success">Habilitar</button>';
                    echo form_close();
                }
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


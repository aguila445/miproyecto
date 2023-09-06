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
                <h3 class="card-title"> Modificar Conductor </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <!-- /todo depues del body -->
              <?php
foreach ($infConductor->result() as $row) {
    echo form_open_multipart('conductor/modificardb');
?>
    <input type="hidden" name="idConductor" class="form-control" value="<?php echo $row->idConductor; ?>">
    <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="<?php echo $row->nombre; ?>">
    <input type="text" name="primerApellido" placeholder="Primer Apellido" class="form-control" value="<?php echo $row->primerApellido; ?>">
    <input type="text" name="segundoApellido" placeholder="Segundo Apellido" class="form-control" value="<?php echo $row->segundoApellido; ?>">
    <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $row->email; ?>">
    <input type="text" name="numeroMovil" placeholder="Número de Móvil" class="form-control" value="<?php echo $row->numeroMovil; ?>">
    
    <!-- Subir nueva foto del conductor -->
    <label for="foto">Nueva Foto del Conductor:</label>
    <input type="file" name="foto" class="form-control-file">

    <!-- Mostrar foto actual del conductor -->
    <label>Foto Actual:</label>
    <?php
    if (!empty($row->foto)) {
    ?>
    <img src="<?php echo base_url('ruta/a/la/foto/' . $row->foto); ?>" alt="Foto del Conductor" width="100">
    <?php
    } else {
        echo "No disponible";
    }
    ?>
    
    <button type="submit" class="btn btn-primary">Modificar</button>
<?php
    echo form_close();
}
?>
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de Coductores</h1>
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
                <h3 class="card-title"> Inscribir conductor </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    <?php
    echo form_open_multipart('conductor/agregardb')
    ?>
    <input type="text" name="nombre" placeholder="Nombre" class="form-control">
    <input type="text" name="primerApellido" placeholder="Primer Apellido" class="form-control">
    <input type="text" name="segundoApellido" placeholder="Segundo Apellido" class="form-control">
    <input type="text" name="email" placeholder="Email" class="form-control">
    <input type="text" name="numeroMovil" placeholder="Número de Móvil" class="form-control">

    <!-- Subir foto del conductor -->
    <label for="foto">Foto del Conductor:</label>
    <input type="file" name="foto" class="form-control-file">
    
    <button type="submit" class="btn btn-primary">AGREGAR</button>
    <?php
    echo form_close()
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
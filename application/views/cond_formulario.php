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
                <h3 class="card-title"> Crear Conductor </h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <?php
                    echo form_open_multipart('conductor/agregardb')
                ?>
                       <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>

    <label for="primerApellido">Primer Apellido:</label>
    <input type="text" name="primerApellido" id="primerApellido" required>
    <br>

    <label for="segundoApellido">Segundo Apellido:</label>
    <input type="text" name="segundoApellido" id="segundoApellido">
    <br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" required>
    <br>

    <label for="numeroMovil">Número de Móvil:</label>
    <input type="text" name="numeroMovil" id="numeroMovil" required>
    <br>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>
    <br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto">
    <br>

    <label for="latitud">Latitud:</label>
    <input type="text" name="latitud" id="latitud">
    <br>

    <label for="longitud">Longitud:</label>
    <input type="text" name="longitud" id="longitud">
    <br>

    <input type="submit" value="Registrar"
               
                echo form_close()
                ?>
                <?php    
                // </form>
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
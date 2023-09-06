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
                <h3 class="card-title"> Crear usuario </h3>
              </div>
              <!-- /.card-header -->
              
              
              <div class="card-body">
                <?php
                    echo form_open_multipart('conductor/agregardb')
                ?>
                      <!-- Formulario de registro de usuarios -->
<form action="<?php echo base_url('usuario/registrar'); ?>" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    <br>
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required>
    <br>
    <input type="submit" value="Registrar">
</form>
En este ejemplo, cuando un usuario complete el formulario de registro, se generará un nombre de usuario único y una contraseña segura. Luego, se insertarán estos datos en la base de datos y se enviarán al correo electrónico del usuario. Asegúrate de configurar la función de envío de correo electrónico en tu aplicación de CodeIgniter para que pueda enviar correos electrónicos correctamente.

Este es un ejemplo simplificado y deberás adaptarlo a tus necesidades específicas, incluyendo la configuración de la función de envío de correo electrónico y la estructura de tu base de datos. Además, ten en cuenta las prácticas de seguridad, como el almacenamiento seguro de contraseñas y la validación de datos de entrada.


               <?php
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
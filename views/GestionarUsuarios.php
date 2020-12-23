<!DOCTYPE html>
<html lang="es">
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_usuario, nombre, apellido,correo,contrasena FROM usuarios";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Usuarios</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../librerias/bootstrap/css/bootstrap.min.css">
  <!-- CSS personalizado -->
  <link rel="stylesheet" href="../assets/css/styles_modal.css">
  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="../librerias/datatables/datatables.min.css" />
  <!--datables estilo bootstrap 4 CSS-->
  <link rel="stylesheet" type="text/css" href="../librerias/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
  <!--Iconos-->
  <script src="https://kit.fontawesome.com/a715f33ce8.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <?php
  include 'header.php'
  ?>
  <div class="content">
    <div class="container">
      <div class="Title d-flex justify-content-between">
        <h3 class="Titulopag">Usuarios</h3>
        <button class="buttonCrud" id="btnNuevo" type="button" data-toggle="modal"> <i class="fas fa-plus-square" id="iagregar"></i> </button>
      </div>

      <table id="tablaUsuarios" class="table">

        <thead class="text-center">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Correo</th>
            <th scope="col">Contraseña</th>
            
            <th scope="col">Acción</th>
          </tr>
        </thead>

        <tbody class="text-center">
          <?php
          foreach ($data as $dat) {
          ?>
            <tr>
              <th scope="row"><?php echo $dat['id_usuario'] ?></th>
              <td><?php echo $dat['nombre'] ?></td>
              <td><?php echo $dat['apellido'] ?></td>
              <td><?php echo $dat['correo'] ?></td>
              <td><?php echo $dat['contrasena'] ?></td>
              <td>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
    <?php
    include_once 'footer.php';
    ?>
  </div>

  <!--Modal para CRUD-->
  <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 452px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUsuarios" action="#">
          <div class="modal-body">
            <div class="form-group formulario__grupo" id="grupo__nombre">
              <label for="nombre" class="col-form-label formulario__label ">Nombre</label>
              <div class="formulario__grupo">
                <input type="text" class=" formulario__input" name="nombre" id="nombre">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
              </div>
              <p class="formulario__input-error">El nombre tiene que ser de 1 a 16 dígitos solo puede contener numeros</p>

            </div>

            <div class="form-group formulario__grupo" id="grupo__apellido">
              <label for="apellido" class="col-form-label formulario__label">Apellido:</label>
              <div class="formulario__grupo">
              <input type="text" class=" formulario__input" name="apellido" id="apellido">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
              </div>
              <p class="formulario__input-error">El apellido no debe contener numeros</p>
            </div>
            <div class="form-group formulario__grupo" id="grupo__correo">
              <label for="correo" class="col-form-label formulario__label">Correo:</label>
              <div class="formulario__grupo">
              <input type="text" class=" formulario__input" name="correo" id="correo">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
              </div>
              <p class="formulario__input-error">El correo no coincide</p>
            </div>

            <div class="form-group formulario__grupo" id="grupo__contrasena">
              <label for="contrasena" class="col-form-label formulario__label">Contraseña:</label>
              <div class="formulario__grupo">
              <input type="password" class=" formulario__input" name="contrasena" id="contrasena">
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
              </div>
              <p class="formulario__input-error">La contraseña no es valida</p>
            </div>

            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>





  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
  <script src="../librerias/popper/popper.min.js"></script>
  <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>

  <!-- datatables JS -->
  <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>
  <script type="text/javascript" src="../assets/js/mainUsuarios.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  



</body>

</html>
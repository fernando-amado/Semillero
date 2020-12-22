<!DOCTYPE html>
<html lang="es">
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_indices, id_capitulo, numero_ind, nombre_ind, descripcion_ind FROM indices";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Índices</title>
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
</head>

<body>
  <?php
  include 'header.php'
  ?>
  <div class="content">
    <div class="container">
      <div class="Title d-flex justify-content-between">
        <h3 class="Titulopag">ÍNDICES</h3>
        <button class="buttonCrud" id="btnNuevo" type="button" data-toggle="modal"> <i class="fas fa-plus-square" id="iagregar"></i> </button>
      </div>

      <table id="tablaIndices" class="table">

        <thead class="text-center">
          <tr>
<<<<<<< HEAD
            <th scope="col">Id</th>
            <th scope="col">Capitulo</th>
            <th scope="col">Numero del Índice</th>
            <th scope="col">Nombre del Índice</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acción</th>
=======
            <th scope="row"><?php echo $dat['id_indices'] ?></th>
            <td><?php echo $dat['id_capitulo'] ?></td>
            <td><?php echo $dat['numero_ind'] ?></td>
            <td><?php echo $dat['nombre_ind'] ?></td>
            <td><?php echo $dat['descripcion_ind'] ?></td>
            
            <td></td>
>>>>>>> 7c97f03d552696a43a0a028abb25d10429c3c649
          </tr>
        </thead>

        <tbody class="text-center">
          <?php
          foreach ($data as $dat) {
          ?>
            <tr>
              <th scope="row"><?php echo $dat['id_indices'] ?></th>
              <td><?php echo $dat['id_capitulo'] ?></td>
              <td><?php echo $dat['numero_ind'] ?></td>
              <td><?php echo $dat['nombre_ind'] ?></td>
              <td><?php echo $dat['descripcion_ind'] ?></td>
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
        <form id="formIndices" action="#">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_capitulo" class="col-form-label">Capitulo:</label>
              <input type="text" class="form-control" id="id_capitulo">
            </div>
<<<<<<< HEAD
            <div class="form-group">
              <label for="numero_ind" class="col-form-label">Numero Indices:</label>
              <input type="number" class="form-control" id="numero_ind">
=======
        <form id="formIndices" action="#">    
            <div class="modal-body">
               
            

                <div class="form-group">
                <label for="id_capitulo" class="col-form-label">Capitulo:</label>
                <input type="text" class="form-control" id="id_capitulo">
                </div>  
                <div class="form-group">
                <label for="numero_ind" class="col-form-label">Numero Indices:</label>
                <input type="text" class="form-control" id="numero_ind">
                </div>  
                <div class="form-group">
                <label for="nombre_ind" class="col-form-label">Nombre Indices:</label>
                <input type="text" class="form-control" id="nombre_ind">
                </div>  
                <div class="form-group">
                <label for="descripcion_ind" class="col-form-label">Descripcion Indices:</label>
                <input type="text" class="form-control" id="descripcion_ind">
                </div>  
                                    
>>>>>>> 7c97f03d552696a43a0a028abb25d10429c3c649
            </div>
            <div class="form-group">
              <label for="nombre_ind" class="col-form-label">Nombre Indices:</label>
              <input type="text" class="form-control" id="nombre_ind">
            </div>
            <div class="form-group">
              <label for="descripcion_ind" class="col-form-label">Descripcion Indices:</label>
              <input type="text" class="form-control" id="descripcion_ind">
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
  <script type="text/javascript" src="../assets/js/maini.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
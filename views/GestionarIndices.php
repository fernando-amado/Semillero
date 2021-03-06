<!DOCTYPE html>
<html lang="es">
<?php
include_once "../bd/consultasIndices.php"
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      <div class="dtable">
        <table id="tablaIndices" class="table">

          <thead class="text-center">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Capitulo</th>
              <th scope="col">Numero del Índice</th>
              <th scope="col">Nombre del Índice</th>
              <th scope="col">Descripción</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>

          <tbody class="text-center">
            <?php
            foreach ($data as $dat) {
            ?>
              <tr>
                <th scope="row"><?php echo $dat['id_indices'] ?></th>

                <td><?php echo $dat['numero_cap'] ?></td>
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
        
              <div class="form-group formulario__grupo" id="grupo__Capitulo">
                <label for="id_capitulo" class="col-form-label formulario__label">Capitulo:</label>
                <div class="formulario__grupo">
                  <select class=" formulario__input" name="id_capitulo" id="id_capitulo">
                    <option value="">Selecciona un capitulo</option>
                    <?php
                    foreach ($data1 as $dat1) { ?>
                      <option value="<?php echo $dat1['id_capitulo']; ?>"><?php echo $dat1['numero_cap']." ".$dat1['nombre_cap'];?></option>
                    <?php } ?>
                  </select>
                  <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe seleccionar un capitulo</p>
              </div>

              <div class="form-group formulario__grupo" id="grupo__subIndice">
                <label for="indice_id" class="col-form-label formulario__label">Sub índices:</label>
                <div class="formulario__grupo">
                <select class=" formulario__input" name="indice_id" id="indice_id">
                  <option value="">Selecciona un sub índice o ÍNDICE</option>
                  <option value="0">ÍNDICE</option>
                  <?php
                  foreach ($data2 as $dat2) { ?>
                     <option value="<?php echo $dat2['id_indices']; ?>"><?php echo $dat2['numero_ind']." ".$dat2['nombre_ind'];?></option>
                  <?php } ?>
                </select>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe seleccionar un sub índice</p>
              </div>

              <div class="form-group formulario__grupo" id="grupo__numero_ind">
                <label for="numero_ind" class="col-form-label formulario__label">Numero índices:</label>
                <div class="formulario__grupo">
                <input type="text" class=" formulario__input" name="numero_ind" id="numero_ind">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El campo debe contener solamente numeros y puntos</p>
              </div>


              <div class="form-group formulario__grupo" id="grupo__nombre_ind">
                <label for="nombre_ind" class="col-form-label formulario__label">Nombre índices:</label>
                <div class="formulario__grupo">
                <input type="text"class=" formulario__input" name="nombre_ind" id="nombre_ind">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El nombre tiene que contener mas de un carácter</p>
              </div>

              <div class="form-group formulario__grupo" id="grupo__descripcion_ind">
                <label for="descripcion_ind" class="col-form-label formulario__label">Descripcion Indices:</label>
                <div class="formulario__grupo">
                <textarea rows="10" cols="50" class=" form-control formulario__input" name="descripcion_ind" id="descripcion_ind">Write something here</textarea>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El nombre tiene que contener mas de un carácter</p>
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
  <script type="text/javascript" src="../assets/js/maini.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
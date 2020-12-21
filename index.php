<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba semilleros</title>
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background-color: #000000;">
    <div class="container-fluid">
      <a href="index.php"><img src="assets/img/logo.png" height="70" width="150"></a>
      <div class="d-flex">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a href="views/login.php"><input class="btn btn-primary" type="button" value="Iniciar Sesión" id="BotonGestioCap"></a>
        </div>
      </div>
  </nav>
  <br>
  <center>
    <?php
    include_once 'bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    $consulta = "SELECT id_capitulo, numero_cap, nombre_cap FROM capitulos ORDER BY numero_cap ASC";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


    ?>
    <div class="content">
    <div class="card" style="width: 80rem;">
    <?php foreach($data as $dat) { 
           $consulta1 = "SELECT*FROM indices WHERE numero_ind LIKE '".$dat['numero_cap']."%'";
           $resultado1 = $conexion->prepare($consulta1);
           $resultado1->execute();
           $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
          ?>
   <details>
     <summary><?php echo 'Capítulo ', $dat['numero_cap']; ?> </summary>
     <h3 class="nombreCap"><?php echo $dat['nombre_cap']; ?></h3><br>
     <h4>Tabla de contenido del capítulo</h4>
     
     <div class="tablaContenido">
       <ul>
       <?php
       foreach($data1 as $dat1){
      ?>
         <li><a href="#<?php echo $dat1['nombre_ind']; ?>"><?php echo $dat1['nombre_ind']; ?>........<?php echo $dat1['numero_ind']; ?></a></li>
         <?php
       }
      ?>
        </ul>
     </div>
     
     <hr>
     <?php
       foreach($data1 as $dat1){
      ?>
      <h5 class="contenidoCap" id="<?php echo $dat1['nombre_ind']?>"><?php echo $dat1['numero_ind']; ?>) <?php echo $dat1['nombre_ind']; ?></h5>
      <p class="contenidoCap"><?php echo $dat1['descripcion_ind']; ?></p>
      <?php
       }
      ?>

   </details>
   <?php }
          ?>
  </center>

  </div>
  </div>

  <footer class="footer py-3 " style="background-color: #000000;">
    <div class="row">
      <div class="container col-md-1">
        <img src="assets/img/logo.png" height="70" width="150">
      </div>
      <div class="container col-md-7 pt-3">
        <span class="text-light">Copyright 2020. SINCOSOFT S.A.S. Todos los derechos reservados.
        </span>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>
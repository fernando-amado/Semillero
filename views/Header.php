<?php 
session_start();
$varsesion= $_SESSION['correo'];

if ($varsesion == null|| $varsesion='') {
  
  header("location:login.php");
  die();
}
?>
<nav class="navbar navbar-expand-lg" style="background-color: #000000;">
    <div class="container-fluid">
    <img src="../assets/img/logo.png" height="70" width="150">
     <div class="d-flex">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a href="inicio.php"><input class="btn btn-outline-primary" type="button" value="Visualizar" id="BotonGestioCap"></a>
        <a href="GestionarCapitulos.php"><input class="btn btn-primary" type="button" value="Gestionar Capítulos" id="BotonGestioCap"></a>
          <a href="GestionarIndices.php"><input class="btn btn-primary" type="button" value="Gestionar Índices" id="BotonGestioCap"></a>
          
        </div>
    </div>
  </nav>
  <br>
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
       
        
    <nav class="navegacion">
			<ul class="menu">
				<li><a class="sesionNombre" href="#"><?php echo "Hola,".$_SESSION['correo']; ?></a>
					<ul class="submenu">
          <li><a href="GestionarUsuarios.php">Gestionar usuarios</a></li>
						<li><a href="GestionarCapitulos.php">Gestionar capitulos </a></li>
						<li><a href="GestionarIndices.php">Gestionar índices</a></li>
						<li><a href="../bd/cerrarSesion.php">Cerrar sesión</a></li>
					</ul>
				</li>
				
			</ul>
		</nav>
  </nav>
  </div>
    </div>
  <br>
  <br>
  <br>
<?php
  session_start();
if (isset($_POST['boton'])) {
  if (empty($correo)) {
      echo "<p class='incorrecta'>Agrega el correo</p>";
    }
    if (empty($contrasena)) {
      echo "<p class='incorrecta'>Agrega la contraseña</p>";
    }elseif (isset($_POST['boton'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $_SESSION['correo']=$_POST['correo'];

    $conexion = mysqli_connect("localhost","root","","semilleroprueba");
    $consulta = "SELECT * FROM usuarios  WHERE correo ='$correo' AND contrasena='$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);

 if ($filas>0) {
   header("location:GestionarCapitulos.php");
 }else{
  echo "<p class='incorrecta'>Correo o contraseña incorrecta</p>";
 }
  mysqli_close($conexion); 
  }
}

?>
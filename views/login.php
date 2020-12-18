<?php
  if (isset($_POST['boton'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesiòn</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/stylesLogin.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body style="background-color: #ececec;">
<center>
<div class="contenedor">
<a href="../index.php"><img src="../assets/img/logolight.png" height="90" width="190"></a>
<h1>Iniciar Sesión </h1>
<div class="formulario">
<form action="#" method="POST">
    <input type="email" class="form-control" placeholder="Ingrese Correo electronico" name="correo"><br>
    <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="contrasena"><br>
    <input type="submit" class="form-control  btn btn-primary" value="Iniciar Sesión" name="boton">
    <a href="../index.php" class="volver">Regresar</a>
    <div class="incorrecta"><?php include('../bd/validarLogin.php');?></div>
    
</form>
</div>
</div>
<p class="mt-5 mb-3 text-muted">Copyright 2020. SINCOSOFT S.A.S. Todos los derechos reservados.</p>
</center>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
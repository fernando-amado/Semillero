<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

if($opcion==1){
     //alta
        $consulta = "INSERT INTO usuarios (nombre, apellido,correo,contrasena) VALUES('$nombre', '$apellido','$correo','$contrasena') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta = "SELECT id_usuario, nombre, apellido,correo,contrasena FROM usuarios ORDER BY id_usuarios DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        

        
    }
    elseif($opcion==2)    {
    //modificación
        $consulta = "UPDATE usuarios SET  nombre='$nombre',apellido='$apellido',correo='$correo',contrasena='$contrasena'    WHERE id_usuario='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_usuario, nombre, apellido,correo,contrasena FROM usuarios WHERE id_usuario='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    }       
    elseif($opcion==3){//eliminar
        $consulta = "DELETE FROM usuarios WHERE id_usuario='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
               
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>

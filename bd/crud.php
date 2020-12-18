<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$tituloCapitulo = (isset($_POST['tituloCapitulo'])) ? $_POST['tituloCapitulo'] : '';
$numeroCapitulo = (isset($_POST['numeroCapitulo'])) ? $_POST['numeroCapitulo'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

if($opcion==1){
     //alta
        $consulta = "INSERT INTO capitulos (numero_cap, nombre_cap) VALUES('$numeroCapitulo', '$tituloCapitulo') ";			
        $resultado = $conexion->prepare($consulta);

        $resultado->execute();
        if($resultado){
            echo'<script> alert("bien") </script>';
        }

         

        $consulta = "SELECT id_capitulo, numero_cap, nombre_cap FROM capitulos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        

        
    }
    elseif($opcion==2)    {
    //modificación
        $consulta = "UPDATE capitulos SET  numero_cap='$numeroCapitulo',nombre_cap='$tituloCapitulo'  WHERE id_capitulo='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_capitulo, numero_cap, nombre_cap FROM capitulos WHERE id_capitulo='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    }       
    elseif($opcion==3){//eliminar
        $consulta = "DELETE FROM capitulos WHERE id_capitulo='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
               
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombreCapitulo = (isset($_POST['nombreCapitulo'])) ? $_POST['nombreCapitulo'] : '';
$nombre_ind = (isset($_POST['nombre_ind'])) ? $_POST['nombre_ind'] : '';
$numero_ind = (isset($_POST['numero_ind'])) ? $_POST['numero_ind'] : '';
$descripcion_ind = (isset($_POST['descripcion_ind'])) ? $_POST['descripcion_ind'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_indices = (isset($_POST['id_indices'])) ? $_POST['id_indices'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO indices (nombreCapitulo, nombre_ind, numero_ind, descripcion_ind) VALUES('$nombreCapitulo', '$nombre_ind', '$numero_ind', '$descripcion_ind') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id_indices, nombreCapitulo, nombre_ind, numero_ind, descripcion_ind FROM indices ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE indices SET  nombreCapitulo='$nombreCapitulo',nombre_ind='$nombre_ind', numero_ind '$numero_ind'. descripcion_ind '$descripcion_ind'  WHERE id_indices='$id_indices' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_indices, nombreCapitulo, nombre_ind, numero_ind, descripcion_ind FROM indices WHERE id_indices='$id_indices' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM indices WHERE id_indices='$id_indices' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

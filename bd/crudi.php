<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id_capitulo = (isset($_POST['id_capitulo'])) ? $_POST['id_capitulo'] : '';
$numero_ind = (isset($_POST['numero_ind'])) ? $_POST['numero_ind'] : '';
$nombre_ind = (isset($_POST['nombre_ind'])) ? $_POST['nombre_ind'] : '';
$descripcion_ind = (isset($_POST['descripcion_ind'])) ? $_POST['descripcion_ind'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_indices = (isset($_POST['id_indices'])) ? $_POST['id_indices'] : '';

if($opcion==1){
     //alta
        $consulta = "INSERT INTO indices (id_capitulo, numero_ind, nombre_ind, descripcion_ind) VALUES('$id_capitulo', '$numero_ind', '$nombre_ind', '$descripcion_ind') ";			
        $resultado = $conexion->prepare($consulta);

        $resultado->execute();
        if($resultado){
            echo'<script> alert("Bien") </script>';
        }

         

        $consulta = "SELECT id_indices, id_capitulo, numero_ind, nombre_ind, descripcion_ind FROM indices ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        

        
    }
    elseif($opcion==2)    {
    //modificación
        $consulta = "UPDATE indices SET  id_capitulo='$id_capitulo',numero_ind='$numero_ind',nombre_ind='$nombre_ind',descripcion_ind='$descripcion_ind'  WHERE id_indices='$id_indices' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_indices, id_capitulo, numero_ind, nombre_ind, descripcion_ind FROM indices WHERE id_indices='$id_indices' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    }       
    elseif($opcion==3){//eliminar
        $consulta = "DELETE FROM indices WHERE id_indices='$id_indices' ";		
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

$id_capitulo = (isset($_POST['id_capitulo'])) ? $_POST['id_capitulo'] : '';
$nombre_ind = (isset($_POST['nombre_ind'])) ? $_POST['nombre_ind'] : '';
$numero_ind = (isset($_POST['numero_ind'])) ? $_POST['numero_ind'] : '';
$descripcion_ind = (isset($_POST['descripcion_ind'])) ? $_POST['descripcion_ind'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_indices = (isset($_POST['id_indices'])) ? $_POST['id_indices'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO indices (id_capitulo, nombre_ind, numero_ind, descripcion_ind) VALUES('$id_capitulo', '$nombre_ind', '$numero_ind', '$descripcion_ind') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id_indices, id_capitulo, nombre_ind, numero_ind, descripcion_ind FROM indices ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE indices SET  id_capitulo='$id_capitulo',nombre_ind='$nombre_ind', numero_ind '$numero_ind'. descripcion_ind '$descripcion_ind'  WHERE id_indices='$id_indices' ";		
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
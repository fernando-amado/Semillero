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
        $consulta = "SELECT id_capitulo, numero_cap, nombre_cap FROM capitulos ORDER BY id_capitulo DESC LIMIT 1";
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

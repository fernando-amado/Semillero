<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT i.id_indices, i.id_capitulo,c.numero_cap, i.numero_ind, i.nombre_ind, i.descripcion_ind FROM indices as i
INNER JOIN capitulos as c WHERE i.id_capitulo=c.id_capitulo;";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta1 = "SELECT * FROM capitulos";
$resultado1 = $conexion->prepare($consulta1);
$resultado1->execute();
$data1 = $resultado1->fetchAll(PDO::FETCH_ASSOC);
$consulta2 = "SELECT * FROM indices";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);  

?>


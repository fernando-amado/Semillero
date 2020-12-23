<?php
function get_cats_by_cat_id($id){
	$data= array();
	$con = mysqli_connect("localhost","root","","semillero");
	$query = $con->query("select i.* , c.numero_cap from indices i INNER JOIN capitulos c on i.id_capitulo=c.id_capitulo where indice_id = $id ");
	if(!empty($query) && $query->num_rows>0){
		while ($r=$query->fetch_array()) {
			$data[]=$r;
		}
	}
	return $data;
}

function categories($id)
{
$conn = mysqli_connect("localhost","root","","semillero");

$sql = "select i.* , c.numero_cap from indices i INNER JOIN capitulos c on i.id_capitulo=c.id_capitulo where indice_id = $id ";
$result = $conn->query($sql);

$categories = array();

while($row = $result->fetch_assoc())
{
$categories[] = array(
'id_indices' => $row['id_indices'],
'indice_id' => $row['indice_id'],
'numero_cap' => $row['numero_cap'],
'nombre_ind' => $row['nombre_ind'],
'children' => categories($row['id_indices']),
);
}
return $categories;
}



function add_levels( &$array, $level ){
    $i = 0;
    foreach ( $array as $key => &$value ) {
        $level_name = $level.++$i;
        $value[ 'level' ] = $level_name;

        if( array_key_exists( 'children', $value ) and is_array( $value[ 'children' ] )){
            add_levels( $value[ 'children' ], $level_name.'.' );
        }

    }
}
/**
 * Prints out array in required form
 * @param type $array
 */
function draw_ordered( $array ){
	echo "<ul>";
    foreach ( $array as $key => &$value ) {
        echo "<li ><a href='#$value[nombre_ind]'>$value[level]' $value[nombre_ind] " ." " ."</a></li>";
        if( array_key_exists( 'children', $value ) and is_array( $value[ 'children' ] )){
            draw_ordered( $value[ 'children' ] );
        }
	}
	echo "</ul>";
}




function list_tree_cat_id($id){
	$arrind=categories($id);
	echo "<ul>";
	foreach ( $arrind as $key => &$value ){
		add_levels( $arrind,$value["numero_cap"]."." );								
		echo "<li ><a href='#$value[nombre_ind]'> $value[nombre_ind]...........$value[level] " ." " ."</a></li>";

		if( array_key_exists( 'children', $value ) and is_array( $value[ 'children' ] )){						
				draw_ordered( $value[ 'children' ] );
			}
		}
		echo "</ul>";
	}
	

function list_tree_description($id){
	$subs = get_cats_by_cat_id($id);
	if(count($subs)>0){
		echo "<ul>";
		$contador = 1;
		foreach($subs as $s){
			echo "<h5 class='contenidoCap' id='$s[nombre_ind]'> $s[numero_ind] $s[nombre_ind] </h5>";
			echo "<p class='contenidoCap'> $s[descripcion_ind] " ." " ."</p>";
			list_tree_description($s["id_indices"]);
			$contador ++;
		}
		echo "</ul>";
	}
}







?>



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

function list_tree_cat_id($id){
	$subs = get_cats_by_cat_id($id);
	if(count($subs)>0){
		echo "<ul>";
		$contador = 1;
		$re="";
		foreach($subs as $s){					
			echo "<li ><a href='#$s[numero_ind]'> $re $s[nombre_ind] " ."......... " ." $re $s[numero_ind] </a></li>";			
			list_tree_cat_id($s["id_indices"]);
			$contador ++;

		}
		echo "</ul>";
	}
}

function list_tree_description($id){
	$subs = get_cats_by_cat_id($id);
	if(count($subs)>0){
		echo "<ul>";
		$contador = 1;
		foreach($subs as $s){
			echo "<h5 class='contenidoCap' id='$s[numero_ind]'> $s[numero_ind] $s[nombre_ind] </h5>";
			echo "<p class='contenidoCap'> $s[nombre_ind] " ." " ."</p>";
			list_tree_description($s["id_indices"]);
			$contador ++;
		}
		echo "</ul>";
	}
}
?>



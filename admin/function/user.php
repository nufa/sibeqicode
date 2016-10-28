<?php
function semua($query){

	global $dbc;

	if(mysqli_query($dbc, $query)){
		return true;
	}else {
		return false;
	}
}

function hapusData($id){

	$query = "DELETE FROM peserta WHERE id_peserta = $id ";

	return semua($query);
}

function hapusDataa($id){

	$query = "DELETE FROM baru_peserta WHERE id =$id";
	return semua($query);
}

function hasil_cari($cari){
	$query = "SELECT * FROM peserta WHERE nama LIKE '%$cari%'";
	return result($query);
}

function result($query){
	global $dbc;
	if($result = mysqli_query($dbc, $query) or die('gagal menampilkan data')){
		return $result;
	}
}

?>


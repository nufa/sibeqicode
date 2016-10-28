<?php

function tampilkan(){
	global $dbc;

	$query = "SELECT * FROM blog ORDER BY waktu ASC";
	return result($query);
}

function tampilkan_per_id($id){
	global $dbc;

	$query = "SELECT * FROM blog WHERE id_blog=$id";
	return result($query);
}

function tambah_data($judul, $konten, $waktu, $tanggal, $tempat, $kuota, $status, $url_pendaftaran){
	$judul = escape($judul);
	$konten = escape($konten);
	$query = "INSERT INTO blog (judul, isi, waktu, tanggal, tempat, kuota, status, url_pendaftaran) VALUES ('$judul', '$konten', '$waktu', '$tanggal', '$tempat', '$kuota', '$status', '$url_pendaftaran')";
	return run($query);
}

function edit_data($judul, $konten, $waktu, $tanggal, $tempat, $kuota, $status, $url_pendaftaran, $id){
	$judul = escape($judul);
	$konten = escape($konten);
	$query = "UPDATE blog SET judul='$judul', isi='$konten', waktu='$waktu', tanggal='$tanggal', tempat='$tempat', kuota='$kuota', status='$status', url_pendaftaran='$url_pendaftaran' WHERE id_blog=$id";
	return run($query);
}

function delete_data($id){
	$query = "DELETE FROM blog WHERE id_blog=$id";
	return run($query);
}

function run($query){
	global $dbc;

	if(mysqli_query($dbc, $query)) return true;
	else return false;

}

function result($query){
	global $dbc;
	if($result = mysqli_query($dbc, $query) or die('gagal menampilkan data')){
		return $result;
	}
}

function excerpt($string){
	$string = substr($string, 0 , 500);
	return $string . "...";
}

function excerpting($string){
	$string = substr($string, 0 , 50);
	return $string . "...";
}

function escape($data){
	global $dbc;
	return mysqli_real_escape_string($dbc, $data);
}

function TanggalIndo($waktu){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 	
 	date_default_timezone_set("Asia/Jakarta");
 	$jam   = date('g:i A');
	$tahun = substr($waktu, 0, 4);
	$bulan = substr($waktu, 5, 2);
	$tgl   = substr($waktu, 8, 2);
 
	$result = $jam . " on " . $tgl . " " . $BulanIndo[(int)$bulan-1] . " " . $tahun;		
	return($result);
}

function Tanggal($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 	
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

?>
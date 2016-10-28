<?php
require_once('function/blog.php');
require_once ('../control/db.php');



if(isset($_POST['submit'])){
	$judul   = $_POST['judul'];
	$konten  = $_POST['isi'];
	$waktu   = $_POST['waktu'];
	date_default_timezone_set('Asia/Jakarta');
	$waktu = date("Y-m-d H:i:s");
	$tanggal = $_POST['tanggal'];
	$tempat  = $_POST['tempat'];
	$kuota   = $_POST['kuota'];
	$status  = $_POST['status'];
	$url_pendaftaran = $_POST['url_pendaftaran'];

	if(trim($judul) == true && trim($konten) == true ){

		if(tambah_data($judul, $konten, $waktu, $tanggal, $tempat, $kuota, $status, $url_pendaftaran)){
			header('Location: blog.php');
		}else {
			echo 'ada masalah saat menambah data';
		}

	}else {
		echo 'judul dan konten wajib di isi';
	}
}

?>
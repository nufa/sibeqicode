<?php
ob_start();
require_once('function/user.php');
require_once ('../control/db.php');

if(isset($_GET['id_peserta'])){

	if(hapusData($_GET['id_peserta'])){
	header('Location: http://www.nufart.com/nufaweb/admin/datapeserta.php');
	}else{
		echo 'Hapus data gagal';
	}
}
?>
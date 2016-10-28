<?php
include "datasource.php";
require_once ('../control/db.php');

$id_peserta = @$_POST['id'];
$response= array(
	'success'=>false, 
	'message'=>'Tidak terdaftar'
);

if(isset($_POST['send'])){

	$row = searchMember($id_peserta);
	$sql = "UPDATE baru_peserta SET hadir='Hadir' WHERE id_qrcode = '$id_peserta'";
		if(mysqli_query($dbc, $sql)){
		    echo "";
		} else {
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	if(isset($row)) {
		$response = array(
			'success' => true,
			'message' => 'Absensi diterima',
			'detail'  => $row,
		);
	}
}

echo json_encode($response);
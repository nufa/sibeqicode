<?php

function searchMember($idQrcode) {

	global $dbc;
	$sql=mysqli_query($dbc,"SELECT * FROM baru_peserta where id_qrcode = '$idQrcode'"); //define sql statement
	$result = array();
 
	while($r = mysqli_fetch_array($sql)){
	$nama = $r['nama'];
	$tgl_daftar = $r['tgl_daftar'];
	$temp = $r['temp'];
	$hadir = $r['hadir'];
	$result = array(
        $idQrcode=>array('nama'=>$nama, 'tgl_daftar'=>$tgl_daftar),
         );
	
	return isset($result[$idQrcode]) ? $result[$idQrcode] : null;
	}
}
?>
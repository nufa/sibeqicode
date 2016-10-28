<?php

function semua($query){

	global $dbc;

	if(mysqli_query($dbc, $query)){
		return true;
	}else {
		return false;
	}
}

function escape($data){
	global $dbc;
	return mysqli_real_escape_string($dbc, $data);
}

function run($query){
	global $dbc;

	if(mysqli_query($dbc, $query)) return true;
	else return false;

}

function cek_data($username, $pass){
	$username = escape($username);
	$pass = escape($pass);

	$pass = md5($pass);

	$query = "SELECT * FROM admin WHERE username='$username' AND password='$pass'";
	global $dbc;

	if($result= mysqli_query($dbc, $query)){
		if(mysqli_num_rows($result) != 0) return true;
		else return false;
	}
}

function tampil(){
	global $dbc;

	$query  = "SELECT * FROM admin";
	$result = mysqli_query($dbc, $query) or die('query tampil gagal');

	return $result;
}

function tampilkan_per_id($id_admin){
	global $dbc;

	$query  = "SELECT * FROM admin WHERE id_admin = $id_admin";
	$result = mysqli_query($dbc, $query) or die('query tampil gagal');

	return $result;
}

function hapusData($id){

	$query = "DELETE FROM admin WHERE id_admin = $id ";

	return semua($query);
}

function editData($data, $id){

	$i = 0;
	foreach($data as $key=>$value){

		if(!is_int($value)){
			$nilaiArray[$i] = $key ." = '". $value ."'";
		}else{
			$nilaiArray[$i] = $key ." = ". $value;
		}
		$i++;
	}

	$nilai = implode(", ", $nilaiArray);

	$query = "UPDATE admin SET $nilai WHERE id_admin = $id";
	return semua($query);
}


function tambahData($nama, $email, $alamat, $uploadfile, $username, $password){
	$email = escape($email);
	$username = escape($username);
	$password = escape($password);
	$query = "INSERT INTO admin (nama, email, alamat, foto, username, password) VALUES ('$nama', '$email', '$alamat', '$uploadfile', '$username', '$password')";
	return semua($query);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aktivasi registrasi anda</title>


    
    
    
<style type="text/css">
body {
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}



 .success {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;
    
     width:450px;
     color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('img/success.png');
     
}



 .errormsgbox {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;

     width:450px;
    	color: #D8000C;
	background-color: #FFBABA;
	background-image: url('img/error.png');
     
}

</style>

</head>
<body>
<?php
include ('db.php');

if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
    $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
{
    $key = $_GET['key'];
}


if (isset($email) && isset($key))
{

    // Update databse untuk menset isi aktivasi ke "NULL" 

    $query_activate_account = "UPDATE peserta SET aktivasi=NULL WHERE(email ='$email' AND aktivasi='$key')LIMIT 1";

   
    $result_activate_account = mysqli_query($dbc, $query_activate_account) ;

   
    if (mysqli_affected_rows($dbc) == 1)//Jika proses update telah berhasil
    {
    echo '<div class="success">Data anda telah diaktivasi, silahkan tunggu konfirmasi kembali dari kami melalui email <a href="index.php">Kembali</a></div>';

    } else
    {
        echo '<div class="errormsgbox">'.$email .' , ' . $key .' Ooops akun anda tidak dapat diaktivasi. silahkan lakukan registrasi ulang atau hubungi administrator.</div>';

    }

    mysqli_close($dbc);

} else {
        echo '<div class="errormsgbox">Terjadi kesalahan.</div>';
}


?>
</body>
</html>
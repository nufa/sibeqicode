<?php
    session_start();
include ('control/db.php');
if (isset($_POST['formsubmitted'])) {
    $error = array();//buat array untuk menampung pesan eror  
    if (empty($_POST['nama'])) {//jika variabel nama kosong 
        $error[] = 'Silahkan masukkan nama ';//tambahkan ke array sebagai pesan error
    } else {
        $name = $_POST['nama'];//jika ada maka masukan isi dari variabel nama
    }

    if (empty($_POST['email'])) {
        $error[] = 'Silahkan masukkan Email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
           //regular expression untuk validasi email
            $Email = $_POST['email'];
        } else {
             $error[] = 'Email tidak valid';
        }
    }

    if (empty($_POST['telp'])) {
        $error[] = 'Silahkan masukkan no. telp ';
    } else {
        $telp = $_POST['telp'];
    }

    $alamat  = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];
    $jenis_kelamin = $_POST['gender'];
    $waktu   = $_POST['tgl_daftar'];
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date("Y-m-d H:i:s");
    // membuat kode aktivasi
    $activation = md5(uniqid(rand(), true));
    // membuat kode id qr
    $id_qr = uniqid();
    $folder = "assets/foto/";
    $foto = basename($_FILES['foto']['name']);
    $uploadfile = $folder.$foto;
    if(empty($_FILES['foto']['name'])){
         $error[] = 'Wajib masukkan foto ';
    } else {
        $foto= $_POST['foto'];
    }


    if (empty($error)) //kirim ke database jika tidak ada eror

    { 

        // memastikan apakah email sudah ada di database atau belum
        $query_verify_email = "SELECT * FROM peserta  WHERE email ='$Email'";
        $result_verify_email = mysqli_query($dbc, $query_verify_email);
        if (!$result_verify_email) {//if the Query Failed ,similar to if($result_verify_email==false)
            echo ' Terjadi eror pada database ';
        }

        if (mysqli_num_rows($result_verify_email) == 0) { // Jika tidak ada user lain yang teregistrasi telah menggunakan email ini
	
	if(!empty($_FILES['foto']['name'])){
	        $name_file = $_FILES['foto']['name'];
	        $type_file = $_FILES['foto']['type'];
	        $imgSize = $_FILES['foto']['size'];
		move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
	        if($type_file == "image/jpeg" || $type_file == "image/jpg" || $type_file == "image/png" || $type_file == "image/gif"){
	        $query_insert_user = "INSERT INTO `peserta` (`id_peserta`, `id_qrcode`, `nama`, `email`, `telp`, `alamat`, `keterangan`, `jenis_kelamin`, `tgl_daftar`, `aktivasi`,`foto`) VALUES ('', '$id_qr', '$name', '$Email', '$telp', '$alamat', '$keterangan', '$jenis_kelamin', '$waktu', '$activation','$name_file')";


            $result_insert_user = mysqli_query($dbc, $query_insert_user);
            if (!$result_insert_user) {
                echo 'Query Failed ';
            }
		

            if (mysqli_affected_rows($dbc) == 1) { //Jika data yang dimasukan ke database sukses


                // kirim email
                require_once('library/PHPMailerAutoload.php'); //menginclude librari phpmailer
 
		$mail             = new PHPMailer();
		$body             = 
		"<body MIME-Version: 1.0\nContent-Type: text/html; charset=utf-8 style='margin: 10px;'>
		<div style='width: auto; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
		<br>
		<strong>Hai, ".$name."</strong><br>
		<strong>Terima Kasih Telah Mendaftar</strong><br>
		<p>Tunggu konfirmasi dari kami, kami akan memeriksa kelengkapan data anda. Sebagai syarat untuk penerimaan peserta.</p><br>
		<b>- Admin Nufaweb</b><br>
		<br>
		</div>
		</body>";
		$body             = eregi_replace("[\]",'',$body);
		$mail->IsSMTP(); 	// menggunakan SMTP
		//$mail->SMTPDebug  = 1;   // mengaktifkan debug SMTP
 
		$mail->SMTPAuth   = true;   // mengaktifkan Autentifikasi SMTP
		$mail->Host 	  = '103.29.214.148'; // Gunakan Ip Shared Address Hosting Anda
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587;  // post gunakan port 25
		$mail->Username   = "admin@nufart.com"; // username email akun
		$mail->Password   = "nufaweb";        // password akun
 
		$mail->SetFrom('admin@nufart.com', 'Admin');
 
		$mail->Subject    = "Konfirmasi Pendaftaran";
		$mail->MsgHTML($body);
 
		$address = $Email; //email tujuan
		$mail->AddAddress($address, "Hello ");
		//$mail->AddAttachment("images/testafbb786b77e29854cf65c37069666c81.png");      // attachment
 
		if(!$mail->Send()) {
			echo "Oops, Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "";
		}

                


                // Jika registrasi berhasil dan email telah terkirim
                echo '<div class="success">Terimakasih telah melakukan registrasi di seminar ini, sebuah email telah dikirim ke '.$Email.' . <a href ="http://www.nufart.com/nufaweb/registrasi.php">Registrasi Kembali</a>/<a href="http://www.nufart.com/nufaweb/index.php">Home</a></div>';
		

            } else { // Jika terjadi kesalahan maka : 
                echo '<div class="errormsgbox">Tidak dapat melakukan registrasi karena kesalahan system</div>';
            }
            
            }else{
	            echo "invalid format image ".$type_file."";
	          }
	      }

        } else { // email addres telah terdaftar
            echo '<div class="errormsgbox" >email yang anda masukkan telah terdaftar
</div>';
        }

    } else {//Jika terdapat kesalahan pada array error maka tampilkan
        
        

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            
            echo '  <li>'.$values.'</li>';


       
        }
        echo '</ol></div>';

    }
  
    mysqli_close($dbc);//Tutup koneksi database

}



?>


<?php require_once "view/header.php";?>

    <div class="container">
        <h1 id="head-reg">Registrasi Peserta</h1>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="tgl_daftar"></input>
            <div class="form-group">
                <label class="control-label col-xs-3" for="Nama">Nama:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" id="Nama" name="nama" placeholder="Nama Anda">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="inputEmail">Email:</label>
                <div class="col-xs-9">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="telp">No. Telp:</label>
                <div class="col-xs-9">
                    <input type="tel" class="form-control" id="telp" name="telp" placeholder="Nomor Telepon / Handphone">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="foto">Foto:</label>
                <div class="col-xs-9">
                <input name="foto" id="foto" type="file" class="input-group">
                </div>
              </div>  
            <!--<div class="form-group">
                <label class="control-label col-xs-3">Tanggal Lahir</label>
                <div class="col-xs-3">
                    <select class="form-control">
                        <option>Tanggal</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <select class="form-control">
                        <option>Bulan</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <select class="form-control">
                        <option>Tahun</option>
                    </select>
                </div>
            </div>-->
            <div class="form-group">
                <label class="control-label col-xs-3" for="Alamat">Alamat:</label>
                <div class="col-xs-9">
                    <textarea rows="3" class="form-control" id="Alamat" name="alamat" placeholder="Masukan Alamat Lengkap"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Keterangan:</label>
                <div class="col-xs-9">
                    <select name="keterangan" class="form-control">
                    <option>Mahasiswa</option>
                    <option>Umum</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Jenis Kelamin:</label>
                <div class="col-xs-2">
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="L"> Laki-laki
                    </label>
                </div>
                <div class="col-xs-2">
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="P"> Perempuan
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="Setuju">  Saya Setuju dengan <a href="#" id="checkbox-href">Kebijakan dan Ketentuan</a> yang berlaku.
                    </label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <input type="hidden" name="formsubmitted" value="TRUE">
                    <input type="submit" class="btn btn-primary" value="Register">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </div>
        </form>
    </div>
    <footer>
            <img class="logo_footer" src="img/logobeqicode-footer.png" alt="Blogin" title="">
            <p class="rights">© 2016 NUFAWEB </p>
    </footer><!-- Footer End -->
    </div>
</body>
</html>                                     
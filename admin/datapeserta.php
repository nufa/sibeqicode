<?php
require_once ('view/header.php');
include ('../control/db.php');
require_once('function/user.php');
include "phpqrcode/qrlib.php";
?> 
       <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- Record Page & Print -->
          <?php 
            $per_hal=10;
            $sql=mysqli_query($dbc,"SELECT COUNT(*) from peserta");
            $jumlah_record=$sql->fetch_row();
            $jum=$jumlah_record [0];
            $halaman=ceil($jum / $per_hal);
            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $per_hal;
          ?>
          <div class="col-md-12">
            <table class="col-md-4">
              <tr>
                <td>Jumlah Record</td>    
                <td class="col-md-2"><?php echo $jum; ?></td>
              </tr>
              <tr>
                <td>Jumlah Halaman</td> 
                <td class="col-md-2"><?php echo $halaman; ?></td>
              </tr>
            </table>
      </div>
      <br>
          <!-- /.Record Page & Print -->
          <!-- search form -->
          <form action="" method="get">
            <div class="input-group col-md-5 col-md-offset-7">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
              <input type="text" class="form-control" placeholder="Cari data di sini .." aria-describedby="basic-addon1" name="search"> 
            </div>
          </form>
          <!-- /.search form -->
          <br>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
            
            
            <?php
            if(isset($_GET["pro"])){
            $id_qrcode=$_GET["pro"];
            $peserta=mysqli_query($dbc,"select * from peserta where id_qrcode='$id_qrcode'");
              $p=mysqli_fetch_array($peserta);
              $nama=$p["nama"];
              $email=$p["email"];
              $alamat=$p["alamat"];
              $tgl_daftar=$p["tgl_daftar"];
              $foto=$p['foto'];

              
              //generate qrcode
                  //set it to writable location, a place for temp generated PNG files
	    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	    
	    //html PNG location prefix
	    $PNG_WEB_DIR = 'temp/';
	
	    
	    //ofcourse we need rights to create temp dir
	    if (!file_exists($PNG_TEMP_DIR))
	        mkdir($PNG_TEMP_DIR);
	     
	    $errorCorrectionLevel = 'H';  
	    $matrixPointSize = 5;
	
	
	        $IMG='test'.md5($id_qrcode.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png'; 
	        $filename = $PNG_TEMP_DIR.$IMG;
	
	        QRcode::png($id_qrcode, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
	        $query = "INSERT INTO baru_peserta ( `id`, `id_qrcode`, `nama`, `email`,`foto`,`tgl_daftar`, `temp`) VALUES ( '', '$id_qrcode', '$nama','$email','$foto', '$tgl_daftar', '$IMG')";
	        $result_query = mysqli_query($dbc, $query);
	            if (!$result_query) {
	                echo 'Query  $IMG Failed ';
	            }
	            else{    
	                echo "";              
	            }
              
           echo"<h3>send mail to $email an:$nama</h3>";
           //mail
           	require_once('../library/PHPMailerAutoload.php'); //menginclude librari phpmailer
 
		$mail             = new PHPMailer();
		$body             = 
		"<body MIME-Version: 1.0\nContent-Type: text/html; charset=utf-8 style='margin: 10px;'>
		<div style='width: auto; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
		<br>
		<strong>Hay, ".$nama.".</strong><br>
		<p>Selamat, anda terpilih untuk mengikut seminar/workshop ini</p><br>
		<p>Dibawah ini adalah kode tiket anda, harap dibawa pada hari dan tanggal yang telah ditentukan.</p><br>
		<b>Kode : </b><img src='temp/".$IMG."' alt='' width='50' text-align='center'><br>
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
 
		$mail->Subject    = "Kode Tiket Seminar/Workshop";
		$mail->MsgHTML($body);
 
		$address = $email; //email tujuan
		$mail->AddAddress($address, "Hallo");
		$mail->AddAttachment("temp/".$IMG."");      // attachment
 
		if(!$mail->Send()) {
			echo "Oops, Mailer Error: " . $mail->ErrorInfo;
		} else {
			
		}
		
		

            
            
            }
            
            
            ?>
            
              <div class="table-responsive">
              <table class="table">
                <tr>
                  <th class="col-md-1">No</th>
                  <th class="col-md-1">Nama</th>
                  <th class="col-md-1">Email</th>
                  <th class="col-md-1">Telp</th>
                  <th class="col-md-1">Alamat</th>
                  <th class="col-md-1">Keterangan</th>
                  <th class="col-md-1">Jenis Kelamin</th>
                  <th class="col-md-1">Tanggal Daftar</th>
                  <th class="col-md-1">Foto</th>
                  <th class="col-md-3">Opsi</th>
                </tr>
                <?php 
                if(isset($_GET['search'])){
                  $cari = $_GET['search'];
                  $peserta = hasil_cari($cari);
                }else{
                  $peserta=mysqli_query($dbc,"select * from peserta limit $start, $per_hal");
                }
                $no=1;
                while($p=mysqli_fetch_array($peserta)){
                $loc = $p['foto'];
	           if (!empty($loc)) {
	              $poto = "src='../assets/foto/$loc'";
	            }
	            elseif (empty($loc)) {
	              $poto = "src='../assets/foto/default.png'";
	            }
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $p['nama']; ?></td>
                  <td><?php echo $p['email']; ?></td>
                  <td><?php echo $p['telp']; ?></td>
                  <td><?php echo $p['alamat']; ?></td>
                  <td><?php echo $p['keterangan']; ?></td>
                  <td><?php echo $p['jenis_kelamin']; ?></td>
                  <td><?php echo $p['tgl_daftar']; ?></td>
                  <td><img <?php echo $poto; ?> class="img-responsive" alt="Responsive image"></td>
                  <td>
                  <a onclick="if(confirm('Apakah anda yakin ingin memilih peserta ini ??')){ location.href='datapeserta.php?pro=<?php echo $p['id_qrcode']; ?>'}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id_peserta=<?= $p['id_peserta'];?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
                </tr>
              <?php 
              }
              ?>
                </table>
              </div>
              <nav>
                <ul class="pagination">
                  <?php 
                  for($x=1;$x<=$halaman;$x++){
                    ?>
                    <li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
                    <?php
                  }
                  ?>
                </ul>
              </nav>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      require_once "view/footer.php";
      ?>
<?php
require_once('function/blog.php');
require_once('../control/db.php');

$id    = $_GET['id_blog'];

if(isset($_GET['id_blog'])){
	$article = tampilkan_per_id($id);
	while($row = mysqli_fetch_assoc($article)){
	$judul   = $row['judul'];
	$konten  = $row['isi'];
	$waktu   = $row['waktu'];
	$tanggal = $row['tanggal'];
	$tempat  = $row['tempat'];
	$kuota   = $row['kuota'];
	$status  = $row['status'];
	$url_pendaftaran = $row['url_pendaftaran'];	}
}

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

		if(edit_data($judul, $konten, $waktu, $tanggal, $tempat, $kuota, $status, $url_pendaftaran, $id)){
			header('Location: blog.php');
		}else {
			echo 'ada masalah saat update data';
		}

	}else {
		echo 'judul dan konten wajib di isi';
	}
}

?>
<?php
require_once "view/header.php";
?>
<!-- Main content -->
<section class="content">
  <h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Artikel</h3>
  <a class="btn" href="blog.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
  <br>
  <div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
      <form action="" method="post">
      	<input type="hidden" name="waktu" value="<? echo $waktu; ?>">
              <div class="form-group">
                <label>Judul</label>
                <input name="judul" type="text" class="form-control" value="<? echo $judul; ?>">
              </div>
              <div class="form-group">
                <label>Isi</label>
                <textarea name="isi" rows="6" class="form-control"><? echo $konten; ?></textarea>
              </div>
              <input type="hidden" name="waktu"></input>
              <div class="form-group">
                <label>Tanggal</label>
                <input name="tanggal" type="date" class="form-control" value="<? echo $tanggal; ?>">
              </div>  
              <div class="form-group">
                <label>Tempat</label>
                <input name="tempat" type="text" class="form-control" value="<? echo $tempat; ?>">
              </div>  
              <div class="form-group">
                <label>Kuota</label>
                <input name="kuota" type="text" class="form-control" value="<? echo $kuota; ?>">
              </div>                                   
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                  <option>Tersedia</option>
                  <option>Tidak Tersedia</option>
                </select>
              </div>     
              <div class="form-group">
                <label>Url Pendaftaran</label>
                <input name="url_pendaftaran" type="text" class="form-control" value="<? echo $url_pendaftaran; ?>">
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name ="submit" class="btn btn-primary" value="Simpan">
              </div>
            </div>
          </form>
  </div>
  <div class="col-md-3"></div>
  </div>
    
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
require_once "view/footer.php";
?>
<?php ob_start(); ?>
<?php
require_once "view/header.php";
require_once ('function/admin.php');
require_once ('../control/db.php');
  

      
      $id    = $_GET['id_admin'];

      if(isset($_GET['id_admin'])){
        $data = tampilkan_per_id($id);
        while($row = mysqli_fetch_assoc($data)){
          $username_awal = $row['username'];
          $password_awal = $row['password'];
          $email_awal = $row['email'];
          $nama_awal = $row['nama_lengkap'];
          $alamat_awal = $row['alamat'];
          $foto_awal = $row['foto'];

        }
      }


  if(isset($_POST['submit'])){

      $nama  = $_POST['nama'];
      $email = $_POST['email'];
      $alamat  = $_POST['alamat'];
      $folder = "assets/foto/";
      $foto = @basename($_FILES['foto']['name']);
      $uploadfile = $folder.$foto;
      $username  = $_POST['username'];
      $password = md5($_POST['password']);

      //exception
      if(empty($_FILES['foto']['name'])){
        echo "";
      }
      elseif(!empty($_FILES['foto']['name'])){

        $name_file = $_FILES['foto']['name'];
        $type_file = $_FILES['foto']['type'];
        $imgSize = $_FILES['foto']['size'];

        if($type_file == "image/jpeg" || $type_file == "image/jpg" || $type_file == "image/png" || $type_file == "image/gif"){
          $query = mysqli_query($dbc,"UPDATE admin SET username='$username', password='$password' , email='$email', nama_lengkap='$nama', alamat='$alamat', foto='$name_file' where id_admin='$id'");
          if($query){
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
            header('Location: dataadmin.php');
          }else{
            echo "query tambah gagal";
          }
        }else{
            echo "invalid format image ".$type_file.", Back <a href='#'>input</a>";
          }
      }
    }else{
      unset($_POST['submit']);
    }
    ?>

<!-- Main content -->
<section class="content">
  <h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Admin</h3>
  <a class="btn" href="dataadmin.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
  <br>
  <div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
      <form action="" enctype="multipart/form-data" method="post">
        <div class="form-group">
          <input type="hidden" name="id_admin" value="<? echo $id; ?>">
          <label for="nama">Nama</label>
          <input type="text" name="nama" class="form-control" value="<?php echo $nama_awal; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control" value="<?php echo $email_awal; ?>">
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?php echo $alamat_awal; ?>">
        </div>
        <div class="form-group">
          <label for="foto">Foto</label>
          <input type="file" name="foto" value="<?php echo $foto_awal; ?>">
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" value="<?php echo $username_awal; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" name="password" class="form-control" value="<?php echo $password_awal; ?>">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
      </form>
  </div>
  <div class="col-md-3"></div>
  </div>
    
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
require_once "view/footer.php";
?>
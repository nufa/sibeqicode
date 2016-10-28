<?php
    require_once('function/admin.php');
    require_once ('../control/db.php');

    if(isset($_POST['submit'])){

      $nama  = $_POST['nama'];
      $email = $_POST['email'];
      $alamat  = $_POST['alamat'];
      $folder = "assets/foto/";
      $foto = basename($_FILES['foto']['name']);
      $uploadfile = $folder.$foto;
      $username  = $_POST['username'];
      $password = md5($_POST['password']);


      //exception
      if(empty($_FILES['foto']['name'])){
        echo "string";
      }
      elseif(!empty($_FILES['foto']['name'])){
        $name_file = $_FILES['foto']['name'];
        $type_file = $_FILES['foto']['type'];
        $imgSize = $_FILES['foto']['size'];

        if($type_file == "image/jpeg" || $type_file == "image/jpg" || $type_file == "image/png" || $type_file == "image/gif"){
          $query = mysqli_query($dbc,"INSERT INTO admin VALUES ('', '$username', '$password', '$email', '$nama', '$alamat', '$name_file')");
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
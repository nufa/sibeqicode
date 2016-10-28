<?php ob_start(); ?>
<?php
require_once "view/header.php";
require_once ('function/admin.php');
require_once ('../control/db.php');

$result = tampil();

?> 

  <!-- Main content -->
  <section class="content">
    <br/>
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
    <br/>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="table-responsive">
        <table class="table">
          <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-2">Nama</th>
            <th class="col-md-1">Email</th>
            <th class="col-md-1">Alamat</th>
            <th class="col-md-1">Foto</th>
            <th class="col-md-1">Username</th>
            <th class="col-md-1">Password</th>
          </tr>
          <?php
          $no=1; 
          while($p = mysqli_fetch_assoc($result)):
          $loc = $p['foto'];
           if (!empty($loc)) {
              $poto = "src='assets/foto/$loc'";
            }
            elseif (empty($loc)) {
              $poto = "src='assets/foto/default.png'";
            }
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $p['nama_lengkap']; ?></td>
            <td><?php echo $p['email']; ?></td>
            <td><?php echo $p['alamat']; ?></td>
            <td><img <?php echo $poto; ?> class="img-responsive" alt="Responsive image"></td>
            <td><?php echo $p['username']; ?></td>
            <td><?php echo $p['password']; ?></td>
            <td>
              <a href="editadmin.php?id_admin=<?= $p['id_admin']; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
              <?php
              if(isset($_GET['id_admin'])){

                if(hapusData($_GET['id_admin'])){
                  header('Location: http://nufart.com/nufaweb/admin/dataadmin.php');
                }else{
                  echo 'Hapus data gagal';
                }
              }
              ?>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='dataadmin.php?id_admin=<?= $p['id_admin'];?>' }" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </td>
          </tr>
          <?php endwhile; //endwhile ?>
          </table>
        </div>
      </div>
    </div>

    <!-- modal input -->
    <div id="myModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Data Admin</h4>
          </div>
          <div class="modal-body">
            <form action="tambahadmin.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <label>Nama</label>
                <input name="nama" type="text" class="form-control" placeholder="Nama  ..">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input name="email" type="text" class="form-control" placeholder="Email  ..">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" type="text" class="form-control" placeholder="Alamat ..">
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input name="foto" type="file" class="input-group">
              </div>  
              <div class="form-group">
                <label>Username</label>
                <input name="username" type="text" class="form-control" placeholder="Username ..">
              </div>  
              <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password ..">
              </div>                                  

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" name ="submit" class="btn btn-primary" value="Simpan">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
require_once "view/footer.php";
?>
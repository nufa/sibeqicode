<?php ob_start(); ?>
<?php
require_once "view/header.php";
require_once ('function/blog.php');
require_once ('../control/db.php');
?> 

  <!-- Main content -->
  <section class="content">
    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
    
    <?php 
    $per_hal=10;
    $sql=mysqli_query($dbc,"SELECT COUNT(*) from blog ");
    $jumlah_record=$sql->fetch_row();
    $jum=$jumlah_record [0];
    $halaman=ceil($jum / $per_hal);
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $per_hal;
    ?>
    <br/>
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
      <!-- search form -->
      <form action="" method="get">
        <div class="input-group col-md-5 col-md-offset-7">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
          <input type="text" class="form-control" placeholder="Cari data di sini .." aria-describedby="basic-addon1" name="search"> 
        </div>
      </form>
      <!-- /.search form -->
    <br/>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="table-responsive">
        <table class="table">
          <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-2">Judul</th>
            <th class="col-md-1">Isi</th>
            <th class="col-md-1">Waktu</th>
            <th class="col-md-1">Tempat</th>
            <th class="col-md-1">Kuota</th>
            <th class="col-md-1">Status</th>
            <th class="col-md-1">URL Pendaftaran</th>
            <th class="col-md-4">Opsi</th>
          </tr>
           <?php 
            if(isset($_GET['search'])){
              $cari = $_GET['search'];
              $blog = hasil_cari($cari);
            }else{
              $blog=mysqli_query($dbc,"select * from blog limit $start, $per_hal");
            }
            $no=1;
            while($p=mysqli_fetch_array($blog)){
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $p['judul']; ?></td>
            <td><?php echo excerpting($p['isi']); ?></td>
            <td><?php echo $p['tanggal']; ?></td>
            <td><?php echo $p['tempat']; ?></td>
            <td><?php echo $p['kuota']; ?></td>
            <td><?php echo $p['status']; ?></td>
            <td><?php echo $p['url_pendaftaran']; ?></td>
            <td>
              <a href="edit-artikel.php?id_blog=<?= $p['id_blog']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
              <?php
              if(isset($_GET['id_blog'])){

                if(delete_data($_GET['id_blog'])){
                  header('Location: blog.php');
                }else{
                  echo 'Hapus data gagal';
                }
              }
              ?>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='blog.php?id_blog=<?= $p['id_blog'];?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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

    <!-- modal input -->
    <div id="myModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Artikel</h4>
          </div>
          <div class="modal-body">
            <form action="tambah-artikel.php" method="post">
              <div class="form-group">
                <label>Judul</label>
                <input name="judul" type="text" class="form-control" placeholder="Judul  ..">
              </div>
              <div class="form-group">
                <label>Isi</label>
                <textarea name="isi" rows="3" type="text" class="form-control" placeholder="Isi  .."></textarea>
              </div>
              <input type="hidden" name="waktu"></input>
              <div class="form-group">
                <label>Tanggal</label>
                <input name="tanggal" type="date" class="form-control" placeholder="Tanggal ..">
              </div>  
              <div class="form-group">
                <label>Tempat</label>
                <input name="tempat" type="text" class="form-control" placeholder="Tempat ..">
              </div>  
              <div class="form-group">
                <label>Kuota</label>
                <input name="kuota" type="text" class="form-control" placeholder="Kuota ..">
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
                <input name="url_pendaftaran" type="text" class="form-control" placeholder="Url Pendaftaran ..">
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

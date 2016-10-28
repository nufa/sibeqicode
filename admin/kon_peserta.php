<?php
require_once ('view/header.php');
require_once ('../control/db.php');
require_once('function/user.php');
?> 
       <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- Record Page & Print -->
          <?php 
            $per_hal=10;
            $sql=mysqli_query($dbc,"SELECT COUNT(*) from baru_peserta");
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
              <div class="table-responsive">
              <table class="table">
                <tr>
                  <th class="col-md-1">No</th>
                  <th class="col-md-1">Nama</th>
                  <th class="col-md-1">Tanggal Daftar</th>
                  <th class="col-md-1">Email</th>
                  <th class="col-md-1">Foto</th>
                  <th class="col-md-1">Kode QR</th>
                  <th class="col-md-1">Keterangan</th>
                  <th class="col-md-3">Opsi</th>
                </tr>
                <?php 
                if(isset($_GET['search'])){
                  $cari = $_GET['search'];
                  $peserta = hasil_cari($cari);
                }else{
                  $peserta=mysqli_query($dbc,"select * from baru_peserta limit $start, $per_hal");
                }
                $no=1;
                while($p=mysqli_fetch_array($peserta)){
                $loc = $p['temp'];
	           if (!empty($loc)) {
	              $poto = "src='temp/$loc'";
	            }
	            elseif (empty($loc)) {
	              $poto = "src='temp/default.png'";
	            }
	        $fotoo= $p['foto'];
	           if (!empty($fotoo)) {
	              $foto = "src='../assets/foto/$fotoo'";
	            }
	            elseif (empty($fotoo)) {
	              $foto = "src='../assets/foto/default.png'";
	            }
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $p['nama']; ?></td>
                  <td><?php echo $p['tgl_daftar']; ?></td>
                  <td><?php echo $p['email']; ?></td>
                  <td><img <?php echo $foto; ?> class="img-responsive" alt="Responsive image"></td>
                  <td><img <?php echo $poto; ?> class="img-responsive" alt="Responsive image"></td>
                  <td><?php echo $p['hadir']; ?></td>
                  <td>
                  <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <?php
	              if(isset($_GET['id'])){
	
	                if(hapusDataa($_GET['id'])){
	                  header('Location: http://nufart.com/nufaweb/admin/kon_peserta.php');
	                }else{
	                  echo 'Hapus data gagal';
	                }
	              }
	          ?>
                  <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='kon_peserta.php?id=<?= $p['id'];?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
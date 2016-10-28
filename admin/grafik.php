<?php
include "view/header.php";
?>
	 <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> 
	<script type="text/javascript">
		$(function () {

			$(document).ready(function () {

				// Build the chart
				$('#container').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Jumlah Presentase Kehadiran'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						type: 'pie',
						name: 'Presentase',
						data: [
						['Tidak Hadir',   <?php
										$result = mysqli_query($dbc,"SELECT * FROM baru_peserta WHERE hadir like '%Tidak%'");
										$num_rows = mysqli_num_rows($result);
										echo $num_rows; ?>.0],
						['Hadir',   <?php
										$result = mysqli_query($dbc,"SELECT * FROM baru_peserta WHERE hadir like '%Hadir%'");
										$num_rows = mysqli_num_rows($result);
										echo $num_rows; ?>.0],
						]
					}]
				});
			});

		});
				</script>
				
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>  
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <div class="col-xs-12">
           <!-- Donut chart -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Chart Pie</h3>
                  <?php
                  $sql=mysqli_query($dbc,"SELECT COUNT(*) FROM baru_peserta");
	          $jumlah_record=$sql->fetch_row();
	          $jum=$jumlah_record [0];
	          $sql2=mysqli_query($dbc,"SELECT COUNT(*) FROM baru_peserta WHERE hadir like '%Hadir%'");
	          $jumlah2_record=$sql2->fetch_row();
	          $jum2=$jumlah2_record [0];
	          $sql3=mysqli_query($dbc,"SELECT COUNT(*) FROM baru_peserta WHERE hadir like '%Tidak%'");
	          $jumlah3_record=$sql3->fetch_row();
	          $jum3=$jumlah3_record [0];
                  ?>
                  <div class="col-md-12">
                  <table class="col-md-3">
	              <tr>
	                <td>Jumlah Peserta</td>    
	                <td class="col-md-2"><?php echo $jum; ?></td>
	              </tr>
	              <tr>
	                <td>Jumlah Peserta Hadir</td>    
	                <td class="col-md-2"><?php echo $jum2; ?></td>
	              </tr>
	              <tr>
	                <td>Jumlah Peserta Tidak Hadir</td>    
	                <td class="col-md-2"><?php echo $jum3; ?></td>
	              </tr>
	            </table>
	            </div>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div id="container" style="height: 300px;"></div>
                </div><!-- /.box-body-->
              </div><!-- /.box -->
            </div>
          </div>
           <div class="row">
            <div class="col-xs-12">
            	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Peserta Hadir</h3>
                </div><!-- /.box-header -->
                <?php 
            $per_hal=10;
            $sql=mysqli_query($dbc,"SELECT COUNT(*) FROM baru_peserta WHERE hadir like '%Hadir%'");
            $jumlah_record=$sql->fetch_row();
            $jum=$jumlah_record [0];
            $halaman=ceil($jum / $per_hal);
            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $per_hal;
          ?>
          <div class="col-md-12">
            <table class="col-md-4">
              <tr>
                <td>Jumlah Peserta Hadir</td>    
                <td class="col-md-2"><?php echo $jum; ?></td>
              </tr>
              <tr>
                <td>Jumlah Halaman</td> 
                <td class="col-md-2"><?php echo $halaman; ?></td>
              </tr>
            </table>
            <table class="col-md-4">
            <!-- search form -->
          <form action="" method="get">
            <div class="input-group col-md-5 col-md-offset-7">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
              <input type="text" class="form-control" placeholder="Cari data di sini .." aria-describedby="basic-addon1" name="search"> 
            </div>
          </form>
          </table>
          <!-- /.search form -->
      	  </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">Nama</th>
                        <th class="col-md-1">Tanggal Daftar</th>
                        <th class="col-md-1">Email</th>
                        <th class="col-md-1">Foto</th>
                        <th class="col-md-1">Kode QR</th>
                        <th class="col-md-1">Keterangan</th>
                      </tr>
                    </thead>
                    <?php 
	                if(isset($_GET['search'])){
	                  $cari = $_GET['search'];
	                  $peserta = hasil_cari($cari);
	                }else{
	                  $peserta=mysqli_query($dbc,"select * from baru_peserta WHERE hadir like '%Hadir%' limit $start, $per_hal");
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
                    <tbody>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $p['nama']; ?></td>
                        <td><?php echo $p['tgl_daftar']; ?></td>
                        <td><?php echo $p['email']; ?></td>
                        <td><img <?php echo $foto; ?> class="img-responsive" alt="Responsive image"></td>
                        <td><img <?php echo $poto; ?> class="img-responsive" alt="Responsive image"></td>
                        <td><?php echo $p['hadir']; ?></td>
                      </tr>
                      <?php 
	              }
	              ?>
                    </tbody>
                  </table>
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            </div>
            <div class="row">
            <div class="col-xs-12">
            	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Peserta Tidak Hadir</h3>
                </div><!-- /.box-header -->
                <?php 
	            $per_hal=10;
	            $sql=mysqli_query($dbc,"SELECT COUNT(*) FROM baru_peserta WHERE hadir like '%Tidak%'");
	            $jumlah_record=$sql->fetch_row();
	            $jum=$jumlah_record [0];
	            $halaman=ceil($jum / $per_hal);
	            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	            $start = ($page - 1) * $per_hal;
	          ?>
	          <div class="col-md-12">
	            <table class="col-md-4">
	              <tr>
	                <td>Jumlah Peserta Tidak Hadir</td>    
	                <td class="col-md-2"><?php echo $jum; ?></td>
	              </tr>
	              <tr>
	                <td>Jumlah Halaman</td> 
	                <td class="col-md-2"><?php echo $halaman; ?></td>
	              </tr>
	            </table>
	            <table class="col-md-4">
	            <!-- search form -->
	          <form action="" method="get">
	            <div class="input-group col-md-5 col-md-offset-7">
	              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
	              <input type="text" class="form-control" placeholder="Cari data di sini .." aria-describedby="basic-addon1" name="search"> 
	            </div>
	          </form>
	          </table>
	          <!-- /.search form -->
	      	  </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">Nama</th>
                        <th class="col-md-1">Tanggal Daftar</th>
                        <th class="col-md-1">Email</th>
                        <th class="col-md-1">Foto</th>
                        <th class="col-md-1">Kode QR</th>
                        <th class="col-md-1">Keterangan</th>
                      </tr>
                    </thead>
                    <?php 
	                if(isset($_GET['search'])){
	                  $cari = $_GET['search'];
	                  $peserta = hasil_cari($cari);
	                }else{
	                  $peserta=mysqli_query($dbc,"select * from baru_peserta WHERE hadir like '%Tidak%' limit $start, $per_hal");
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
                    <tbody>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $p['nama']; ?></td>
                        <td><?php echo $p['tgl_daftar']; ?></td>
                        <td><?php echo $p['email']; ?></td>
                        <td><img <?php echo $foto; ?> class="img-responsive" alt="Responsive image"></td>
                        <td><img <?php echo $poto; ?> class="img-responsive" alt="Responsive image"></td>
                        <td><?php echo $p['hadir']; ?></td>
                      </tr>
                      <?php 
	              }
	              ?>
                  </table>
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      require_once "view/footer.php";
      ?>
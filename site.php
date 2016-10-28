<?php
require_once "view/header.php";
require_once ('control/db.php');
require_once('admin/function/blog.php');
$error = '';
$id    = $_GET['id'];

if(isset($_GET['id'])){
	$article = tampilkan_per_id($id);
	while($row = mysqli_fetch_assoc($article)){
		$judul_awal = $row['judul'];
		$konten_awal = $row['isi'];
		$date = Tanggal($row['tanggal']);
		$waktu   = TanggalIndo($row['waktu']);
		$tempat = $row['tempat'];
		$kuota = $row['kuota'];
		$status = $row['status'];
		$url = $row['url_pendaftaran'];
	}
}

?>
		<div class="main2 wrapper">
			<div class="container">
				<div class="col-md-8">	
					<h1 style="font-size:30px"><?= $judul_awal; ?></h1>
					<br>
					<i class="waktu" style="margin-bottom:15px;"><?= $waktu; ?></i>
					<hr>
					<p class="lead"><?= $konten_awal; ?></p>
					<br>
					<table class="detail-view table table-striped table-condensed">
						<tbody>
							<tr>
								<th class="odd">Date</th>
								<td><?= $date; ?></td>
							</tr>

							<tr>
								<th class="even">Nama Seminar</th>
								<td><?= $judul_awal; ?></td>
							</tr>

							<tr>
								<th class="odd">Tempat</th>
								<td><?= $tempat; ?></td>
							</tr>

							<tr>
								<th class="even">Kuota</th>
								<td><?= $kuota; ?></td>
							</tr>

							<tr>
								<th>Status</th>
								<td><?= $status; ?></td>
							</tr>
							<tr>
								<th>URL Pendaftaran</th>
								<td><a style="color:#414FE8" href="<?= $url; ?>" target="_blank">Klik Disini</a></td>
							</tr>
							<tr>
								<th></th>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>

				<style type="text/css">
				#output{
					font-size: 40px;
					font-family: "Trebuchet MS", Arial, Helvetica,sans-serif;
					text-align: center;
					color: #212011;
					background-color: 
				}
				#datepicker{
					margin: auto;
					font-size: 18px;
				}
				</style>
				<script type="text/javascript">
				window.setTimeout("waktu()",1000);
				function waktu(){
					var tanggal = new Date();
					setTimeout("waktu()",1000);
					document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
				}
				</script>
				<script>
				  $(function(){
				    $( "#datepicker" ).datepicker();
				  });
				 </script>
				<div class="col-md-4">
					<div id="output"></div>
					<br>
					<div id="datepicker"></div>
				</div>
				
			</div>
		</div>

		<nav class="pagination">
			<a href="#" class="previous"><i></i>Previous</a>
			<a href="#" class="next">Next<i></i></a>
		</nav><!-- pagination End -->
	</section><!-- Main2 End -->

	<?php 
	require_once "view/footer.php";
	?>
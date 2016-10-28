<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sibeqicode | Sistem informasi seminar online</title>
	<meta charset="utf-8">
	<meta name="author" content="pixelhint.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../plugins/jQueryUI/jquery-ui.css">
	<!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jQueryUI/jquery-ui.js"></script>

</head>
<body>
	<div class="container-fluid">
		<header>
			<div class="wrapper">
				<a href="#"><img src="../img/logo.png" class="h_logo" alt="Blogin" title=""></a>
				<nav>
	                <ul class="main_nav">
	                    <li class="current"><a href="../index.php">Event</a></li>
	                    <li><a href="../about.php">About</a></li>
	                    <li><a href="../contact.php">Contact</a></li>
	                </ul>
	            </nav>
			</div>
		</header><!-- Header End -->
		<br>
		<br>
		<div class="wrapper">
			<div class="row">
				<div class="col-md-8">	
					<h1 style="font-size:30px">Workshop, Mengenal Lebih Jauh Framework PHP.</h1>
					<br>
					<p class="lead">Belakangan ini banyak sekali framework php yang semakin eksis di dunia web programming, maka dari banyak pegiat IT , web developer serta pemula yang berbondong - bondong untuk 	memperdalami tentang framework. Ada banyak sekali framework PHP yang secara opensource di kembangkan, dari sekian banyak framework tersebut ada beberapa yang eksistensi sangat tinggi di indonesia, antara lain Codeigniter, Yii Framework, Laravel.</p>
					<p class="lead">Tujuan dari seminar ini adalah mengenal lebih jauh tentang framework tersebut...</p>
					<br>
					<table class="detail-view table table-striped table-condensed">
						<tbody>
							<tr>
								<th class="odd">Date</th>
								<td>25-04-2016 to 25-04-2016</td>
							</tr>

							<tr>
								<th class="even">Nama Seminar</th>
								<td>Workshop, Mengenal Lebih Jauh Framework PHP</td>
							</tr>

							<tr>
								<th class="odd">Tempat</th>
								<td>Aula Lantai 4</td>
							</tr>

							<tr>
								<th class="even">Kuota</th>
								<td>20 orang</td>
							</tr>

							<tr>
								<th>Status</th>
								<td>Masih Tersedia</td>
							</tr>
							<tr>
								<th>URL Pendaftaran</th>
								<td><a style="color:#414FE8" href="http://localhost/nufaweb/registrasi.php">http://localhost/nufaweb/registrasi.php</a></td>
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

	<footer>
            <img class="logo_footer" src="../img/logobeqicode-footer.png" alt="Blogin" title="">
            <p class="rights">© 2016 NUFAWEB </p>
            <p class="rights">VERSION 1.0.0</p>
    </footer><!-- Footer End -->
	</div>	
</body>
</html>
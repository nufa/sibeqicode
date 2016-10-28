<?php
require_once "view/header.php";
require_once ('control/db.php');
require_once('admin/function/blog.php');

$article = tampilkan();

?>

<?php while($row = mysqli_fetch_assoc($article)):?>
	<section class="main2 wrapper">
		<section class="content">
			<article>
				<div class="post">
					<h1 class="title">
						<a href="site/site1.php">Workshop, Mengenal Lebih Jauh Framework PHP.</a>
					</h1>
					
					<p>Belakangan ini banyak sekali framework php yang semakin eksis di dunia web programming, maka dari banyak pegiat IT , web developer serta pemula yang berbondong - bondong untuk 	memperdalami tentang framework. Ada banyak sekali framework PHP yang secara opensource di kembangkan, dari sekian banyak framework tersebut ada beberapa yang eksistensi sangat tinggi di indonesia, antara lain Codeigniter, Yii Framework, Laraverl.</p>

					<p>Tujuan dari seminar ini adalah mengenal lebih jauh tentang framework tersebut...</p>

					<a class="read_more" href="site/site1.php">Continue Reading <i class="read_more_arrow"></i> </a>
				</div>
			</article>

			<article>
				<div class="post">
					<h1 class="title">
						<a href="site/site2.php">Seminar Nasional, Cloud Computing Solusi Penyimpanan Data Masa Depan.</a>
					</h1>
					
					<p>Bagaimana menyimpan data pribadi melalui cloud, disini kita akan membahas secara santai mengenai solusi tempat penyimpanan yang satu ini. Dimana cloud computing telah mengubah pandang seseorang mengenai tempat penyimpan yang lebih efektif dan menarik untuk digunakan. </p>

					<p>Dengan cloud computing semuanya akan menjadi lebih mudah...</p>

					<a class="read_more" href="site/site2.php">Continue Reading <i class="read_more_arrow"></i> </a>
				</div>
			</article>
			<article>
				<div class="post">
					<h1 class="title">
						<a href="site/site3.php">Membangun E-Commerce Dengan CMS LokoMedia.</a>
					</h1>
					
					<p>CMS kini makin lebih baik dan banyak diminati oleh perusahaan - perusahaan e-commerce skala menengah kebawah. Bukan karena apa - apa, membangun website e-commerce dengan cms akan lebih simpel dan mudah. Karena komponen - kompenen didalamnya yang semakin lengkap dan library nya mudah dimengerti oleh para pemula di bidang e-commerce. Bisa dibilang cms adalah solusi terbaik untuk membangun website toko online secara cepat dan mudah, mengenai pengeluaran biaya dalam membangunnya pun relatif murah. Disini kita akan mempelajari salah satu CMS tersebut, yaitu LokoMedia.</p>

					<p>Jadi, tertarikah kalian dengan CMS yang satu. Bergabunglah segera bersama dengan yang lainnya...</p>

					<a class="read_more" href="site/site3.php">Continue Reading <i class="read_more_arrow"></i> </a>
				</div>
			</article>
		</section><!-- Content End -->
		

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
		<aside class="sidebar">
			<section class="widget">
				<div id="output"></div>
				<br>
				<div id="datepicker">	
				</div>
			</section>

		</aside><!-- aside(sidebar) End -->

		<nav class="pagination">
			<a href="#" class="previous"><i></i>Previous</a>
			<a href="#" class="next">Next<i></i></a>
		</nav><!-- pagination End -->
	</section><!-- Main2 End -->

	<?php 
	require_once "view/footer.php";
	?>
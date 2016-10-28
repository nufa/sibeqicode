<?php
require_once "view/header.php";
require_once ('control/db.php');
require_once('admin/function/blog.php');

$article = tampilkan();

?>

	<section class="main2 wrapper">
		<content class="content">
		<?php while($row = mysqli_fetch_assoc($article)):?>
			<article>
				<div class="post">
					<h1 class="title">
						<a href="site.php?id=<?= $row['id_blog']; ?>"><?= $row['judul']; ?></a>
					</h1>
					
					<i class="waktu" style="margin-bottom:5px;"><?= TanggalIndo($row['waktu']); ?></i>
					<br>
					<br>
					<p><?= excerpt($row['isi']); ?></p>

					<a class="read_more" href="site.php?id=<?= $row['id_blog']; ?>">Continue Reading <i class="read_more_arrow"></i> </a>
				</div>
			</article>
			<?php endwhile;?>
			</content><!-- Content End -->
			
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
				<div class="widget">
					<div id="output"></div>
					<br>
					<div id="datepicker">	
					</div>
				</div>
	
			</aside><!-- aside(sidebar) End -->
		<nav class="pagination">
			<a href="#" class="previous"><i></i>Previous</a>
			<a href="#" class="next">Next<i></i></a>
		</nav><!-- pagination End -->
	</section><!-- Main2 End -->
	<?php 
	require_once "view/footer.php";
	?>
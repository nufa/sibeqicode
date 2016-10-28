<?php 
ob_start();
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

	<title>Login</title>
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css">
    <!-- jQuery JS -->
    <script src="../js/jquery.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<?php
session_start();
require_once ('../control/db.php');
require_once ('function/admin.php');

$error = '';

if(isset($_POST['submit'])){
	$username  = $_POST['username'];
	$pass = $_POST['password'];

	if(trim($username) == true && trim($pass) == true ){

		if(cek_data($username, $pass)){
			$_SESSION['username'] = $username;
			header('Location: beranda.php');
		}else {
			$error = 'ada masalah saat login';
		}

	}else {
		$error = 'username dan password harus di isi';
	}
}
?>
<body>
	<div class="wrapper">
	<div id="ribbon">
		<img src="assets/img/ribbon1.png">
	</div>
	<div id="login">

		<h2><span class="fa fa-lock"></span> Sign In</h2>
		
		<form action="index.php" method="POST">

			<fieldset>

				<p><label for="username">Username</label></p>
				<p><input type="username" id="username" name="username" value="username" onBlur="if(this.value=='')this.value='username'" onFocus="if(this.value=='username')this.value=''"></p> <!-- JS because of IE support; better: placeholder="username" -->

				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" name="password" value="password" onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''"></p> <!-- JS because of IE support; better: placeholder="password" -->
				<div id="error"><?= $error ?></div><br>
				<p><input type="submit" name="submit" value="Sign In"></p>

			</fieldset>

		</form>

	</div> <!-- end login -->
	</div>
	
	<!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

</body>
</html>
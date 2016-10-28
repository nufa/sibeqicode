<?php 
ob_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Absensi | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Costum CSS -->
    <link rel="stylesheet" type="text/css" href="../css/costum.css">
    
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript" src="./main.js"></script>
    <script type="text/javascript" src="./llqrcode.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
<?php 
session_start();
require_once ('../control/db.php');
  if(!isset($_SESSION['username'])){
      header('Location: http://nufart.com/nufaweb/admin/index.php');


    if(isset($_GET['username'])){
    $id_admin=$_GET['username'];
    }
    
    if(empty($_GET['username'])){
      $id_admin=$_SESSION['username'];
    }
  }

  $username=$_SESSION['username'];
  $query        = mysqli_query($dbc, "SELECT * FROM admin where username='$username'");
  while($p = mysqli_fetch_assoc($query)){
  $nama     = $p['nama_lengkap'];
  $foto = $p['foto'];
  $email = $p['email'];
  $alamat  = $p['alamat'];
?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="http://nufart.com/nufaweb/admin/beranda.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SBC</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIBEQICODE</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <?php 
                if (!empty($foto)) {
                  $poto = "src='assets/foto/$foto'";
                }
                elseif (empty($foto)) {
                  $poto = "src='assets/foto/default.png'";
                }
                ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img <?php echo $poto;?> class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $username;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img <?php echo $poto;?> class="img-circle" alt="User Image">
                    <p>
                      <?php echo $nama;?>
                      <small></small>
                    </p>
                  </li>
                  <?php } ?>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="beranda.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Data Peserta</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="datapeserta.php"><i class="fa fa-circle-o"></i>Data Calon Peserta</a></li>
                <li><a href="kon_peserta.php"><i class="fa fa-circle-o"></i>Data Konfirmasi Peserta</a></li>
              </ul>
            </li>
            <li class="">
              <a href="scanqr.php">
                <i class="fa fa-qrcode"></i> <span>Scan QR-Code</span> <i></i>
              </a>
            </li>
            <li class="">
              <a href="grafik.php">
                <i class="glyphicon glyphicon-stats"></i> <span>Report Data</span> <i></i>
              </a>
            </li>
            <li class="">
              <a href="blog.php">
                <i class="glyphicon glyphicon-list-alt"></i> <span>Blog</span> <i></i>
              </a>
            </li>
            <li class="">
              <a href="dataadmin.php">
                <i class="fa fa-users"></i> <span>Data Admin</span> <i></i>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
              
            <li class="active">Dashboard</li>
          </ol>
        </section>
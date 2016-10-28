<?php
require_once "view/header.php";
?>
       <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <button class="btn btn-info col-md-2"><a style="color:#fff !important" href="dataadmin.php"><span class="glyphicon glyphicon-wrench"></span> <strong>Data Admin</strong></a></button>
          <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Profile Admin</h2>
            </div>
          </div>
          <?php 
          if (!empty($foto)) {
            $poto = "src='assets/foto/$foto'";
          }
          elseif (empty($foto)) {
            $poto = "src='assets/foto/default.png'";
          }
          ?>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              <img <?php echo $poto; ?> alt="..." class="img-thumbnail">
            </div>
            <div class="col-md-6">
              <table class="table table-striped table-condensed">
                <tr class="odd">
                <th>Nama</th>
                <td>:</td>
                <td><?php echo $nama; ?></td>
                </tr>
                <tr class="even">
                <th>Email</th>
                <td>:</td>
                <td><?php echo $email; ?></td>
                </tr>
                <tr class="odd">
                <th>Alamat</th>
                <td>:</td>
                <td><?php echo $alamat; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      require_once "view/footer.php";
      ?>
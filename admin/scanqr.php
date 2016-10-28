<?php
require_once "view/header.php";
?> 
      <?php
      date_default_timezone_set('Asia/Jakarta');
      ?>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
              <div class="title">
                <h1>Event Registration, <?php echo sprintf("%s, %s", date('l'), date('d M Y')); ?></h1>
                <h2>Harap scan QR Code peserta pada kamera dibawah</h2>
              </div>
              <div style="display:none" id="result"></div>
              <div class="selector" id="webcamimg" onclick="setwebcam()" align="left" ></div>
                  <div class="selector" id="qrimg" onclick="setimg()" align="right" ></div>
                     <center id="mainbody"><div id="outdiv"></div></center>
                        <canvas id="qr-canvas" width="1000" height="800"></canvas>

            <script type="text/javascript">load();</script>
            <script src="./jquery-1.11.2.min.js"></script>

            <div id="member-profile">attempting to scan ...</div>

            <table class="scanned">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody id="absensi">
                </tbody>
            </table>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      require_once "view/footer.php";
      ?>
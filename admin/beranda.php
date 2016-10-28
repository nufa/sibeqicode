<?php
ob_start();
require_once "view/header.php";
?> 
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-sm-10">
            <h2>Selamat Datang di Aplikasi Absensi Menggunakan Webcam dan QR-Code </h2>
            </div
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail" style="text-align:justify;">
                <img src="assets/img/Qrtest.png" alt="...">
                <div class="caption">
                  <h3><center>QR- Code</center></h3>
                  <p>QRcode merupakan singkatan dari Quick Respone code, Pertama kali digunakan di industri otomotive untuk melakukan tracking terhadap komponen kendaraan. <br> Saat ini, penggunaan barcode dua dimensi ini sudah sangat luas, namun umumnya di pakai untuk mengkodekan alamat website, nomor contact, alamat email, nomor telepon atau sekedar teks biasa.  bentuk QR code bisa anda lihat seperti gambar disamping.</p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail" style="text-align:justify;">
                <img src="assets/img/webcam.png" alt="...">
                <div class="caption">
                  <h3>Webcam</h3>
                  <p>WebCam adalah sebuah periferal berupa kamera sebagai pengambil citra/gambar dan mikropon ( optional ) sebagai pengambil suara/audio yang dikendalikan oleh sebuah komputer atau oleh jaringan komputer.<br> Gambar yang diambil oleh WebCam ditampilkan ke layar monitor, karena dikendalikan oleh komputer maka ada interface atau port yang digunakan untuk menghubungkan WebCam dengan komputer atau jaringan.</p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail" style="text-align:justify;">
                <img src="assets/img/scanqr.png" alt="...">
                <div class="caption">
                  <h3>Absensi Seminar</h3>
                  <p>Ada apa dengan QR-Code dan Webcam ? Ya, disini penulis ingin mengimplementasikan cara penggunaan QR-Code dan Webcam sebagai sebuah alat untuk membantu proses berjalannya seminar. <br>Dimana QR-Code dan Webcam diterapkan ? QR-Code dan Webcam akan diterapkan pada sistem pendaftaran dan absensi seminar, untuk memudahkan bagi organisasi, komunitas serta mahasiswa dalam menjalankan acara tersebut</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row"></div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      require_once "view/footer.php";
      ?>
<?php

/*setting untuk koneksi ke database */
DEFINE('DATABASE_USER', 'nufart_fajri');
DEFINE('DATABASE_PASSWORD', 'nufaweb');
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_NAME', 'nufart_sibeqicode');
/*setting default time zone untuk dapat mengirimm email */
date_default_timezone_set('UTC');

//menetukan pengirim email
define('EMAIL', 'admin@nufart.com');

/*menentuk root url dari script php yang dibuat http://website.com atau http://website.com/Folder/ */
DEFINE('WEBSITE_URL', 'http://nufart.com/nufaweb');


// membuat koneksi ke database
$dbc = @mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD,
    DATABASE_NAME);

if (!$dbc) {
    trigger_error('koneksi tidak sukses: ' . mysqli_connect_error());
}

?>

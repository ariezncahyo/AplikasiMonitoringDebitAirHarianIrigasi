<?php
error_reporting(0);
session_start();
//if ($_SESSION['level']=="petugas") {
?>
<li <?php if($_GET['page']=="home") { echo 'id="current"'; } ?>><a href="index.php?page=home">Monitoring</a></li>
<li <?php if($_GET['page']=="laporan") { echo 'id="current"'; } ?>><a href="index.php?page=laporan">Laporan</a></li>
<li <?php if($_GET['page']=="debitharian") { echo 'id="current"'; } ?>><a href="index.php?page=debitharian">Input Debit Air</a></li>
<?php
//}
//else{
?>
<li <?php if($_GET['page']=="petugas") { echo 'id="current"'; } ?>><a href="index.php?page=petugas">Data Petugas</a></li>
<?php
//}
?>
<li <?php if($_GET['page']=="password") { echo 'id="current"'; } ?>><a href="index.php?page=password">Ubah Password</a></li>
<?php
error_reporting(0);
session_start();

include "../config/koneksi.php";
$page = $_GET['page'];

if($page=="home"){
if($_SESSION['level']=="petugas"){
echo'
<h2><span>Monitoring</span></h2>
<div class="module-body">
';
include "page/page_monitoring/monitoring.php";
echo'
</div>
';
}
else{
echo'
<h2><span>Data Petugas</span></h2>
<div class="module-body">
';
include "page/page_petugas/petugas.php";
echo'
</div>
';
}
}

if($page=="debitharian"){
echo'
<h2><span>Input Debit Air</span></h2>
<div class="module-body">
';
include "page/page_debitharian/debitharian.php";
echo'
</div>
';
}

if($page=="petugas"){
echo'
<h2><span>Data Petugas</span></h2>
<div class="module-body">
';
include "page/page_petugas/petugas.php";
echo'
</div>
';
}

if($page=="pengguna"){
echo'
<h2><span>Data Pengguna</span></h2>
<div class="module-body">
';
include "page/page_pengguna/pengguna.php";
echo'
</div>
';
}

if($page=="password"){
echo'
<h2><span>Ubah Password</span></h2>
<div class="module-body">
';
include "page/page_password/password.php";
echo'
</div>
';
}

if($page=="laporan"){
echo'
<h2><span>Laporan</span></h2>
<div class="module-body">
';
include "page/page_laporan/laporan.php";
echo'
</div>
';
}
?>
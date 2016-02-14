<?php
include "config/koneksi.php";

$username = $_POST['username'];
$pass     = md5($_POST['password']);

$login=mysql_query("SELECT * FROM pengguna WHERE username='$username' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

if ($ketemu > 0){
  session_start();

  $_SESSION['username']     = $r['username'];
  $_SESSION['namalengkap']  = $r['nama_lengkap'];
  $_SESSION['password']     = $r['password'];
  $_SESSION['level']     	= $r['level'];
  
  header('location:admin/index.php?page=home');
}
else{
  include "error-login.php";
}
?>
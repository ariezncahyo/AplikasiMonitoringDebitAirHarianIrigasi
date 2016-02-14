<?php
session_start();
include "../../../config/koneksi.php";

$page=$_GET['page'];
$act=$_GET['act'];

if ($page=='pengguna' AND $act=='hapus'){
  mysql_query("DELETE FROM pengguna WHERE username='$_GET[id]'");
  header('location:../../index.php?page='.$page.'&pesan=Data berhasil dihapus!');
}

elseif ($page=='pengguna' AND $act=='input'){
$username = $_POST['username'];
$pass = md5($_POST['password']);
$namalengkap = $_POST['nama_lengkap'];
$input=mysql_query("INSERT INTO pengguna
	                       VALUES(
                                '$username',
								'$pass',
								'$namalengkap','admin')");
	if($input){
	header('location:../../index.php?page='.$page.'&pesan=Data berhasil disimpan !');
	}
	else {
	header('location:../../index.php?page='.$page.'&pesan=Data sudah ada, tambah data gagal!');
	}
}

elseif ($page=='pengguna' AND $act=='update'){
$username = $_POST['username'];
$namalengkap = $_POST['nama_lengkap'];
    mysql_query("UPDATE pengguna SET 
                                  username  = '$username',
								  nama_lengkap	= '$namalengkap'
                           WHERE  username       = '$_POST[id]'");
 
  header('location:../../index.php?page='.$page.'&pesan=Data berhasil diubah!');
}

?>
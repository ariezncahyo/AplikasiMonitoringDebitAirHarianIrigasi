<?php
session_start();
include "../../../config/koneksi.php";

$page=$_GET['page'];
$act=$_GET['act'];

if ($page=='petugas' AND $act=='hapus'){
	$edit2=mysql_query("SELECT * FROM petugas WHERE kode_petugas='$_GET[id]'");
    $r2=mysql_fetch_array($edit2);
  mysql_query("DELETE FROM pengguna WHERE nama_lengkap='$r2[nama_petugas]'");
  mysql_query("DELETE FROM petugas WHERE kode_petugas='$_GET[id]'");
  header('location:../../index.php?page='.$page.'&pesan=Data berhasil dihapus!');
}

elseif ($page=='petugas' AND $act=='input'){
$kode_petugas = $_POST['kode_petugas'];
$namapetugas = $_POST['nama_petugas'];
$notelp = $_POST['no_telp'];
$alamat = $_POST['alamat'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$input=mysql_query("INSERT INTO petugas
	                       VALUES(
                                '$kode_petugas',
								'$namapetugas',
								'$notelp',
								'$alamat')");
$input2=mysql_query("INSERT INTO pengguna
	                       VALUES(
                                '$username',
								'$password',
								'$namapetugas',
								'petugas')");
	if($input){
	header('location:../../index.php?page='.$page.'&pesan=Data berhasil disimpan !');
	}
	else {
	header('location:../../index.php?page='.$page.'&pesan=Data sudah ada, tambah data gagal!');
	}
}

elseif ($page=='petugas' AND $act=='update'){
$kode_petugas = $_POST['kode_petugas'];
$namapetugas = $_POST['nama_petugas'];
$notelp = $_POST['no_telp'];
$alamat = $_POST['alamat'];
    mysql_query("UPDATE petugas SET 
                                  no_telp  = '$notelp',
								  nama_petugas	= '$namapetugas',
								  alamat	= '$alamat'
                           WHERE  kode_petugas       = '$_POST[id]'");
 
  header('location:../../index.php?page='.$page.'&pesan=Data berhasil diubah!');
}

?>
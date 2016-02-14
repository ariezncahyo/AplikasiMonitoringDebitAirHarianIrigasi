<?php
session_start();
include "../../../config/koneksi.php";

$page=$_GET['page'];
$act=$_GET['act'];

if ($page=='debitharian' AND $act=='hapus'){
  mysql_query("DELETE FROM debit_air WHERE id_debit='$_GET[id]'");
  header('location:../../index.php?page='.$page.'&pesan=Data berhasil dihapus!');
}

elseif ($page=='debitharian' AND $act=='input'){

$tgl = explode("-",$_POST['tanggal']);
$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
$kodepetugas = $_POST['kode_petugas'];
$debitmasuk = $_POST['debit_masuk'];
$debitsungai = $_POST['debit_sungai'];
$keterangan = $_POST['keterangan'];

$cek=mysql_query("SELECT *,DATE_FORMAT(tanggal,'%d-%m-%Y') AS tgl FROM debit_air WHERE tanggal='$tanggal'");
$rcek=mysql_num_rows($cek);

if($rcek>0){
header('location:../../index.php?page='.$page.'&pesan=Data dengan tanggal '.$_POST['tanggal'].' sudah ada! Data gagal disimpan!');
}else{

$input=mysql_query("INSERT INTO debit_air
	                       VALUES('',
                                '$kodepetugas',
								'$tanggal',
								'$debitmasuk',
								'$debitsungai',
								'$keterangan')");
	if($input){
	header('location:../../index.php?page='.$page.'&pesan=Data berhasil disimpan !');
	}
	else {
	header('location:../../index.php?page='.$page.'&pesan=Data sudah ada, tambah data gagal!');
	}
}
}

elseif ($page=='debitharian' AND $act=='update'){
$tgl = explode("-",$_POST['tanggal']);
$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
$kodepetugas = $_POST['kode_petugas'];
$debitmasuk = $_POST['debit_masuk'];
$debitsungai = $_POST['debit_sungai'];
$keterangan = $_POST['keterangan'];
    mysql_query("UPDATE debit_air SET 
                                  tanggal  = '$tanggal',
								  kode_petugas	= '$kodepetugas',
								  debit_masuk	= '$debitmasuk',
								  debit_sungai	= '$debitsungai',
								  keterangan	= '$keterangan'
                           WHERE  id_debit       = '$_POST[id]'");
 
  header('location:../../index.php?page='.$page.'&pesan=Data berhasil diubah!');
}

?>
<?php
error_reporting(0);
session_start();
include "../../../pdf/fpdf.php";
include "../../../config/koneksi.php";
require('../../../pdf/mc_table.php');

$page=$_GET[page];
$act=$_GET[act];

if ($page=='laporan' AND $act=='cetak'){

$pdf = new PDF_MC_Table();
$pdf->AddPage('L');
$pdf->setFont('Arial','B',16);
$pdf->setXY(50,10); $pdf->cell(30,6,'Laporan Data Debit Air');
$pdf->setXY(50,17); $pdf->cell(30,6,'Periode : '.$_POST[periode1].' s/d '.$_POST[periode2]);
$pdf->setXY(50,24); $pdf->cell(30,6,'BPSDA Ciwulan-Cilaki');
$pdf->Image('../../images/logo.jpg',15,2,0,0,'JPG');
$pdf->setFont('Arial','B',10);

$y_initial = 46;
$y_axis1 = 41;

$pdf->setFont('Arial','',10);

$pdf->setFillColor(233,233,233);
$pdf->setY($y_axis1);
$pdf->setX(10);

$pdf->SetWidths(array(8,30,30,50,50,35,35,35));
$pdf->Row(array("NO","TANGGAL","PETUGAS","DEBIT MASUK (cm)","DEBIT SUNGAI (lt/dtk)","KETERANGAN"));

$y = $y_initial + $row;
$tgl1 = explode("-",$_POST['periode1']);
$tgl2 = explode("-",$_POST['periode2']);
$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
$sql = mysql_query("select *,DATE_FORMAT(tanggal,'%d-%m-%Y') AS tgl from debit_air join petugas using(kode_petugas) WHERE tanggal between '$strtgl1' AND '$strtgl2' order by tanggal");
$no = 0;
$row = 6;
while ($data = mysql_fetch_array($sql))
{
	$no++;

	$pdf->Row(array($no,$data['tgl'],$data['nama_petugas'],$data['debit_masuk'],$data['debit_sungai'],$data['keterangan']));
	
	$y = $y + $row;
}
$pdf->setXY(10,$y); $pdf->cell(30,1,'Keterangan : Pengukuran dilakukan pada jam 07.00 setiap harinya');
$tgl = date('d-m-Y');
$pdf->setXY(150,$y); $pdf->cell(30,6,'Tasikmalaya, '.$tgl);
$pdf->setXY(150,$y); $pdf->cell(30,16,'Petugas');
$pdf->setXY(150,$y); $pdf->cell(30,36,'('.$_SESSION['namalengkap'].')');
$pdf->Output();

header('location:../../index.php?page='.$page);
}
 
?>
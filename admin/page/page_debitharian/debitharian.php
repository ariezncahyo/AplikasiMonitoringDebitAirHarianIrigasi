<html>
<head>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
<script type="text/javascript">
$(function() {
		$( "#tanggal" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate : '0',
				dateFormat: "dd-mm-yy"
			});
		});
function ValidateAlpha()
{
var keyCode = window.event.keyCode;
	if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
	{
		window.event.returnValue = false;
	}
}
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
function hitung() {
        var dm = document.getElementById("debit_masuk").value-0;
		var hsl = Math.round(dm * Math.sqrt(dm) * 2 * 1.71);
		if (isNaN(hsl))
			 document.getElementById("debit_sungai").value = 0;
		else
		{
		if(hsl < 0){
			document.getElementById("debit_sungai").value = 0;
		}else{
			document.getElementById("debit_sungai").value = hsl;
			if(dm <= 80){
				document.getElementById("keterangan").value = "Banjir kecil";
			}
			if(dm > 80 && dm <= 200){
				document.getElementById("keterangan").value = "Banjir biasa";
			}
			if(dm > 200){
				document.getElementById("keterangan").value = "Banjir besar";
			}
		}
		}
    }
function Blank_TextField_Validator()
{
if (text_form.debit_masuk.value == "")
{
   alert("Isi dulu debit masuk !");
   text_form.debit_masuk.focus();
   return (false);
}
if (text_form.tanggal.value == "")
{
   alert("Isi dulu tanggal !");
   text_form.tanggal.focus();
   return (false);
}
return (true);
}
</script>
</head>
<body>
<?php
include "../config/fungsi_alert.php";
$aksi="page/page_debitharian/aksi_debitharian.php";

switch($_GET[act]){
  default:
  $offset=$_GET['offset'];
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
$tampil=mysql_query("SELECT * FROM debit_air");
$baris=mysql_num_rows($tampil);
echo '
<p>
	<a href="?page=debitharian&act=tambahdebitharian" class="button">
	   <span>Tambah Data Debit Air <img src="images/plus-small.gif" width="12" height="9" alt="Tambah Data Debit Air" /></span>
	</a>
</p>
';

$pesan = $_GET['pesan'];
if(isset($pesan)){
	echo '<p><br>
		<div>
			<span class="notification n-information">'.$pesan.'</span>
		</div></p>
	';
}
	
if($baris>0){


echo      "
<p>
<table id='myTable' class='tablesorter'>
<thead>
          <tr>
		  <th>No</th>
		  <th>Tanggal</th>
		  <th>Petugas</th>
		  <th>Debit Masuk (cm)</th>
		  <th>Debit Sungai (lt/dtk)</th>
		  <th>Keterangan</th>
		  <th align=center>Aksi</th>
		  </tr></thead><tbody>"; 
$hasil = mysql_query("SELECT *,DATE_FORMAT(tanggal,'%d-%m-%Y') AS tgl FROM debit_air join petugas using(kode_petugas) ORDER BY tanggal desc limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;

while($r = mysql_fetch_array($hasil))
{

	echo "<tr>
		<td align=center>$no</td>
		<td>".$r['tgl']."</td>
		<td>".$r['nama_petugas']."</td>
		<td>".$r['debit_masuk']."</td>
		<td>".$r['debit_sungai']."</td>
		<td>".$r['keterangan']."</td>
		<td align='center'>
		<a href=?page=debitharian&act=editdebitharian&id=$r[id_debit]><img src='images/pencil.gif' title='Ubah' alt='Ubah' width='16' height='16'></a> &nbsp;
		<a href=\"JavaScript: confirmIt('Anda yakin akan menghapus data ini ?','$aksi?page=debitharian&act=hapus&id=$r[id_debit]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/minus-circle.gif' title='Hapus' alt='Hapus' width='16' height='16'></a>
		</td>
		</tr>";
$no++;
}
echo "</tbody></table></p>";

echo "<p><div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=debitharian&offset=$prevoffset>Back</a></span>";
	}
	else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=$PHP_SELF?page=debitharian&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

	//cek halaman akhir
	if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=$PHP_SELF?page=debitharian&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div></p>";

   }else{
	echo '<br><br><span class="notification n-information">Data Kosong.</span>';
	}
    break;

case "tambahdebitharian":
$tgl = date('d-m-Y');
    echo "<p>
		
		<form method=POST action='$aksi?page=debitharian&act=input' name=text_form onsubmit='return Blank_TextField_Validator()'>

          <table>
          <tr><td width=200>Tanggal</td> <td> : <input type=text name='tanggal' id='tanggal' class='input-short' value='$tgl'></td></tr>
		  <tr><td>Petugas</td> <td> : <input type=text name='petugas' id='petugas' class='input-short' readonly value='$_SESSION[namalengkap]'></td></tr>
		  ";
		$hasil4 = mysql_query("SELECT * FROM petugas where nama_petugas='$_SESSION[namalengkap]'");
		$r4=mysql_fetch_array($hasil4);
		echo	"
		<input type=hidden name=kode_petugas value='$r4[kode_petugas]'>
		  <tr><td>Debit Masuk (cm)</td> <td> : <input type=text name='debit_masuk' id='debit_masuk' class='input-short' onkeypress=\"return isNumberKey(event)\" onkeyup=\"hitung()\" autocomplete=off maxlength=3></td></tr>
		  <tr><td>Debit Sungai (lt/dtk)</td> <td> : <input type=text name='debit_sungai' id='debit_sungai' class='input-short' onkeypress=\"return isNumberKey(event)\" readonly></td></tr>
		  <tr><td>Keterangan</td> <td> : <input type=text name='keterangan' id='keterangan' class='input-short' readonly ></td></tr>
		  <tr><td></td> <td> </td></tr>
		  <tr><td colspan=2>*Pengukuran dilakukan pada jam 07.00 setiap harinya </td></tr>
			";
          echo "<tr><td colspan=2>
		  <fieldset>
		  <input class='submit-green' type=submit value='Simpan'>
		  <input type='button' class='submit-gray' value='Batal' onclick='self.history.back();' />
		  </fieldset>
				</td></tr>
          </table>
		  </form>
		  </p>";
     break;
    
   case "editdebitharian":
    $edit=mysql_query("SELECT *,DATE_FORMAT(tanggal,'%d-%m-%Y') AS tgl FROM debit_air WHERE id_debit='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<p>
          <form method=POST action=$aksi?page=debitharian&act=update name=text_form onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[id_debit]'>
          <table>
           <tr><td width=200>Tanggal</td> <td> : <input type=text name='tanggal' id='tanggal' class='input-short' value='$r[tgl]'></td></tr>
		  ";
		$hasil4 = mysql_query("SELECT * FROM petugas where kode_petugas='$r[kode_petugas]'");
		$r4=mysql_fetch_array($hasil4);
		echo	"
		<tr><td>Petugas</td> <td> : <input type=text name='petugas' id='petugas' class='input-short' readonly value='$r4[nama_petugas]'></td></tr>
		<input type=hidden name=kode_petugas value='$r[kode_petugas]'>
		  <tr><td>Debit Masuk</td> <td> : <input type=text name='debit_masuk' id='debit_masuk' class='input-short' value='$r[debit_masuk]' onkeypress=\"return isNumberKey(event)\" onkeyup=\"hitung()\" autocomplete=off maxlength=3></td></tr>
		  <tr><td>Debit Sungai</td> <td> : <input type=text name='debit_sungai' id='debit_sungai' class='input-short' value='$r[debit_sungai]' onkeypress=\"return isNumberKey(event)\" readonly></td></tr>
		  <tr><td>Keterangan</td> <td> : <input type=text name='keterangan' id='keterangan' class='input-short' value='$r[keterangan]' readonly ></td></tr>
			";
	echo "<tr><td colspan=2>
	<fieldset>
		  <input class='submit-green' type=submit value='Ubah'>
		  <input type='button' class='submit-gray' value='Batal' onclick='self.history.back();' />
		  </fieldset>
	</td></tr>
          </table></form></p>";
    break;

}
?>
</body>
</html>
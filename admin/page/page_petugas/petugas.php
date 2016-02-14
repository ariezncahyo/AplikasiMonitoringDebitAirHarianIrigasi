<html>
<head>
<script type="text/javascript">
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
function Blank_TextField_Validator()
{
if (text_form.kode_petugas.value == "")
{
   alert("Isi dulu kode petugas !");
   text_form.kode_petugas.focus();
   return (false);
}
if (text_form.nama_petugas.value == "")
{
   alert("Isi dulu nama petugas !");
   text_form.nama_petugas.focus();
   return (false);
}
return (true);
}
</script>
</head>
<body>
<?php
include "../config/fungsi_alert.php";
$aksi="page/page_petugas/aksi_petugas.php";

switch($_GET[act]){
  default:
  $offset=$_GET['offset'];
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
$tampil=mysql_query("SELECT * FROM petugas ORDER BY kode_petugas");
$baris=mysql_num_rows($tampil);
echo '
<p>
	<a href="?page=petugas&act=tambahpetugas" class="button">
	   <span>Tambah Data Petugas <img src="images/plus-small.gif" width="12" height="9" alt="Tambah Data Petugas" /></span>
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
		  <th>Kode Petugas</th>
		  <th>Nama Petugas</th>
		  <th>No Telepon</th>
		  <th>Alamat</th>
		  <th align=center>Aksi</th>
		  </tr></thead><tbody>"; 
$hasil = mysql_query("SELECT * FROM petugas ORDER BY kode_petugas limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
$warnaGenap = "#B2CCFF";   // warna tua
$warnaGanjil = "#E0EBFF";  // warna muda
$counter = 1;

while($r = mysql_fetch_array($hasil))
{
	if ($counter % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
	echo "<tr bgcolor='".$warna."'>
		<td align=center>$no</td>
		<td>".$r['kode_petugas']."</td>
		<td>".$r['nama_petugas']."</td>
		<td>".$r['no_telp']."</td>
		<td>".$r['alamat']."</td>
		<td align='center'>
		<a href=?page=petugas&act=editpetugas&id=$r[kode_petugas]><img src='images/pencil.gif' title='Ubah' alt='Ubah' width='16' height='16'></a> &nbsp;
		<a href=\"JavaScript: confirmIt('Anda yakin akan menghapus data ini ?','$aksi?page=petugas&act=hapus&id=$r[kode_petugas]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/minus-circle.gif' title='Hapus' alt='Hapus' width='16' height='16'></a>
		</td>
		</tr>";
$no++;
$counter++;
}
echo "</tbody></table></p>";

echo "<p><div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=petugas&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=petugas&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=petugas&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div></p>";

   }else{
	echo '<br><br><span class="notification n-information">Data Kosong.</span>';
	}
    break;

case "tambahpetugas":
$ceknomor=mysql_fetch_array(mysql_query("SELECT kode_petugas FROM petugas ORDER BY kode_petugas DESC LIMIT 1"));
	$cekQ=$ceknomor['kode_petugas'];
	$awalQ=substr($cekQ,2-4);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='PG00'; }
	elseif($jnim==2)
	{ $no='PG0'; }
	elseif($jnim==3)
	{ $no='PG'; }
	$idpr=$no.$next;
    echo "<p>
		
		<form method=POST action='$aksi?page=petugas&act=input' name=text_form onsubmit='return Blank_TextField_Validator()'>

          <table>
          <tr><td width=200>Kode Petugas</td> <td> : <input type=text name='kode_petugas' id='kode_petugas' readonly value='$idpr' class='input-short'></td></tr>
          <tr><td>Nama Petugas</td> <td> : <input type=text name='nama_petugas' id='nama_petugas' class='input-short' ></td></tr>
		  <tr><td>No Telepon</td> <td> : <input type=text name='no_telp' id='no_telp' class='input-short' onkeypress=\"return isNumberKey(event)\" maxlength=15></td></tr>
		  <tr><td>Alamat</td> <td> : <input type=text name='alamat' id='alamat' class='input-short' ></td></tr>
		  <tr><td>Informasi Login</td> <td> </td></tr>
		  <tr><td>Username</td> <td> : <input type=text name='username' id='username' class='input-short' ></td></tr>
		  <tr><td>Password</td> <td> : <input type=password name='password' id='password' class='input-short' ></td></tr>
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
    
   case "editpetugas":
    $edit=mysql_query("SELECT * FROM petugas WHERE kode_petugas='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$edit2=mysql_query("SELECT * FROM pengguna WHERE nama_lengkap='$r[nama_petugas]'");
    $r2=mysql_fetch_array($edit2);
    echo "<p>
          <form method=POST action=$aksi?page=petugas&act=update name=text_form onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_petugas]'>
          <table>
           <tr><td width=200>Kode Petugas</td> <td> : <input type=text name='kode_petugas' id='kode_petugas' maxlength=20 readonly class='input-short' value='$r[kode_petugas]'></td></tr>
          <tr><td>Nama Petugas</td> <td> : <input type=text name='nama_petugas' id='nama_petugas' class='input-short' value='$r[nama_petugas]'></td></tr>
		  <tr><td>No Telepon</td> <td> : <input type=text name='no_telp' id='no_telp' class='input-short' value='$r[no_telp]' onkeypress=\"return isNumberKey(event)\" maxlength=15></td></tr>
		  <tr><td>Alamat</td> <td> : <input type=text name='alamat' id='alamat' class='input-short' value='$r[alamat]'></td></tr>
		  <tr><td>Informasi Login</td> <td> </td></tr>
		  <tr><td>Username</td> <td> : <input type=text name='username' id='username' class='input-short' value='$r2[username]' readonly></td></tr>
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
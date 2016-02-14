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
function Blank_TextField_Validator()
{
if (text_form.username.value == "")
{
   alert("Isi dulu username !");
   text_form.username.focus();
   return (false);
}
if (text_form.password.value == "")
{
   alert("Isi dulu password !");
   text_form.password.focus();
   return (false);
}
if (text_form.nama_lengkap.value == "")
{
   alert("Isi dulu nama lengkap !");
   text_form.nama_lengkap.focus();
   return (false);
}
return (true);
}
</script>
</head>
<body>
<?php
include "../config/fungsi_alert.php";
$aksi="page/page_pengguna/aksi_pengguna.php";

switch($_GET[act]){
  default:
  $offset=$_GET['offset'];
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
$tampil=mysql_query("SELECT * FROM pengguna ORDER BY username");
$baris=mysql_num_rows($tampil);
echo '
<p>
	<a href="?page=pengguna&act=tambahpengguna" class="button">
	   <span>Tambah Data Pengguna <img src="images/plus-small.gif" width="12" height="9" alt="Tambah Data Pengguna" /></span>
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
		  <th>Username</th>
		  <th>Nama Lengkap</th>
		  <th align=center>Aksi</th>
		  </tr></thead><tbody>"; 
$hasil = mysql_query("SELECT * FROM pengguna where level='admin' ORDER BY username limit $offset,$limit");
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
		<td>".$r['username']."</td>
		<td>".$r['nama_lengkap']."</td>
		<td align='center'>
		<a href=?page=pengguna&act=editpengguna&id=$r[username]><img src='images/pencil.gif' title='Ubah' alt='Ubah' width='16' height='16'></a> &nbsp;
		<a href=\"JavaScript: confirmIt('Anda yakin akan menghapus data ini ?','$aksi?page=pengguna&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='images/minus-circle.gif' title='Hapus' alt='Hapus' width='16' height='16'></a>
		</td>
		</tr>";
$no++;
$counter++;
}
echo "</tbody></table></p>";

echo "<p><div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=$PHP_SELF?page=pengguna&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=$PHP_SELF?page=pengguna&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=$PHP_SELF?page=pengguna&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div></p>";

   }else{
	echo '<br><br><span class="notification n-information">Data Kosong.</span>';
	}
    break;

case "tambahpengguna":
    echo "<p>
		
		<form method=POST action='$aksi?page=pengguna&act=input' name=text_form onsubmit='return Blank_TextField_Validator()'>

          <table>
          <tr><td width=200>Username</td> <td> : <input type=text name='username' id='username' maxlength=20 class='input-short'></td></tr>
		  <tr><td>Password</td> <td> : <input type=password name='password' id='password' class='input-short'></td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' id='nama_lengkap' class='input-short' onkeypress=\"ValidateAlpha();\" ></td></tr>
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
    
  case "editpengguna":
    $edit=mysql_query("SELECT * FROM pengguna WHERE username='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<p>
          <form method=POST action=$aksi?page=pengguna&act=update name=text_form onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[username]'>
          <table>
           <tr><td width=200>Username</td>     <td> : <input type=text name='username' id='username' maxlength=20 class='input-short' value='$r[username]'></td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' id='nama_lengkap' class='input-short' onkeypress=\"ValidateAlpha();\" value='$r[nama_lengkap]'></td></tr>
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
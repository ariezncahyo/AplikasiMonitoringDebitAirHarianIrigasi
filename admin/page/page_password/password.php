<?php
switch($_GET[act]){
default:
echo "<p>
		<form method='post' action='?page=password&act=updatepassword'>
		<table>
		<tr><td width=200>Masukkan password lama</td><td><input type='password' name='oldPass' class='input-short' /></td></tr>
		<tr><td>Masukkan password baru</td><td><input type='password' name='newPass1' class='input-short' /></td></tr>
		<tr><td>Masukkan kembali password baru</td><td><input type='password' name='newPass2' class='input-short' /></td></tr>
		<tr><td></td><td>
		<fieldset>
		<input class='submit-green' type=submit value='Ubah'>
		<input type='hidden' name='pass' value='".$_SESSION['password']."'>
		<input type='hidden' name='nama' value='".$_SESSION['username']."'></td></tr>
		</fieldset>
		</table>		
		</form>
		</p>";
break;

case "updatepassword":

$pengacak = $_POST['pass'];

include "../config/koneksi.php";

$user = $_POST['nama'];
$passwordlama = $_POST['oldPass'];
$passwordbaru1 = $_POST['newPass1'];
$passwordbaru2 = $_POST['newPass2'];

$query = "SELECT * FROM pengguna WHERE username = '$user'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['password'] ==  md5($passwordlama))
//if ($data['password'] ==  $passwordlama)
{
	if ($passwordbaru1 == $passwordbaru2)
	{

		$passwordbaruenkrip = md5($passwordbaru1);
		//$passwordbaruenkrip = $passwordbaru1;
		
		$query = "UPDATE pengguna SET password = '$passwordbaruenkrip' WHERE username = '$user' ";
		$hasil = mysql_query($query);
		
		if ($hasil) echo "<p>Update password sukses !</p>";

	}
	else echo "<p>Password baru Anda tidak sama !</p><br>
	<a href='?page=password' >Ulangi Lagi</a>";
}
else echo "<p>Password lama Anda salah !</p><br>
	<a href='?page=password' >Ulangi Lagi</a>";
break;
}
?>
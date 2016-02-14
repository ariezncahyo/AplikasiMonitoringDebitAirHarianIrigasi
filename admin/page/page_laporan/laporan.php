<?php
error_reporting(0);
?>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
		<script type="text/javascript">
		$(function() {
		$( "#periode1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate : '0',
				dateFormat: "dd-mm-yy"
			});
		$( "#periode2" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate : '0',
				dateFormat: "dd-mm-yy"
			});
		});
		</script>
<?php
include "../config/fungsi_alert.php";
$aksi="page/page_laporan/aksi_laporan.php";
switch($_GET[act]){
	
  default:

  include "../config/koneksi.php";

	$tgl = date('d-m-Y');
	echo "
	<form method=POST action='$aksi?page=laporan&act=cetak' target='_blank'>
	<br><div>
	  <span>Periode</span>
	  <input type=text name='periode1' id='periode1' value='$tgl' > &nbsp; s/d &nbsp; <input type=text name='periode2' id='periode2' value='$tgl'>
	  <br><br>
	  <input type=submit value='     Cetak     ' name='btnCetak' >
	</div>
	</form>";
	
	break;
}
?>

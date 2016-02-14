<html>
<head>
<script src="js/highcharts.js" type="text/javascript"></script>
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
var chart1;
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'Grafik Debit Air Harian Periode <?php echo $_POST['periode1']." s/d ".$_POST['periode2']; ?>'
         },
         xAxis: {
            categories: ['Tanggal']
         },
         yAxis: {
            title: {
               text: 'Debit Air (lt/dtk)'
            }
         },
              series:             
            [
            <?php 
        	include "../config/koneksi.php";
			$tgl1 = explode("-",$_POST['periode1']);
			$tgl2 = explode("-",$_POST['periode2']);
			$strtgl1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
			$strtgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
			$sql2   = "SELECT DATE_FORMAT(tanggal,'%d-%m-%Y') AS tgl,debit_sungai from debit_air WHERE tanggal between '".$strtgl1."' AND '".$strtgl2."' order by tanggal";
			$query2 = mysql_query( $sql2 )  or die(mysql_error());
			while ($res = mysql_fetch_array( $query2 )){

				$tanggal=$res['tgl'];
				$debitsungai=$res['debit_sungai'];
                  ?>
                  {
                      name: '<?php echo $tanggal; ?>',
                      data: [<?php echo $debitsungai; ?>]
                  },
                  <?php } ?>
            ]
      });
   });
</script>
</head>
<body>
<?php
$tgl = date('d-m-Y');
	echo "
	<form method=POST action='?page=home' >
	<br><div>
      <span>Periode</span>
	  <input type=text name='periode1' id='periode1' value='$tgl' > &nbsp; s/d &nbsp; <input type=text name='periode2' id='periode2' value='$tgl'>
	  <br><br>
	  <input type=submit value='     Proses     ' name='btnProses' >
	</div>
	</form>";
	if($_POST['btnProses']){
		echo "<br><div id='container'></div>";
	}
?>
</body>
</html>
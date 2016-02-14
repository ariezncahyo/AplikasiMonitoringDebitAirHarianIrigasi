<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Halaman Administrator - Daerah Irigasi Cibanjaran</title>

		<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/jquery.wysiwyg.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/thickbox.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/theme-blue.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/paging.css" media="screen" />
		<script type="text/javascript" src="js/jquery-1.8.2.min.js" ></script>
		<script type="text/javascript" src="js/jquery.wysiwyg.js" ></script>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js" ></script>
		<script type="text/javascript" src="js/jquery.tablesorter.pager.js" ></script>
		<script type="text/javascript" src="js/jquery.pstrength-min.1.2.js" ></script>
		<script type="text/javascript" src="js/thickbox.js" ></script>
		<script type="text/javascript">
			$(function()
			{
			$('#wysiwyg').wysiwyg(
			{
			controls : {
			separator01 : { visible : true },
			separator03 : { visible : true },
			separator04 : { visible : true },
			separator00 : { visible : true },
			separator07 : { visible : false },
			separator02 : { visible : false },
			separator08 : { visible : false },
			insertOrderedList : { visible : true },
			insertUnorderedList : { visible : true },
			undo: { visible : true },
			redo: { visible : true },
			justifyLeft: { visible : true },
			justifyCenter: { visible : true },
			justifyRight: { visible : true },
			justifyFull: { visible : true },
			subscript: { visible : true },
			superscript: { visible : true },
			underline: { visible : true },
            increaseFontSize : { visible : false },
            decreaseFontSize : { visible : false }
			}
			} );
			});
        </script>
        <script type="text/javascript">
			$(document).ready(function() { 
				$("#myTable") 
				.tablesorter({
					// zebra coloring
					widgets: ['zebra'],
					// pass the headers argument and assing a object 
					headers: { 
						// assign the sixth column (we start counting zero) 
						6: { 
							// disable it by setting the property sorter to false 
							sorter: false 
						} 
					}
				}) 
			
		}); 
		</script>
		<script type="text/javascript">
			$(function() {
			$('.password').pstrength();
			});
        </script>
	</head>
	<body>
    	<!-- Header -->
        <div id="header">
            <!-- Header. Status part -->
            <div id="header-status">
                <div class="container_12">
                    <div class="grid_8">
					<br>
					<b>APLIKASI MONITORING DEBIT AIR HARIAN - DAERAH IRIGASI CIBANJARAN </b>
						&nbsp;
                    </div>
                    <div class="grid_4">
                        <a href="../logout.php" id="logout">
                        Logout
                        </a>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End #header-status -->
            
            <!-- Header. Main part -->
            <div id="header-main">
                <div class="container_12">
                    <div class="grid_12">
                        <div id="logo">
                            <ul id="nav">
                                <?php include "menu.php"; ?>
                            </ul>
                        </div><!-- End. #Logo -->
                    </div><!-- End. .grid_12-->
                    <div style="clear: both;"></div>
                </div><!-- End. .container_12 -->
            </div> <!-- End #header-main -->
            <div style="clear: both;"></div>
            <!-- Sub navigation -->
            <div id="subnav">
                <div class="container_12">
          
                </div><!-- End. .container_12 -->
                <div style="clear: both;"></div>
            </div> <!-- End #subnav -->
        </div> <!-- End #header -->
        
		<div class="container_12">
            
            <!-- Form elements -->    
            <div class="grid_12">
            
                <div class="module">
                     <?php include "content.php"; ?>
                </div> 
				
        		<div style="clear:both;"></div>
            </div> <!-- End .grid_12 -->
                
            
            <div style="clear:both;"></div>
        </div> <!-- End .container_12 -->
		
           
        <!-- Footer -->
        <div id="footer">
        	<div class="container_12">
            	<div class="grid_12">
                	<!-- You can change the copyright line for your own -->
                	<p>&copy; 2013 - <a href="#" title="Daulat Edwar Aritonang">Daulat Edwar Aritonang</a></p>
        		</div>
            </div>
            <div style="clear:both;"></div>
        </div> <!-- End #footer -->
	</body>
</html>
<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); ?>
  </div>
<?php
$mappa="Application/Images/hirdetesek/";
$connect2 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
?>
  
	<div id="jobboldal">
	<form method="POST" enctype="multipart/form-data" action="">
	Kép föltöltése: <input name="kep" type="file" />
	<input type="submit" value="Kép feltöltése" name="modosit">
	<input type="text" name="link" placeholder="link">
	</form>
	<?

					   $sql = "SELECT * FROM fooldal_hirdetes";
					$result = mysql_query( $sql, $connect2 );
    while($v = mysql_fetch_assoc($result)) {
	if (file_exists($mappa.$v['name'])){
	$id = $v['id'];
		print '<img width="100px" src="'.$mappa.$v['name'].'" />';
		print '<a href="/'.$this->segment(1).'/'.$id.'"><img src="Application/Images/torles.png" alt="Törlés"/></a>';
		}	
    }
	
		?>
</div>
  
  <div style="clear:both;">&nbsp;</div>
</div>


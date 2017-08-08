<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); ?>
  </div>
<?php
$mappa="Application/Images/fooldal/";
?>
  
	<div id="jobboldal">
	<form method="POST" enctype="multipart/form-data" action="">
	<?

						if (file_exists($mappa."kep1.jpg"))
							{
							
								print '<img width="100px" src="'.$mappa.'kep1.jpg" align="left"/>';
								print 'Kép lecserélése: <input name="kep1" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del1" />';
							}
							else{
								print 'Kép föltöltése: <input name="kep1" type="file" />';
							}
							print "<br/><br/><br/>";
						if (file_exists($mappa."kep2.jpg"))
							{
								print '<img width="100px" src="'.$mappa.'kep2.jpg" />';
								print 'Kép lecserélése: <input name="kep2" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del2" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep2" type="file" />';
							}
							print "<br/><br/>";
						if (file_exists($mappa."kep3.jpg"))
							{
								print '<img width="100px" src="'.$mappa.'kep3.jpg" />';
								print 'Kép lecserélése: <input name="kep3" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del3" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep3" type="file" />';
							}
							print "<br/><br/>";
						if (file_exists($mappa."kep4.jpg"))
							{
								print '<img width="100px" src="'.$mappa.'kep4.jpg" />';
								print 'Kép lecserélése: <input name="kep4" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del4" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep4" type="file" />';
							}
							print "<br/><br/>";
						if (file_exists($mappa."kep5.jpg"))
							{
								print '<img width="100px" src="'.$mappa.'kep5.jpg" />';
								print 'Kép lecserélése: <input name="kep5" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del5" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep5" type="file" />';
							}
							print "<br/><br/>";
						if (file_exists($mappa."kep6.jpg"))
							{
								print '<img width="100px" src="'.$mappa.'kep6.jpg" />';
								print 'Kép lecserélése: <input name="kep6" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del6" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep6" type="file" />';
							}
							print "<br/><br/>";
						if (file_exists($mappa."kep7.jpg"))
							{
								print '<img width="100px src="'.$mappa.'kep7.jpg" />';
								print 'Kép lecserélése: <input name="kep7" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del7" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep7" type="file" />';
							}
							print "<br/><br/>";
						if (file_exists($mappa."kep8.jpg"))
							{
								print '<img width="100px src="'.$mappa.'kep8.jpg" />';
								print 'Kép lecserélése: <input name="kep8" type="file" /><br>';
								print 'Kép törlése: <input type="checkbox" name="del8" />';
							}
							else{
								print ' Kép föltöltése: <input name="kep8" type="file" />';
							}
							print "<br/><br/>";
						
						print'
						
					   
					
<input type="submit" value="Képek módosítása" name="modosit">
					</form>';
		
		if (isset( $_POST['modosit']))
			{
				if (!empty($_FILES['kep1']['tmp_name']))
					move_uploaded_file($_FILES['kep1']['tmp_name'], $mappa . "kep1.jpg");
				if (!empty($_FILES['kep2']['tmp_name']))
					move_uploaded_file($_FILES['kep2']['tmp_name'], $mappa . "kep2.jpg");
				if (!empty($_FILES['kep3']['tmp_name']))
					move_uploaded_file($_FILES['kep3']['tmp_name'], $mappa . "kep3.jpg");
				if (!empty($_FILES['kep4']['tmp_name']))
					move_uploaded_file($_FILES['kep4']['tmp_name'], $mappa . "kep4.jpg");
				if (!empty($_FILES['kep5']['tmp_name']))
					move_uploaded_file($_FILES['kep5']['tmp_name'], $mappa . "kep5.jpg");
				if (!empty($_FILES['kep6']['tmp_name']))
					move_uploaded_file($_FILES['kep6']['tmp_name'], $mappa . "kep6.jpg");
				if (!empty($_FILES['kep7']['tmp_name']))
					move_uploaded_file($_FILES['kep7']['tmp_name'], $mappa . "kep7.jpg");
				if (!empty($_FILES['kep8']['tmp_name']))
					move_uploaded_file($_FILES['kep8']['tmp_name'], $mappa . "kep8.jpg");
					
				if ($_POST['del1'] == true and file_exists($mappa. "kep1.jpg"))
					unlink($mappa. "kep1.jpg");
				if ($_POST['del2'] == true and file_exists($mappa. "kep2.jpg"))
					unlink($mappa. "kep2.jpg");
				if ($_POST['del3'] == true and file_exists($mappa. "kep3.jpg"))
					unlink($mappa. "kep3.jpg");
				if ($_POST['del4'] == true and file_exists($mappa. "kep4.jpg"))
					unlink($mappa. "kep4.jpg");
				if ($_POST['del5'] == true and file_exists($mappa. "kep5.jpg"))
					unlink($mappa. "kep5.jpg");
				if ($_POST['del6'] == true and file_exists($mappa. "kep6.jpg"))
					unlink($mappa. "kep6.jpg");
				if ($_POST['del7'] == true and file_exists($mappa. "kep7.jpg"))
					unlink($mappa. "kep7.jpg");
				if ($_POST['del8'] == true and file_exists($mappa. "kep8.jpg"))
					unlink($mappa. "kep8.jpg");
					
			};	
		?>
</div>
  
  <div style="clear:both;">&nbsp;</div>
</div>


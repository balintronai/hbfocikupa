<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); ?>
  </div>
  
  <div id="baloldal">
 <?php
$mappa="Application/saves/archivum/";
if ( isset($_POST['want2delete']) /*and isset($_POST['delete' . $id])*/)
	{
	$id=$_POST['want2delete'];
	if(file_exists($mappa. $id .".php"))
		unlink($mappa. $id .".php");
		
	if(file_exists($mappa. $id ."_title.php"))
		unlink($mappa. $id ."_title.php");
		
	if(file_exists($mappa. $id ."a.jpg"))
		unlink($mappa. $id ."a.jpg");
		
	if(file_exists($mappa. $id ."b.jpg"))
		unlink($mappa. $id ."b.jpg");
		
	if(file_exists($mappa. $id ."c.jpg"))
		unlink($mappa. $id ."c.jpg");
	
	
	
	
	
	
	}
 
 
 
 
 ?>
  <ul>
  <?php
    $news = file_get_contents($mappa . "counter.php");	//A news változó a hírek számát jelöli
	for ( $counter = $news; $counter !=0 ; $counter--)	
		{
			if(file_exists($mappa . $counter . "_title.php"))
				{
					print "<li>";
					include($mappa . $counter . "_title.php");
					print "<br>
					<form method='POST'><input type='hidden' name='szerk' value='" . $counter . "'><input type='submit' value='Átírás' name='szerk" . $counter . "'/></form>
					<form method='POST'><input type='hidden' name='want2delete' value='" . $counter . "'><input type='submit' value='Törlés' name='delete" . $counter . "'/></form></li>";
				};
		};
	?>
	</ul>
  </div>  


  
  <script>
    function ellenorzes() {
      var mehet = true;
      var szoveg = ''
      if ( $('#hircime').val() == '' ) {
        szoveg = szoveg + "Az hír címét muszáj kitölteni!\n";
        mehet = false;
      }
      if ( $('#kategoria').val() == '0' ) {
        szoveg = szoveg + "Muszáj kategóriát választani!\n";
        mehet = false;
      }
      
      if (szoveg) alert(szoveg);
      return mehet;
    }
  </script>
  
  <script>
    $(function() {
      $('#datum').datepicker();
      $("#datum").datepicker( "option", "dateFormat", "yy-mm-dd" );
      $("#datum").datepicker( 'setDate','<?=$hir['hir_datum'];?>' );
    });
  </script>
  
	<div id="jobboldal">
	<?
	
	
				if (isset($_POST["szerk"] ))
			{
				$title = file_get_contents($mappa.$_POST['szerk']."_title.php");
				$hir = file_get_contents($mappa.$_POST['szerk'].".php");
				$date = file_get_contents($mappa.$_POST['szerk']."_date.php");
				print '<form  enctype="multipart/form-data"  method="POST">
					   
					  <table class="adatok">
						<tr>
						  <td>Cím</td>
						  <td><input type="text" name="title" value="'.$title.'" id="hircime"/></td>
						</tr>
						   

						<tr>
						  <td colspan="2">Szöveg:</td>
						</tr>
						<tr>
						  <td colspan="2">
							<textarea name="content" class="ckeditor">'.$hir.'</textarea><br />
						  </td>
						</tr>
						<tr>
						  <script>
    $(function() {
      $("#datum").datepicker( "setDate","'.$date.'" );
    });
  </script>
							<td>Dátum</td>
							<td><input type="text" name="date" id="datum"/></td>
								</tr>
						<tr>
							<td>Kép</td><br>
							<table width="90%"><tr>';
						print '<td>';
						if (file_exists($mappa.$_POST['szerk']."a.jpg"))
							{
								print '<img width="90%" src="'.$mappa.$_POST['szerk'].'a.jpg" />';
								print '<br>Kép lecserélése: <input name="imga" type="file" />';
								print '<br> Kép törlése: <input type="checkbox" name="dela" />';
							}
							else{
								print ' Kép föltöltése: <input name="imga" type="file" />';
							}
							
						print '</td>';
						print '<td>';
						if (file_exists($mappa.$_POST['szerk']."b.jpg"))
							{
								print '<img width="90%" src="'.$mappa.$_POST['szerk'].'b.jpg" />';								
								print '<br>Kép lecserélése: <input name="imgb" type="file" />';
								print '<br> Kép törlése: <input type="checkbox" name="delb" />';
							}
							else{
								print ' Kép föltöltése: <input name="imgb" type="file" />';
							}
							
						print '</td>';
						print '<td>';
						if (file_exists($mappa.$_POST['szerk']."c.jpg"))
							{
								print '<img width="90%" src="'.$mappa.$_POST['szerk'].'c.jpg" />';
								print '<br>Kép lecserélése: <input name="imgc" type="file" />';
								print '<br> Kép törlése: <input type="checkbox" name="delc" />';
								
							}
							else{
								print ' Kép föltöltése: <input name="imgb" type="file" />';
							}
						print '</td></tr>';
						
						
						
						print'
							</table>
						
					   
						
						<input type="hidden" name="counter" value="'.$_POST['szerk'].'">
						  <td><input type="submit" value="Hír átírása" name="modosit">
						</tr>
					  </table>
					</form>';
				
							
			
			
			
			
			
			
			
			}
		if (isset( $_POST['modosit']))
			{
				
				$title = $_POST['title'];
				$hir = $_POST['content'];
				$date = $_POST['date'];
				if ($title and $hir)
					{
					$count = $_POST['counter'];
					
					
					$fajlnev1 = $mappa . $count . ".php";		//Hír fájl létrehozása
					$fp1 = fopen("$fajlnev1", "w"); 
					fwrite($fp1, $hir);
					fclose($fp1);
					
					$filenev2 = $mappa . $count . "_title.php";		//Cím fájl létrehozása
					$fp2 = fopen($filenev2, "w"); 
					fwrite($fp2, $title);
					fclose($fp2);
					
					
					$filenev3 = $mappa . $count . "_date.php";		//dátum fájl létrehozása
					$fp3 = fopen($filenev3, "w"); 
					fwrite($fp3, $date);
					fclose($fp3);
					
					}
				if ( $title == "")
					{
					echo "Cím mező kitöltése kötelező";
					};
				if ( $hir == "")
					{
					echo "Hír szövegdoboz kitöltése kötelező";
					};
				if (!empty($_FILES['imga']['tmp_name']))
					move_uploaded_file($_FILES['imga']['tmp_name'], $mappa . $count . "a.jpg");
				if (!empty($_FILES['imgb']['tmp_name']))
					move_uploaded_file($_FILES['imgb']['tmp_name'], $mappa . $count . "b.jpg");
				if (!empty($_FILES['imgc']['tmp_name']))
					move_uploaded_file($_FILES['imgc']['tmp_name'], $mappa . $count . "c.jpg");	
				if ($_POST['dela'] == true and file_exists($mappa. $count ."a.jpg"))
					unlink($mappa. $count ."a.jpg");
				if ($_POST['delb'] == true and file_exists($mappa. $count ."b.jpg"))
					unlink($mappa. $count ."b.jpg");
				if ($_POST['delc'] == true and file_exists($mappa. $count ."c.jpg"))
					unlink($mappa. $count ."c.jpg");
					
			};	
		if (isset( $_POST['submit']))
			{
				if ($_POST['date'])
					$date = $_POST['date'];
				else
					$date = date("Y. m. d.");
				$title = $_POST['title'];
				$hir = $_POST['content'];
				if ($title and $hir)
					{
					$count = file_get_contents($mappa . "counter.php");
					$count++; 
					
					
					$fajlnev1 = $mappa . $count . ".php";		//Hír fájl létrehozása
					$fp1 = fopen("$fajlnev1", "w"); 
					fwrite($fp1, $hir);
					fclose($fp1);
					
					$filenev2 = $mappa . $count . "_title.php";		//Cím fájl létrehozása
					$fp2 = fopen($filenev2, "w"); 
					fwrite($fp2, $title);
					fclose($fp2);
					
					$filenev3 = $mappa. "counter.php";		//Counter fájl átírása
					$fp3 = fopen("$filenev3", "w"); 
					fwrite($fp3, $count);
					fclose($fp3);
					
					$filenev4 = $mappa . $count . "_date.php";		//Dátum fájl létrehozása
					$fp4 = fopen($filenev4, "w"); 
					fwrite($fp4, $date);
					fclose($fp4);
					}
				if ( $title == "")
					{
					echo "Cím mező kitöltése kötelező";
					};
				if ( $hir == "")
					{
					echo "Hír szövegdoboz kitöltése kötelező";
					};
			
			move_uploaded_file($_FILES['imga']['tmp_name'], $mappa . $count . "a.jpg");
			move_uploaded_file($_FILES['imgb']['tmp_name'], $mappa . $count . "b.jpg");
			move_uploaded_file($_FILES['imgc']['tmp_name'], $mappa . $count . "c.jpg");
			
		};


if (!isset($_POST["szerk"] ))
    print'
    <form  enctype="multipart/form-data"  method="POST">
      
      <table class="adatok">
        <tr>
          <td>Cím</td>
          <td><input type="text" name="title" value="'.$title.'" id="hircime"/></td>
        </tr>
           

        <tr>
          <td colspan="2">Szöveg:</td>
        </tr>
        <tr>
          <td colspan="2">
            <textarea name="content" class="ckeditor">'.$hir.'</textarea><br />
          </td>
        </tr>
        
        <tr>
          <td>Dátum</td>
          <td><input type="text" name="date" id="datum" value="'.$date.'"/></td>
        </tr>
                  
        
        
        <tr>
          <td>Kép</td>
          <td>
				<input name="imga" type="file" />
				<input name="imgb" type="file" />
				<input name="imgc" type="file" />
		  
		  

          </td>
        </tr>
                  
        <tr>
          <td><input type="submit" value="Hír kiírása" name="submit">
        </tr>
      </table>
    </form><br>';
	?>
</div>
  
  <div style="clear:both;">&nbsp;</div>
</div>


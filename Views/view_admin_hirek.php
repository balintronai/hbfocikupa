<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); ?>
	 <?php
$mappa="Application/saves/tippmix/";
if ( isset($_POST['want2delete']) /*and isset($_POST['delete' . $id])*/)
	{
	$id=$_POST['want2delete'];
	if(file_exists($mappa. $id .".php"))
		unlink($mappa. $id .".php");
		
	if(file_exists($mappa. $id ."_title.php"))
		unlink($mappa. $id ."_title.php");
		
	
	
	}
 
 
 
 
 ?>
  </div>
  
  <div id="baloldal">
    <ul>
      <li><?=$this->relative_link($this->segment(1),'Új hír');?></li>
    </ul>
    <?php if ($hirlista): ?>
      <ul>
        <?php foreach ($hirlista as $v){
			if ($v['hir_cim'] != "")
				print "<li>" . $this->relative_link($this->segment(1).'/'.$v['hir_id'],$v['hir_cim'],'id="menu'.$v['hir_id'].'"') . "<br><form method='POST'><input type='hidden' name='want2delete' value='" .  $v['hir_id'] . "'><input type='submit' value='Törlés' name='delete" .  $v['hir_id'] . "'/></form></li>";
         } ?>
      </ul>
      
      <?php if ($this->segment(2)): ?>
        <script>
          $('#menu'+<?= $this->segment(2);?>).addClass('active');
        </script>
      <?php endif; ?>
      
    <?php endif; ?>
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
    
    <?php if ($hiba): ?>
      <div class="error">
        <?=$hiba;?>
      </div>
    <?php endif; ?>

    <form name="oldaladat" method="post" action="" enctype="multipart/form-data" onsubmit="return ellenorzes();">
      
      <table class="adatok">
        <tr><td class="szazotven">&nbsp;</td><td></td></tr>
                 
        <tr>
          <td>Cím</td>
          <td><input type="text" name="cim" value="<?=$hir['hir_cim'];?>" id="hircime"/></td>
        </tr>
        <tr>
          <td>Kategória</td>
          <td>
            <select name="kategoria" id="kategoria">
              <option value="0">-----------------</option>
              <option value="1" <?=($hir['hir_kategoria'] == 1 ? 'selected' : '');?>>Kupa</option>
              <option value="2" <?=($hir['hir_kategoria'] == 2 ? 'selected' : '');?>>Bajnokság</option>
              <option value="3" <?=($hir['hir_kategoria'] == 3 ? 'selected' : '');?>>Kiírások</option>
              <option value="4" <?=($hir['hir_kategoria'] == 4 ? 'selected' : '');?>>Egyéb</option>
              <option value="5" <?=($hir['hir_kategoria'] == 5 ? 'selected' : '');?>>Archivum</option>
            </select>
          </td>
        </tr>
        

        <tr>
          <td colspan="2">Kép feletti rész</td>
        </tr>
        <tr>
          <td colspan="2">
            <textarea name="szoveg1" class="ckeditor"><?=str_replace('<br>',"\r\n",$hir['hir_szoveg1']);?></textarea><br />
          </td>
        </tr>
        <tr>
          <td colspan="2">Kép alatti rész</td>
        </tr>
        <tr>
          <td colspan="2">
            <textarea name="szoveg2" class="ckeditor"><?=str_replace('<br>',"\r\n",$hir['hir_szoveg2']);?></textarea><br />
          </td>
        </tr>
        
        <tr>
          <td>Dátum</td>
          <td><input type="text" name="datum" id="datum" /></td>
        </tr>
                  
        
        <tr>
          <td>Aktív?</td>
          <td><input type="checkbox" name="aktiv" <?=($hir['hir_aktiv'] == 1?'checked':'');?>/></td>
        </tr>
        
        <tr>
          <td>Kép</td>
          <td><input type="file" name="kep" />
            <?php if ($hir['hir_kep']): ?>
              <a href="/Application/Galeria/<?=$hir['hir_kep'];?>" target="_blank">
                <img src="/Application/Galeria/<?=$hir['hir_kep'];?>" style="width: 200px;"/>
              </a>
              <a href="<?=$this->a_link($this->segment(1).'/'.$this->segment(2).'/keptorles');?>" title="Kép törlése" onclick="return confirm('Biztos, hogy törlöd a képet?');">
                <img src="/Application/Images/torles.png" />
              </a>
            <?php endif; ?>
          </td>
        </tr>
                  
        <tr>
          <td><input type="submit" value="Mehet" name="hir_mehet" class="submit"/></td>
          <td></td>
        </tr>
      </table>
    </form>
  </div>
  
  <div style="clear:both;">&nbsp;</div>
</div>


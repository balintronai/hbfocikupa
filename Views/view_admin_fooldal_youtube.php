<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); ?>
  </div>
  
  <div id="jobboldal">
    <form name="oldaladat" method="post" action="" enctype="multipart/form-data">
      
      <table class="adatok">
        <tr><td class="szazotven">&nbsp;</td><td></td></tr>
                 
        <tr>
          <td>URL<input type="text" name="url" value="<?=$url['url'];?>" id="url"/></td>
        </tr>
		<tr>
		<td>
		<iframe width="420" height="315" src="https://www.youtube.com/embed/<?=$url['url'];?>" frameborder="0" allowfullscreen></iframe>
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


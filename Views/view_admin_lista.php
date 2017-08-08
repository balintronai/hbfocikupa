<head>
<link rel="stylesheet" type="text/css" href="Application/CSS/screen.css">
	<link rel="stylesheet" type="text/css" href="Application/CSS/easybox.min.css">
	</head>
<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); 
	
	?>
  </div> 
  
  <div id="jobbosldal">
		<div class="large-box noborder">		
 <form method="POST" action="">       
            <h1><input type="text" name="new"></h1>
            
		<?php
		foreach($data as $v) {
		$id = $v['id'];
		print '
		<h1><a href="admin_sorsolas/'.$id.'">'.$v['event'].'</a>
		<a href="/'.$this->segment(1).'/'.$id.'"><img align="left" src="Application/Images/torles.png" alt="Törlés"/></a></h1><br>
		';
		}
		?>    
        <input type="submit" value="Mehet" value="lista"></form>


        </div>
  </div>
  
  <div style="clear:both;">&nbsp;</div>
</div>


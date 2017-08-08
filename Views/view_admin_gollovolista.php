
<div id="wrapper">
    
  <div id="content">
    <?php $this->view('admin_menu'); 
		$eventid = $this->segment(2);
	$connect3 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
$sql = "SELECT * FROM esemeny_lista WHERE id='$eventid'";
					$result = mysql_query( $sql, $connect3 );
					  while($row = mysql_fetch_assoc($result)) {
$event = $row["event"];
	}
	?>
  </div> 
  
  <div id="jobbosldal">
		<div class="large-box noborder">		
       <form method="POST">
            <h1><?= $event; ?></h1>
            <div class="switch-tabs">
                                    <a class=" " href="/admin_sorsolas/<?= $eventid; ?>">
                        sorsolás
                    </a>
                                    <a class=" " href="/admin_tabella/<?= $eventid; ?>">
                        tabella
                    </a>
                                    <a class=" " href="/admin_eredmenyek/<?= $eventid; ?>">
                        eredmények
                    </a>
                                    <a class="active " href="#">
                        góllövő lista
                    </a>
                            </div>




<table class="md-list-2">
        <tbody><tr>
            <th>Gólok száma</th>
            <th>Játékos neve</th>
            <th>Csapat</th>
            <th>Törlés</th>
			<th><input type="submit" value="Mehet" name="sorsolas"></th></form>
        </tr>
                    <tr>
                <td class="center"><input type="text" name="goals"></td>
                <td><input type="text" name="player"></td>
                <td><input type="text" name="team"></td>
            </tr>
		<?php
foreach($data as $v) {
print '	
<form method="POST" action="/'.$this->segment(1).'/'.$eventid.'/edit/'.$v['id'].'">
<tr>
<td class="center"><input type="text" name="goals" value="'.$v['goals'].'"/></td>
<td><input type="text" name="player" value="'.$v['player'].'"/></td>
<td><input type="text" name="team" value="'.$v['team'].'"/></td>
<td><a href="/'.$this->segment(1).'/'.$eventid.'/del/'.$v['id'].'">X</a></td>
<td><input type="submit" value="szerk"></td>
</tr>
</form>
';
}	
?>		
            </tbody></table>
			


        </div>
  </div>
  
  <div style="clear:both;">&nbsp;</div>
</div>



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
                                    <a class="active " href="#">
                        eredmények
                    </a>
                                    <a class=" " href="/admin_gollovolista/<?= $eventid; ?>">
                        góllövő lista
                    </a>
                            </div>

<table class="md-list-2">
        <tbody><tr>
            <th><input type="text" name="turn" placeholder="forduló"></th>
            <th>Csapatok</th>
            <th>Eredmények</th>
            <th>Törlés</th>
			<th><input type="submit" value="Mehet" name="sorsolas"></th></form>
        </tr>
        <tr>
        <td class="td01 light-highlight center"><input type="date" name="date"></td>
        <td class="td03-2">
                            <input type="text" name="team1">
                        -
                            <input type="text" name="team2">
                    </td>
                    <td class="td04 highlight center">
               <input type="text" name="result1">
                        -
               <input type="text" name="result2">
            </td>
            </tr>    
   
                    </tbody>
					<?php
					
					
					foreach($data as $v) {
					$team1 = $v['team1'];
					$team2 = $v['team2'];
					
					print ' <tbody>
					<form method="POST" action="/'.$this->segment(1).'/'.$eventid.'/edit/'.$v['id'].'">
					       <tr>
            <th>'.$v['turn'].'</th>
            <th>csapatok</th>
            <th class="last">eredmények</th>
        </tr>
        <tr>
        <td class="td01 light-highlight center"><input type="text" name="date" value="'.$v['date'].'"/></td>
        <td class="td03-2">
                            <input type="text" name="team1" value="'.$team1.'"/>
                        -
                            <input type="text" name="team2" value="'.$team2.'"/>
                    </td>
                    <td class="td04 highlight center">
               <input type="text" name="result1" value="'.$v['result1'].'"/>
                        -
               <input type="text" name="result2" value="'.$v['result2'].'"/>
            </td>
			<td><a href="/'.$this->segment(1).'/'.$eventid.'/del/'.$v['id'].'">X</a></td>
			<td><input type="submit" value="szerk"></td>
            </tr>    
   
                    
					</form>
					</tbody>
					';
					}
					?>
					</table>
					 


        </div>
  </div>
  
  <div style="clear:both;">&nbsp;</div>
</div>


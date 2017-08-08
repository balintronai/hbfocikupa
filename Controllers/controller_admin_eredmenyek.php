<?php

  class Admin_eredmenyek extends Base 
  {
  
    function Admin_eredmenyek() 
    {
    
      // session segitseg
      $this->session = new Session();
      $this->hiba = FALSE;
      $this->uzenet = FALSE;
      
      if (! $this->session->is_session('username')) {
        $this->forward('admin');
      }
      
      $this->load = new Load();
      
      $this->load->helper('head');
      $this->head = new Head();
      
      $this->load->model('mysql');
      $this->db = new Mysql();
      
      $this->load->model('image');
      $this->img = new Image();
      
      $this->date = date('Y-m-d');
      
      if ($_POST and $this->segment(3) == 'edit') $this->edit();
      if ($_POST and $this->segment(3) == "") $this->newline();
      
      $this->index();
    
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function index() {
    
      $task = $this->segment(3);
      $id = $this->segment(4);
	  $eventid = $this->segment(2);
	  
	  if($task == "del"){
      if( ! empty($id)){
	  $query = "DELETE FROM tabella_eredmenyek WHERE id=$id";
	  $this->db->execute($query);
	  $this->forward("admin_eredmenyek/".$eventid);
	  }
	  } elseif($task == "edit"){
	  
	  
	  }
      $kozosmobilhoz = FALSE;
      
      // hirek adatai a kivalaszthatoba
      $query = "SELECT *
				FROM tabella_eredmenyek
				WHERE event=$eventid
                ORDER BY turn"; 
      $o['data'] = $this->db->get_array($query);

      
      $o['hiba'] = $this->hiba;
      $o['uzenet'] = $this->uzenet;
      
      
      $this->head->set_title('Hírek',TRUE);
      $this->head->set_head_full();
      $this->head->add_css('admin.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
	  $this->head->add_css('easybox.min.css');
      $this->head->add_css('screen.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $this->load->view('admin_head',$head);
      $this->load->view('admin_eredmenyek',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function newline() {
    
      $post = $this->db->input($_POST);
      	$eventid = $this->segment(2);
	$connect2 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
	  if( ! empty ($_POST['turn'])){
        $query = "INSERT INTO tabella_eredmenyek (turn, date, team1, team2, result1, result2, event)
                  VALUES ('".$post['turn']."',
                      '".$post['date']."',
                      '".$post['team1']."',
                      '".$post['team2']."',
                      ".$post['result1'].",
                      ".$post['result2'].",
					  '".$eventid."')";
        $this->db->execute($query);
		}


    
    }
	
		public function edit() {

      $post = $this->db->input($_POST);
	  $id = $this->segment(4);
	  $eventid = $this->segment(2);
	  
	$connect2 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
				$sql = "UPDATE tabella_eredmenyek SET date='".$post['date']."', team1='".$post['team1']."', team2='".$post['team2']."', result1='".$post['result1']."', result2='".$post['result2']."' WHERE id='".$id."'";
					mysql_query($sql, $connect2);
	$this->forward("admin_eredmenyek/".$eventid);
	}
  
  }

?>

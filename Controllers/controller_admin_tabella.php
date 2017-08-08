<?php

  class Admin_tabella extends Base 
  {
  
    function Admin_tabella() 
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
	  $query = "DELETE FROM tabella_tabella WHERE id=$id";
	  $this->db->execute($query);
	  $this->forward("admin_tabella/".$eventid);
	  }
	  }
      $kozosmobilhoz = FALSE;
      
      // hirek adatai a kivalaszthatoba
      $query = "SELECT *
                FROM tabella_tabella
				WHERE event=$eventid
                ORDER BY place"; 
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
      $this->load->view('admin_tabella',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function newline() {
    
      $post = $this->db->input($_POST);
	  
	  	$eventid = $this->segment(2);
	$connect2 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
	  if( ! empty ($_POST['team'])){
        $query = "INSERT INTO tabella_tabella (place, team, M, GY, D, V, GK, P, event)
                  VALUES ( '".$post['place']."',
                      '".$post['team']."',
                      ".$post['M'].",
					  ".$post['GY'].",
					  ".$post['D'].",
					  ".$post['V'].",
                      ".$post['GK'].",
                      ".$post['P'].",
'".$eventid."'
)";
        $this->db->execute($query);
		}

    
    }
	
	public function edit() {

      $post = $this->db->input($_POST);
	  $id = $this->segment(4);
	  $eventid = $this->segment(2);
	  
	$connect2 = mysql_connect("localhost", "j1apy39y", "BeniVictor");
mysql_select_db("j1apy39y", $connect2);
				$sql = "UPDATE tabella_tabella SET place='".$post['place']."', team='".$post['team']."', M='".$post['M']."', GY='".$post['GY']."', D='".$post['D']."', V='".$post['V']."', GK='".$post['GK']."', P='".$post['P']."' WHERE id='".$id."'";
					mysql_query($sql, $connect2);
	$this->forward("admin_tabella/".$eventid);
	}
  
  }

?>

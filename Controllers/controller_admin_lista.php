<?php

  class Admin_lista extends Base 
  {
  
    function Admin_lista() 
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
      
      if ($this->segment(3) == 'keptorles') $this->keptorles();
      if ($_POST) $this->valtozas();
      
      $this->index();
    
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function index() {
    
      $id = $this->segment(2);

	  	  if( ! empty ($id)) {
	  $query = "DELETE FROM esemeny_lista WHERE id=$id";
	  $this->db->execute($query);
	  $this->forward("admin_lista");
	  }
	  
      $kozosmobilhoz = FALSE;
      
      // hirek adatai a kivalaszthatoba
      $query = "SELECT *
                FROM esemeny_lista
                "; 
      $o['data'] = $this->db->get_array($query);
      
      $o['hiba'] = $this->hiba;
      $o['uzenet'] = $this->uzenet;
      
      
      $this->head->set_title('Hírek',TRUE);
      $this->head->set_head_full();
      $this->head->add_css('admin.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $this->load->view('admin_head',$head);
      $this->load->view('admin_lista',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function valtozas() {
    
      $post = $this->db->input($_POST);
      
	  if( ! empty ($_POST['new'])){
        $query = "INSERT INTO esemeny_lista (event)
                  VALUES ( '".$post['new']."'
)";
        $this->db->execute($query);
		}

    
    }
  
  }

?>

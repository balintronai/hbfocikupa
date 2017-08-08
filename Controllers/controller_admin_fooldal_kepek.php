<?php

  class Admin_fooldal_kepek extends Base 
  {
  
    function Admin_fooldal_kepek() 
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
        
      $this->index();
    
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function index() {
    
      $id = $this->segment(2);
      if ($id) $id += 0;
      $kozosmobilhoz = FALSE;
      
      // megjelenitendo hir tartalma
      
      $o['hiba'] = $this->hiba;
      $o['uzenet'] = $this->uzenet;
      
      
      $this->head->set_title('Képek',TRUE);
      $this->head->set_head_full();
      $this->head->add_css('admin.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $this->load->view('admin_head',$head);
      $this->load->view('admin_fooldal_kepek',$o);
    }
	
/*
 * ------------------------------------------------------------------------------------------------



    
    public function keptorles() {
    
      if ($id = $this->segment(2)+0) {
      
        $query = "SELECT * FROM focis_fooldal_kepek";
        $kepnev = $this->db->get_row($query,'hir_kep');
        
        unlink('Application/Galeria/'.$kepnev);
        
        $query = "UPDATE focis_fooldal_kepek SET hir_kep = '' WHERE hir_id = '$id'";
        $this->db->execute($query);
        
      }
      
      $this->forward('admin_hirek/'.$id);
    
    }
  */
  }
 
?>

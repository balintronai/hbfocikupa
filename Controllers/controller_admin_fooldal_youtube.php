<?php

  class Admin_fooldal_youtube extends Base 
  {
  
    function Admin_fooldal_youtube() 
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
      
      if ($_POST) $this->valtozas();
      
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
      $query = "SELECT *
                FROM youtube
               ";
      $o['url'] = $this->db->get_row($query); 
      
      
      $this->head->set_title('Youtube',TRUE);
      $this->head->set_head_full();
      $this->head->add_css('admin.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $this->load->view('admin_head',$head);
      $this->load->view('admin_fooldal_youtube',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function valtozas() {
    
      $post = $this->db->input($_POST);
      
        $query = "UPDATE youtube 
                  SET url = '".$post['url']."'
				  ";
        $this->db->execute($query);
    
    }
  
  }

?>

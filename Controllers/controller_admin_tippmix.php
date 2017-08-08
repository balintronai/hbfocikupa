<?php

  class Admin_tippmix extends Base 
  {
  
    function Admin_tippmix() 
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
      
      // hirek adatai a kivalaszthatoba
      $query = "SELECT hir_id, hir_cim
                FROM focis_hirek 
                ORDER BY hir_cim ASC"; 
      $o['hirlista'] = $this->db->get_array($query);
      
      // megjelenitendo hir tartalma
      $query = "SELECT *
                FROM focis_hirek
                WHERE hir_id = '$id'
               ";
      $o['hir'] = $this->db->get_row($query); 
      
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
      $this->load->view('admin_tippmix',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

  
  }

?>

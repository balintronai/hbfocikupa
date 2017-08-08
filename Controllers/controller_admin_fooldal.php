<?php

  class Admin_fooldal extends Base
  {
  
    function Admin_fooldal()
    {
      // session segitseg
      $this->session = new Session();
      
      if (! $this->session->is_session('username')) {
        $this->forward('admin');
      }
      
      $this->load = new Load();
      
      $this->load->helper('head');
      $this->head = new Head();
      
      $this->load->model('mysql');
      $this->db = new Mysql();
      
      
      $this->index();
    }
    
    public function index() {
      $this->head->set_title('Admin fooldal',TRUE);
      $this->head->set_head_full();
      $this->head->add_css('admin.css');
      $head = $this->head->get_head();
      
      $this->load->view('admin_head',$head);
      $this->load->view('admin_fooldal');
      
    }
  
  }


?>

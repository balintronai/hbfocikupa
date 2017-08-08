<?php

  class Admin extends Base
  {
    function Admin()
    {
      $this->load = new Load();
      
      $hiba = FALSE;
      
      // head segitseg
      $this->load->helper('head');
      $this->head = new Head();
      
      $this->load->model('mysql');
      $this->db = new Mysql();
      
      // session segitseg
      $this->session = new Session();
      
      // ha valaki be akar jelentkezni
      if (isset($_POST['username'])) {
        $this->load->helper('singlelogin');
        $this->singlelogin = new Singlelogin();
        $hiba['probalkozas'] = $this->singlelogin->get_trial();
      }
      
      // ha nincs bejelentkezve a login fogadja
      // a hiba valtozoban van, hogy probalkozott-e mar
      if (!$this->session->is_session('username')) {
        $this->head->set_head_full();
        $this->head->add_css('admin.css');
        $head = $this->head->get_head();
        
        $this->load->view('admin_head',$head);
        $this->load->view('admin_login',$hiba);
        exit();
      }
      
      $this->index();
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */
    
    public function index() {
      $this->forward('admin_hirek');
    }
  }


?>

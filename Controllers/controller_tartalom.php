<?php

  class Tartalom extends Base 
  {
  
    function Tartalom()
    {
    
      $this->load = new Load();
      
      $this->load->model('mysql');
      $this->db = new Mysql();
      
      $this->load->controller('segedfugvenyek');
      $this->seged = new Segedfuggvenyek();
      
      $this->index();
    
    }
    
    public function index() {
      
      // ELLENORZI AZ URL-T
      // HA AZ 1. SZEGMENS LETEZO VIEW FAJL A CUSTOM MAPPABAN AKKOR BETOLTI AZT
      $segment1 = $this->db->input($this->segment(1));
      
      if (SHORT_URL) {
        $url = explode('?',$segment1);
        $segment1 = $url[0];
      }
      else {
        $url = explode('q=',$segment1);
        $url = explode('?',$url[1]);
        $segment1 = $url[0];
      }
      
      if ($segment1 AND file_exists('Application/Views/Custom/'.$segment1.'.php')) {
        $this->load->controller('oldal');
        $oldal = new Oldal($segment1);
      }
      else {
        $this->load->error('404');
        $error = new Error_404;
      }
      
    }
    
  }

?>

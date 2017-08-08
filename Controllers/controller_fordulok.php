<?php 

  class Fordulok extends Base
  {
  
    function Fordulok() {
    
      $this->load = new Load();
      
      $this->load->helper('head');
      $this->head = new Head();
      
      $this->load->model('mysql');
      $this->db = new Mysql();
      
      $this->load->controller('segedfugvenyek');
      $this->seged = new Segedfuggvenyek();
      
      $this->index();
    }
    
    public function index() {
    
      $page = $this->db->input($this->segment(2));
      if (! ctype_digit($page)) $page = 1;
      
      $query = "SELECT * 
                FROM esemeny_lista
				";
      $o['esemenyek'] = $this->db->get_array_pages($query,$page);
      $cim = 'Fordulók';
      $o['cim'] = $cim;
      $o['oldal'] = 'fordulok';
      
      $this->head->set_title($cim,TRUE);
      $this->head->set_seo_title($cim);
      $this->head->set_seo_keywords('Fordulók, Labdarúgás, HBF, HBFoci, Foci');
      $this->head->set_seo_description('HBF csapat által szervezett fordulók.');
      
      $this->head->set_head_full();
      
      $this->head->add_css('style.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $menu['bajnoksagok'] = $this->seged->get_bajnoksagok();
      
      $this->load->view('head',$head);
      $this->load->view('menu',$menu);
      $this->load->view('fordulok',$o);
      $this->load->view('jobboldal');
      $this->load->view('footer');
    
    }    
  }

?>
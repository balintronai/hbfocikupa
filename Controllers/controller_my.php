<?php

  class Fooldal extends Base
  {
  
    function Fooldal()
    {
      
      // include segitseg
      $this->load = new Load();
      
      // head segitseg
      $this->load->helper('head');
      $this->head = new Head();
      
      // db segitseg
      $this->load->model('mysql');
      $this->db = new Mysql();
      
      $this->load->controller('segedfugvenyek');
      $this->seged = new Segedfuggvenyek();
      
      
      $this->index();
    
    }
    
    public function index()
    {
      $page = $this->db->input($this->segment(2));
      if (! ctype_digit($page)) $page = 1;
      
      $query = "SELECT * 
                FROM focis_hirek
                WHERE hir_aktiv = 1
                ORDER BY hir_datum DESC";
      $o['hirek'] = $this->db->get_array_pages($query,$page);
      $cim = 'Aktuális kiírások, Amatőr labdarúgó bajnokságok kupák és egyéb sportok';
      $o['cim'] = $cim;
      $o['oldal'] = DEFAULT_CLASS;
      
      $this->head->set_title($cim,TRUE);
      $this->head->set_seo_title($cim);
      $this->head->set_seo_keywords('Aktuális kiírások, Labdarúgás, HBF, HBFoci, Foci, Villámtorna, Kupa, Bajnokság, Haverok buli foci, hbfocikupa, Bede');
      $this->head->set_seo_description('A Haverok Buli Foci kispályás labdarúgó eseményekről és egyéb szabadidős rendezvényekről  nyújt tájékoztatást.');
      
      $this->head->set_head_full();
      
      $this->head->add_css('style_bg1.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $menu['bajnoksagok'] = $this->seged->get_bajnoksagok();
      
      $this->load->view('head',$head);
      $this->load->view('menu',$menu);
      $this->load->view('lista',$o);
      $this->load->view('jobboldal');
      $this->load->view('footer');
    
    }
  
  }

?>

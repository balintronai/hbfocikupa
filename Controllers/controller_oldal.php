<?php

  class Oldal extends Base {
  
    function Oldal($oldal_id) {
      
      $this->oldal_id = $oldal_id;
      
      $this->load = new Load();
      
       // head segitseg
      $this->load->helper('head');
      $this->head = new Head();
      
      $this->seged = new Segedfuggvenyek();
      
      
      $this->index();
    
    }
    
    public function index() {
    
/*
 * HEAD BEALLITASA
 */
      
      include('Application/Views/Custom/'.$this->oldal_id.'.php');
      
      $o['html'] = $html;
      
      $this->head->set_title($cim,TRUE);
      $this->head->set_seo_title($cim);
      $this->head->set_seo_keywords($kulcsszavak);
      $this->head->set_seo_description($leiras);
      
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
      $this->load->view('oldal',$o);
      $this->load->view('jobboldal');
      $this->load->view('footer');
    
    }
  
  
  
  }

?>

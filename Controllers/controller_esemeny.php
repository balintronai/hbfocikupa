<?php 

  class Esemeny extends Base
  {
  
    function Esemeny() {
    
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
      $datum = $this->db->input($this->segment(2));
      $datum = date('Y-m-d',strtotime($datum));
      
      $query = "SELECT * 
                FROM focis_hirek
                WHERE hir_aktiv = 1 AND
                      hir_datum = '$datum'
                ORDER BY hir_datum DESC
               ";
      $o['hirek'] = $this->db->get_array($query);
      $cim = 'Események';
      $o['cim'] = $cim;
      
      $this->head->set_title($cim,TRUE);
      $this->head->set_seo_title($cim);
      $this->head->set_seo_keywords($cim);
      $this->head->set_seo_description($cim);
      
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
      $this->load->view('esemeny',$o);
      $this->load->view('jobboldal');
      $this->load->view('footer');
    
    }    
  
  }

?>

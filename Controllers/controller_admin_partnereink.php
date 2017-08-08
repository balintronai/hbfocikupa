<?php

  class Admin_partnereink extends Base 
  {
  
    function Admin_partnereink() 
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
      
      if ($this->segment(3) == 'keptorles') $this->keptorles();
      if ($_POST) $this->valtozas();
      
      $this->index();
    
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function index() {
    
      $id = $this->segment(2);
      if( ! empty ($id)) {
	  $query = "SELECT name FROM partnerek WHERE id=$id";
	  $name = $this->db->get_row($query);
	  unlink("Application/Images/partnerek/".$name);
	  $query = "DELETE FROM partnerek WHERE id=$id";
	  $this->db->execute($query);
	  $this->forward("admin_partnereink");
	  }
      $kozosmobilhoz = FALSE;
      
      // megjelenitendo hir tartalma
      $query = "SELECT *
                FROM partnerek
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
      $this->load->view('admin_partnereink',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function valtozas() {
    
      $post = $this->db->input($_POST);
      $width = $post["width"];
      $height = $post["height"];
	  $link = $post["link"];
	  
      if ($_FILES) {
      
        $kep = $_FILES['kep'];
        
        if ($kep['error'] != 4) {
          
          if ($kep['error'] == 1) $this->hiba .= 'A megadott file ('.$kep['name'].') mérete túl nagy.<br />';
          elseif ($kep['error'] == 2) $this->hiba .= 'A megadott file ('.$kep['name'].') mérete túl nagy.<br />';
          elseif ($kep['error'] == 3) $this->hiba .= 'A megadott file ('.$kep['name'].') csak részben lett feltöltve.<br />';
          elseif ($kep['error'] == 6) $this->hiba .= 'Nincs temp mappa. Kérem keresse fel a rendszergazdát.<br />';
          elseif ($kep['error'] == 7) $this->hiba .= 'Nincs jogosultságom fájlt létrehozni. Kérem keresse fel a rendszergazdát. <br />';
          
          elseif ($kep['error'] == 0) {
          
            // beallitjuk az ertekeket es feltoltjuk a fileokat
            $this->img->set_new_name($kep['name']);
            $this->img->set_maxx(515);
            $this->img->set_maxy(515);
            $this->img->set_upload_folder('Application/Images/partnerek');
            $success = $this->img->copy_image($kep);
            
            if ($success) {
              $filename = $this->img->get_filename();
              $query = "INSERT INTO partnerek (name, width, height, link) VALUES ('$filename', '$width', '$height', '$link')";
              $this->db->execute($query);
            }
            
          }
          
        
        }
      
      }
    
    }
  
  }

?>

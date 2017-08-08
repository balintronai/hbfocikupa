<?php

  class Admin_fooldal_hirdetesek extends Base 
  {
  
    function Admin_fooldal_hirdetesek() 
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
	  
	  if( ! empty ($id)) {
	  $query = "SELECT name FROM fooldal_hirdetes WHERE id=$id";
	  $name = $this->db->get_row($query);
	  unlink("Application/Images/hirdetesek/".$name);
	  $query = "DELETE FROM fooldal_hirdetes WHERE id=$id";
	  $this->db->execute($query);
	  $this->forward("admin_fooldal_hirdetesek");
	  }
	  
      $kozosmobilhoz = FALSE;
      
      $o['hiba'] = $this->hiba;
      $o['uzenet'] = $this->uzenet;
      
      
      $this->head->set_title('Hírdetések',TRUE);
      $this->head->set_head_full();
      $this->head->add_css('admin.css');
      $this->head->add_css('jquery-ui-1.8.21.custom.min.css');
      $this->head->add_javascript('ckeditor/ckeditor.js');
      $this->head->add_javascript('jquery.ui.core.js');
      $this->head->add_javascript('jquery.ui.datepicker.js');
      $head = $this->head->get_head();
      
      $this->load->view('admin_head',$head);
      $this->load->view('admin_fooldal_hirdetesek',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function valtozas() {
    
      $post = $this->db->input($_POST);
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
            $this->img->set_upload_folder('Application/Images/hirdetesek');
            $success = $this->img->copy_image($kep);
            
            if ($success) {
              $filename = $this->img->get_filename();
              $query = "INSERT INTO fooldal_hirdetes (name, link) VALUES ('$filename', '$link')";
              $this->db->execute($query);
			  $this->forward('admin_fooldal_hirdetesek');
            }
            
          }
          
        
        }
      
      }
	  
	  
    
    }
    
  
  
  }

?>

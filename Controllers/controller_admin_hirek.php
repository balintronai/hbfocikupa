<?php

  class Admin_hirek extends Base 
  {
  
    function Admin_hirek() 
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
      $this->load->view('admin_hirek',$o);
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */

    public function valtozas() {
    
      $post = $this->db->input($_POST);
      
      if ($id = $this->segment(2)+0) {
        $query = "UPDATE focis_hirek 
                  SET hir_cim = '".$post['cim']."',
                      hir_szoveg1 = '".$post['szoveg1']."',
                      hir_szoveg2 = '".$post['szoveg2']."',
                      hir_datum = '".$post['datum']."',
                      hir_kategoria = '".$post['kategoria']."',
                      hir_aktiv = '".(isset($post['aktiv']) ? '1' : '0')."'
                  WHERE hir_id = '$id'";
        $this->db->execute($query);
      }
      else {
        $query = "INSERT INTO focis_hirek
                  VALUES (NULL,
                          '".$post['cim']."',
                          '".$post['szoveg1']."',
                          '".$post['szoveg2']."',
                          '',
                          '".$post['datum']."',
                          '".$post['kategoria']."',
                          '".(isset($post['aktiv']) ? '1' : '0')."')
                  ";
                        
        $this->db->execute($query);
        $id = mysql_insert_id(); 
      }
      
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
            $this->img->set_new_name($id);
            $this->img->set_maxx(515);
            $this->img->set_maxy(515);
            $this->img->set_upload_folder('Application/Galeria');
            $success = $this->img->copy_image($kep);
            
            if ($success) {
              $filename = $this->img->get_filename();
              $query = "UPDATE focis_hirek SET hir_kep = '$filename' WHERE hir_id = '$id'";
              $this->db->execute($query);
            }
            
          }
          
        
        }
      
      }
    
    }
    
/*
 * ------------------------------------------------------------------------------------------------
 */
    
    public function keptorles() {
    
      if ($id = $this->segment(2)+0) {
      
        $query = "SELECT hir_kep FROM focis_hirek WHERE hir_id = '$id'";
        $kepnev = $this->db->get_row($query,'hir_kep');
        
        unlink('Application/Galeria/'.$kepnev);
        
        $query = "UPDATE focis_hirek SET hir_kep = '' WHERE hir_id = '$id'";
        $this->db->execute($query);
        
      }
      
      $this->forward('admin_hirek/'.$id);
    
    }
  
  }

?>

<?php
/*
 * Nehany hasznos fuggveny, ami minden oldalnal hasznalatban van
 * ENNEL A PROJECTNEL NINCS HASZNALATBAN
 */

  class Segedfuggvenyek extends Base
  {
  
    function Segedfuggvenyek()
    {
      
      // include segitseg
      $this->load = new Load();
      $this->db = new Mysql();
    
    }
    
    public function get_bajnoksagok() {
    
      $query = "SELECT count(*) as darab 
                FROM focis_hirek
                WHERE hir_kategoria = 2 AND
                      hir_aktiv = 1 AND
                      hir_datum > NOW()
               ";
      $darab = $this->db->get_row($query,'darab');
      
      return $darab;
    
    }
    
    
  }

?>

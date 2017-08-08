<?php

class Naptar extends Base {

  function Naptar() {
    // session segitseg
    $this->session = new Session();

    // include segitseg
    $this->load = new Load();

    // db segitseg
    $this->load->model('mysql');
    $this->db = new Mysql();

    $this->setNaptar();
  }

  /*
   * ------------------------------------------------------------------------------------------------
   */

  public function setNaptar() {
    $getHonap = $this->db->input($this->segment(2));

    // ha nincs parameterben semmi sem akkor jelenlegi honap kell
    if (!$getHonap) {
      $getHonap = date('Y-m');
    }
    // datumma alakitjuk, hogy ay egyjegyuek 0-val kezdodjenek - kesobb tomboknel kelleni fog
    $ev = date('Y',  strtotime($getHonap));
    $honap = date('m',  strtotime($getHonap));
    
    $naptar['ev'] = $ev;
    $naptar['honap'] = $honap;

    // honap neve
    $honapokNevei = array('01' => 'Január',
        '02' => 'Február',
        '03' => 'Március',
        '04' => 'Április',
        '05' => 'Május',
        '06' => 'Június',
        '07' => 'Július',
        '08' => 'Augusztus',
        '09' => 'Szeptember',
        '10' => 'Október',
        '11' => 'November',
        '12' => 'December'
    );
    $naptar['honapNev'] = $honapokNevei[$honap];

    // honap elso napja
    $honapElsoNapja = mktime(0, 0, 0, $honap, 1, $ev);
    
    // melyik napra esik a honap elso napja
    $napok = array('Mon' => 'H',
        'Tue' => 'K',
        'Wed' => 'Sz',
        'Thu' => 'Cs',
        'Fri' => 'P',
        'Sat' => 'Szo',
        'Sun' => 'V',
    );
    $melyikNap = date('D', $honapElsoNapja);
    $naptar['melyikNap'] = $napok[$melyikNap];

    // Ha mar tudjuk h melyik napra esik akkor tudjuk azt is, hogy hany ures helynek kell lennie
    switch ($melyikNap) {
      case "Mon": $blank = 0;
        break;
      case "Tue": $blank = 1;
        break;
      case "Wed": $blank = 2;
        break;
      case "Thu": $blank = 3;
        break;
      case "Fri": $blank = 4;
        break;
      case "Sat": $blank = 5;
        break;
      case "Sun": $blank = 6;
        break;
    }
    $naptar['blank'] = $blank;
    
    // Hany nap van a honapban
    $naptar['napokSzama'] = cal_days_in_month(0, $honap, $ev) ;
    
    //This counts the days in the week, up to 7
    $naptar['day_count'] = 1;
    
    //sets the first day of the month to 1 
    $naptar['day_num'] = 1;


    // csinalunk belole egy datumot - ne legyen rossz formatumban meg veletlenul sem
    $vegsoDatum = date('Y-m', strtotime($ev . '-' . $honap));

    // lekerdezzuk van-e ehhez a datumhoz barmi esemeny
    $query = "SELECT * 
              FROM focis_hirek
              WHERE hir_aktiv = 1 AND
                    hir_datum like '$vegsoDatum%'
              ORDER BY hir_datum ";
    $result = $this->db->execute($query);

    // ha van eredmeny
    if ($result) {
      while ($row = mysql_fetch_assoc($result)) {
        // akkor minden esemenyt berakunk egy olyan tombbe, ahol a datum napja a kulcs
        $napokhoz = explode('-', $row['hir_datum']);
        $nap = $napokhoz[2];
        $naptar['esemenyek'][$nap][] = $row;
      }
    }
    
    $this->load->view('naptar',$naptar);
  }

}

?>

<?php

  class Admin_logout extends Base
  {
    function Admin_logout() {
      $this->session = new Session();
      $this->session->delete_all_session();
      $this->forward('fooldal');
    }
  }


?>

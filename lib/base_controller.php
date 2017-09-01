<?php

  class BaseController{

    //Kirjautuneen käyttäjän haku
    public static function get_user_logged_in() {
     
      if (isset($_SESSION['apteekki'])) {
        $apteekki_id = $_SESSION['apteekki'];
        $apteekki = Apteekki::find($apteekki_id);

        return $apteekki;
      }
      
      return null;
    }

    //Kirjautumisen tarkistus
    public static function check_logged_in() {
      
      if (!isset($_SESSION['apteekki'])) {
        Redirect::to('/kirjautuminen', array('message' => 'Sivuston käyttö edellyttää kirjautumista'));
    }

  }

}

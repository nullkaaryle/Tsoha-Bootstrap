<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

// Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
    public function errors(){
      $errors = array();

      foreach($this->validators as $validator){
        $virheet = $this->{$validator}();
        $errors = array_merge($errors, $virheet);
      }

      return $errors;
    }

    
    public function validoi_merkkijonon_pituus($merkkijono, $min_pituus, $max_pituus, $kohde){
      $virheet = array();

      if (strlen($merkkijono) < $min_pituus) {
            $virheet[] = $kohde . ' on oltava vähintään ' . $min_pituus . ' merkkiä pitkä.';
      }

      if (strlen($merkkijono) > $max_pituus) {
            $virheet[] = $kohde . ' on oltava enintään ' . $max_pituus . ' merkkiä pitkä.';
      }

      return $virheet;
    }


    public function validoi_merkkijonon_numeerisuus($merkkijono, $kohde){
      $virheet = array();

      if (ctype_digit($merkkijono)) {
            $virheet[] = $kohde . ' ei voi olla pelkkiä numeroita!';       
      }

      return $virheet;
    }


  }


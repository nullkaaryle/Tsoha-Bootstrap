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


//YLEISET VALIDOINTIMETODIT
/*    
    public function validate_string_length($string, $min_length, $max_length) {
      $errors = array();

      if(strlen($string) < $min_length) {
            $errors[] = 'Tallennettavan syötteen on oltava vähintään ' . $min_length . ' merkkiä pitkä';
      }

      if(strlen($string) > $max_length) {
            $errors[] = 'Tallennettavan syötteen on oltava enintään ' . $max_length . ' merkkiä pitkä';
      }

      return $errors;
    }
*/
    
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


    public function validate_string_numerics($string){
      $errors = array();

      if(is_int($string)) {
            $errors[] = 'Tallennettava syöte ei voi olla pelkkiä numeroita!';       
      }

      return $errors;
    }


  }


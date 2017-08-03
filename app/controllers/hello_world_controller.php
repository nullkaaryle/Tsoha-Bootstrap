<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      // echo 'Hello World!';
      View::make('helloworld.html');
    }

    public static function nayta_etusivu(){
      View::make('suunnitelmat/etusivu.html');
    }

    public static function nayta_kirjautuminen(){
      View::make('suunnitelmat/kirjautuminen.html');
    }

    public static function nayta_resepti(){
      View::make('suunnitelmat/resepti.html');
    }

    public static function nayta_reseptilistaus(){
      View::make('suunnitelmat/reseptilistaus.html');
    }

    public static function nayta_reseptinmuokkaus(){
      View::make('suunnitelmat/reseptinmuokkaus.html');
    }


    public static function nayta_laakelistaus(){
      View::make('suunnitelmat/laakelistaus.html');
    }

    public static function nayta_laake(){
      View::make('suunnitelmat/laake.html');
    }

    public static function nayta_laakkeenmuokkaus(){
      View::make('suunnitelmat/laakkeenmuokkaus.html');
    }

}
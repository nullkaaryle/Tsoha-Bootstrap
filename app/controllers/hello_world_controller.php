<?php

  class HelloWorldController extends BaseController{

    public static function sandbox(){
      // Testaa koodiasi täällä
      // echo 'Hello World!';
      //View::make('helloworld.html');
    }

    public static function index(){
      Redirect::to('/etusivu');
    }

    public static function nayta_etusivu(){
      View::make('/etusivu.html');
    }

}
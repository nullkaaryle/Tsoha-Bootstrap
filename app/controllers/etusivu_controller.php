<?php

class EtusivuController extends BaseController{


    public static function index(){
      Redirect::to('/etusivu');
    }

    public static function nayta_etusivu(){
      View::make('/etusivu.html');
    }

}
<?php

class LaakkeetController extends BaseController{

    public static function nayta_laakelistaus(){
        $laakkeet = Laake::all();
        View::make('laake/laakelistaus.html', array('laakkeet' => $laakkeet));
    }

    public static function nayta_laake($id){
        $laake = Laake::find($id);
        $laakkeenosat = Laakkeenosa::find_by_product_id($id);
        View::make('laake/laake.html', array('laake' => $laake, 'laakkeenosat' => $laakkeenosat));
    }

    public static function nayta_laakkeenlisays(){
        View::make('laake/laakkeenlisays.html');
    }


//    public static function nayta_laakkeenmuokkaus($id){
//        $laake = Laake::find($id);
//        View::make('laake/laakkeenmuokkaus.html', array('laake' => $laake));
//    }
  
}
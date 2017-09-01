<?php

class LaakkeetController extends BaseController{

    public static function nayta_laakelistaus(){
        $laakkeet = Laake::hae_kaikki();
        View::make('laake/laakelistaus.html', array('laakkeet' => $laakkeet));
    }

    public static function nayta_laake($id){
        $laake = Laake::hae($id);
        $laakkeenosat = Laakkeenosa::hae_laakkeen_idlla($id);
        View::make('laake/laake.html', array('laake' => $laake, 'laakkeenosat' => $laakkeenosat));
    }

  
}
<?php

class LaakkeetController extends BaseController{

    public static function nayta_laakelistaus(){
        $laakkeet = Laake::all();
        View::make('laake/laakelistaus.html', array('laakkeet' => $laakkeet));
    }

    public static function nayta_laake($id){
        $laake = Laake::find($id);
        //$laakkeenosat = Laake::find_laakkeenosat($id);
        //View::make('suunnitelmat/laake/laake.html', array('laake' => $laake, 'laakkeenosat' => $laakkeenosat));
        View::make('laake/laake.html', array('laake' => $laake));
    }

    
}
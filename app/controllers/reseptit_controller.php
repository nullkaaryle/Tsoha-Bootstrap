<?php

class ReseptitController extends BaseController{

    public static function nayta_reseptilistaus(){
        $reseptit = Resepti::all();
        View::make('resepti/reseptilistaus.html', array('reseptit' => $reseptit));
    }

    public static function nayta_resepti($id){
        $resepti = Resepti::find($id);
        View::make('resepti/resepti.html', array('resepti' => $resepti));
    }

    public static function nayta_reseptinlisays(){
        $potilaat = Potilas::all();
        $laakarit = Laakari::all();
        $laakkeet = Laake::all();
        View::make('resepti/reseptinlisays.html', array('potilaat' => $potilaat, 'laakarit' => $laakarit, 'laakkeet' => $laakkeet));
    }

    public static function tallenna_resepti(){
        $params = $_POST;
        //Kint::dump($params);
        
        $apteekki = $params['apteekki'];
        $potilas = $params['potilas'];
        $laakari = $params['laakari'];
        $laake = $params['laake'];
        $ohje = $params['ohje'];

        $resepti = new Resepti(array(
            'apteekki' => $apteekki,
            'potilas' => $potilas,
            'laakari' => $laakari,
            'laake' => $laake,
            'ohje' => $ohje
        )); 

        $errors = $resepti->errors();

        if (count($errors) == 0) {
            $resepti -> save();
            Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Uusi resepti tallennettu!'));
        } else {
            View::make('resepti/reseptinlisays.html', array('errors' => $errors, 'resepti' => $resepti));
        }
    }



}

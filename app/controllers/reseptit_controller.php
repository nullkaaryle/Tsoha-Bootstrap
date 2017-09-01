<?php

class ReseptitController extends BaseController{

    public static function nayta_reseptilistaus(){
        $reseptit = Resepti::hae_kaikki();
        View::make('resepti/reseptilistaus.html', array('reseptit' => $reseptit));
    }

    public static function nayta_resepti($id){
        $resepti = Resepti::hae($id);
        View::make('resepti/resepti.html', array('resepti' => $resepti));
    }


    public static function nayta_reseptinlisays(){
        $potilaat = Potilas::hae_kaikki();
        $laakarit = Laakari::hae_kaikki();
        $laakkeet = Laake::hae_kaikki();
        View::make('resepti/reseptinlisays.html', array('potilaat' => $potilaat, 'laakarit' => $laakarit, 'laakkeet' => $laakkeet));
    }


    public static function tallenna_resepti(){
        $params = $_POST;
        
        $apteekki = $params['apteekki'];
        $potilas = $params['potilas'];
        $laakari = $params['laakari'];
        $laake = $params['laake'];
        $ohje = $params['ohje'];

        $potilaat = Potilas::hae_kaikki();
        $laakarit = Laakari::hae_kaikki();
        $laakkeet = Laake::hae_kaikki();

        $resepti = new Resepti(array(
            'apteekki' => $apteekki,
            'potilas' => $potilas,
            'laakari' => $laakari,
            'laake' => $laake,
            'ohje' => $ohje
        )); 

        $errors = $resepti->errors();

        if (count($errors) == 0) {
            $resepti -> tallenna();
            Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Uusi resepti tallennettu!'));
        } else {
            View::make('resepti/reseptinlisays.html', array('errors' => $errors, 'resepti' => $resepti, 'potilaat' => $potilaat, 'laakarit' => $laakarit, 'laakkeet' => $laakkeet));
        }
        
    }


    public static function nayta_reseptinmuokkaus($id){
        $resepti_idt = Resepti::hae_idt($id);
        $resepti = Resepti::hae($id);
        $potilaat = Potilas::hae_kaikki();
        $laakarit = Laakari::hae_kaikki();
        $laakkeet = Laake::hae_kaikki();
        View::make('resepti/reseptinmuokkaus.html', array('resepti_idt' => $resepti_idt, 'resepti' => $resepti, 'potilaat' => $potilaat, 'laakarit' => $laakarit, 'laakkeet' => $laakkeet));
    }


    public static function muokkaa_reseptia($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'apteekki' => $params['apteekki'],
            'potilas' => $params['potilas'],
            'laakari' => $params['laakari'],
            'laake' => $params['laake'],
            'ohje' => $params['ohje'],
            'paivamaara' => $params['paivamaara'],
        );

        $resepti = new Resepti($attributes);
        
        $errors = $resepti->errors();

        if (count($errors) > 0) {
            View::make('resepti/reseptinmuokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $resepti->paivita();
            Redirect::to('/reseptit/' . $resepti->id, array('message' => 'Reseptiä on muokattu onnistuneesti!'));
        } 
        
    }


    public static function poista_resepti($id){
        $resepti = new Resepti(array(
            'id' => $id));
        $resepti->poista();
        Redirect::to('/reseptit', array('message' => 'Resepti on poistettu onnistuneesti!'));
    }



}

<?php

class ApteekitController extends BaseController{


    public static function nayta_kirjautuminen(){
        View::make('kirjautuminen.html');
    }


    public static function kirjaudu_sisaan(){
        $params = $_POST;
        $nimi = 'nimi';
        $kayttajatunnus = $params['kayttajatunnus'];
        $salasana = $params['salasana'];
        
        $testi_apteekki = new Apteekki(array(
            'nimi' => $nimi,
            'kayttajatunnus' => $kayttajatunnus,
            'salasana' => $salasana
        ));

        $errors = $testi_apteekki->errors();

        if (count($errors) > 0) {
            View::make('kirjautuminen.html', array('errors' => $errors, 'kayttajatunnus' => $params['kayttajatunnus']));
        }

        $apteekki = Apteekki::authenticate($kayttajatunnus, $salasana);

        if (!$apteekki) {
            View::make('kirjautuminen.html', array('message' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['apteekki'] = $apteekki->id;
            Redirect::to('/reseptit', array('message' => 'Tervetuloa ' . $apteekki->nimi . '!'));
        }

    }


    public static function kirjaudu_ulos() {
        $_SESSION['apteekki'] = null;
        Redirect::to('/etusivu', array('message' => 'Olet kirjautunut ulos.'));
    }
}
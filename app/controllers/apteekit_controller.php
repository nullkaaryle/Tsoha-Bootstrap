<?php

class ApteekitController extends BaseController{

    public static function nayta_kirjautuminen(){
        View::make('kirjautuminen.html');
    }

    public static function kirjaudu_sisaan(){
        $params = $_POST;
        $apteekki = Apteekki::authenticate($params['kayttajatunnus'], $params['salasana']);

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
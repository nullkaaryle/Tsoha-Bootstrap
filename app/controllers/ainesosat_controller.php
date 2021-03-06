<?php

class AinesosatController extends BaseController{


    public static function nayta_ainesosalistaus(){
        $ainesosat = Ainesosa::hae_kaikki();
        View::make('ainesosa/ainesosalistaus.html', array('ainesosat' => $ainesosat));
    }


    public static function nayta_ainesosa($id){
        $ainesosa = Ainesosa::hae($id);
        View::make('ainesosa/ainesosa.html', array('ainesosa' => $ainesosa));
    }


    public static function nayta_ainesosanlisays(){
        View::make('ainesosa/ainesosanlisays.html');
    }


    public static function tallenna_ainesosa(){
        $params = $_POST;
        $ainesosa = new Ainesosa(array(
            'aine' => $params['aine'])); 
        
        $errors = $ainesosa->errors();

        if (count($errors) == 0) {
            $ainesosa -> tallenna();
            Redirect::to('/ainesosat/' . $ainesosa->id, array('message' => 'Uusi ainesosa tallennettu!'));
       
        } else {
            View::make('ainesosa/ainesosanlisays.html', array('errors' => $errors, 
                                                            'ainesosa' => $ainesosa));
        }
    }


    public static function nayta_ainesosanmuokkaus($id){
        $ainesosa = Ainesosa::hae($id);
        View::make('ainesosa/ainesosanmuokkaus.html', array('ainesosa' => $ainesosa));
    }


    public static function muokkaa_ainesosaa($id){
        $params = $_POST;
        $aine = $params['aine'];
        
        $attributes = array(
            'id' => $id,
            'aine' => $aine,);

        $ainesosa = new Ainesosa($attributes);
        $errors = $ainesosa->errors();

        if (count($errors) > 0) {
            View::make('ainesosa/ainesosanmuokkaus.html', array('errors' => $errors, 'ainesosa' => $ainesosa));
        
        } else {
            $ainesosa->paivita();
            Redirect::to('/ainesosat/' . $ainesosa->id, array('message' => 'Ainesosaa on muokattu onnistuneesti!'));
        } 
    }


    public static function poista_ainesosa($id){
        $ainesosa = new Ainesosa(array(
            'id' => $id));

        $errors = array();
        $laakkeenosat = array();
        $laakkeenosat[] = Laakkeenosa::hae_ainesosan_idlla($id);
        $laakkeenosat = array_filter($laakkeenosat);

        if(!empty($laakkeenosat)) {
            $errors[] = 'Ainesosa on liitetty lääkkeeseen, joten sitä ei voida poistaa.';
        }
       
        if (count($errors) > 0) {
             Redirect::to('/ainesosat/' . $ainesosa->id, array('errors' => $errors));
        
        } else {
            $ainesosa->poista();
            Redirect::to('/ainesosat', array('message' => 'Ainesosa on poistettu onnistuneesti!'));
        }
    }

}
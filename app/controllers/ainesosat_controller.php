<?php

class AinesosatController extends BaseController{

    public static function nayta_ainesosalistaus(){
        $ainesosat = Ainesosa::all();
        View::make('ainesosa/ainesosalistaus.html', array('ainesosat' => $ainesosat));
    }

    public static function nayta_ainesosa($id){
        $ainesosa = Ainesosa::find($id);
        View::make('ainesosa/ainesosa.html', array('ainesosa' => $ainesosa));
    }

    public static function nayta_ainesosanlisays(){
        View::make('ainesosa/ainesosanlisays.html');
    }

    public static function tallenna_ainesosa(){
        $params = $_POST;
        $ainesosa = new Ainesosa(array(
            'aine' => $params['aine']
        )); 

        $errors = $ainesosa->errors();

        if(count($errors) == 0) {
            $ainesosa -> save();
            Redirect::to('/ainesosat/' . $ainesosa->id, array('message' => 'Ainesosa tallennettu!'));
        }else{
            View::make('ainesosa/ainesosanlisays.html', array('errors' => $errors, 'ainesosa' => $ainesosa));
        }
    }

    public static function nayta_ainesosanmuokkaus($id){
        $ainesosa = Ainesosa:find($id);
        View::make('ainesosa/ainesosanmuokkaus.html', array('ainesosa' => $ainesosa));
    }

    public static function muokkaa_ainesosaa($id){
        $params = $_POST;
        $ainesosa = new Ainesosa(array(
            'aine' => $params['aine']
        ));
        $errors = $ainesosa->errors();

        if(count($errors) > 0) {
            View::make('ainesosa/ainesosanmuokkaus.html', array('errors' => $errors, 'ainesosa' => $ainesosa));
        }else{
            $ainesosa->update();
            Redirect::to('/ainesosat/' . $ainesosa->id, array('message' => 'Ainesosaa on muokattu onnistuneesti!'));
        } 
    }

    public static function poista_ainesosa($id){
        $ainesosa = new Ainesosa(array(
            'id' => $id));
        $ainesosa->destroy();
        Redirect::to('/ainesosat', array('message' => 'Ainesosa on poistettu onnistuneesti!'));
    }

}
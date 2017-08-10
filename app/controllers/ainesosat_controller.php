<?php

class AinesosatController extends BaseController{

    public static function nayta_ainesosalistaus(){
        $ainesosat = Ainesosa::all();
        View::make('suunnitelmat/ainesosa/ainesosalistaus.html', array('ainesosat' => $ainesosat));
    }

    public static function nayta_ainesosa($id){
        $ainesosa = Ainesosa::find($id);
        View::make('suunnitelmat/ainesosa/ainesosa.html', array('ainesosa' => $ainesosa));
    }

    public static function nayta_ainesosanlisays(){
        View::make('suunnitelmat/ainesosa/ainesosanlisays.html');
    }

    public static function tallenna_ainesosa(){
        $params = $_POST;
        $ainesosa = new Ainesosa(array(
            'aine' => $params['aine']
        )); 

        $ainesosa -> save();

        Redirect::to('/ainesosat/' . $ainesosa->id, array('message' => 'Ainesosa tallennettu!'));
    }

}
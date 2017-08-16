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
        View::make('resepti/reseptinlisays.html');
    }

}
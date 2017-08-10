<?php

class ReseptitController extends BaseController{

    public static function nayta_reseptilistaus(){
        $reseptit = Resepti::all();
        View::make('suunnitelmat/reseptilistaus.html', array('reseptit' => $reseptit));
    }

    public static function nayta_resepti($id){
        $resepti = Resepti::find($id);
        View::make('suunnitelmat/resepti/:id.html', array('resepti' => $resepti));
    }

}
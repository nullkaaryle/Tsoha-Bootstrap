<?php

class Apteekki extends BaseModel{

    public $id, $nimi, $kayttajatunnus, $salasana;

    public function __construct($attributes){
        parent::__construct($attributes);
//        $this->validators = array();
    }

    public static function authenticate($kayttajatunnus, $salasana){
        $query = DB::connection()->prepare('SELECT * 
                                            FROM Apteekki
                                            WHERE kayttajatunnus = :kayttajatunnus 
                                            AND salasana = :salasana
                                            LIMIT 1');
        
        $query->execute(array(
                            'kayttajatunnus' => $kayttajatunnus,
                            'salasana' => $salasana));
        
        $row = $query->fetch();

        if($row){
             $apteekki = new Apteekki(array(
                                        'id' => $row['id'],
                                        'nimi' => $row['nimi'],
                                        'kayttajatunnus' => $row['kayttajatunnus'],
                                        'salasana' => $row['salasana']
                                        ));
            return $apteekki;

        }else{
            return null;
        }
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Apteekki 
                                            WHERE id = :id 
                                            LIMIT 1');
        $query->execute(array(
                            'id' => $id));
        
        $row = $query->fetch();

        if($row){
            $apteekki = new Apteekki(array(
                                        'id' => $row['id'],
                                        'nimi' => $row['nimi'],
                                        'kayttajatunnus' => $row['kayttajatunnus'],
                                        'salasana' => $row['salasana']
                                        ));
            return $apteekki;
        }

        return null;
    }


}
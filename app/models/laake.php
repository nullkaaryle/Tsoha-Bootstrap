<?php

class Laake extends BaseModel{

    public $id, $tuotenimi, $pakkaus, $kayttoaihe;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Laake');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row){
            $laakkeet[] = new Laake(array(
                'id' => $row['id'],
                'tuotenimi' => $row['tuotenimi'],
                'pakkaus' => $row['pakkaus'],
                'kayttoaihe' => $row['kayttoaihe']
            ));
        }

        return $laakkeet;
    }


    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Laake WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $laake = new Laake(array(
                'id' => $row['id'],
                'tuotenimi' => $row['tuotenimi'],
                'pakkaus' => $row['pakkaus'],
                'kayttoaihe' => $row['kayttoaihe']
            ));

            return $laake;
        }

        return null;
    }
    
}
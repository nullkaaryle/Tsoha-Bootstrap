<?php

class Resepti extends BaseModel{

    public $id, $apteekki, $potilas, $laakari, $laake, $ohje, $paivamaara;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Resepti');
        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();

        foreach($rows as $row){
            $reseptit[] = new Resepti(array(
                'id' => $row['id'],
                'apteekki' => $row['apteekki'],
                'potilas' => $row['potilas'],
                'laakari' => $row['laakari'],
                'laake' => $row['laake'],
                'ohje' => $row['ohje'],
                'paivamaara' => $row['paivamaara']
            ));
        }

        return $reseptit;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Resepti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $resepti = new Resepti(array(
                'id' => $row['id'],
                'apteekki' => $row['apteekki'],
                'potilas' => $row['potilas'],
                'laakari' => $row['laakari'],
                'laake' => $row['laake'],
                'ohje' => $row['ohje'],
                'paivamaara' => $row['paivamaara']
            ));

            return $resepti;
        }

        return null;
    }
}
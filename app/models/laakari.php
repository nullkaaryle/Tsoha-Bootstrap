<?php

class Laakari extends BaseModel {

    public $id, $etunimi, $sukunimi, $tunnus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }


    public static function all() {
        $query = DB::connection()->prepare('SELECT * 
                                            FROM Laakari
                                            ORDER BY sukunimi');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row) {
            $laakarit[] = new Laakari(array(
                'id' => $row['id'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'tunnus' => $row['tunnus']
            ));
        }
        return $laakarit;
    }

}
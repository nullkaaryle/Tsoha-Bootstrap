<?php

class Potilas extends BaseModel {

    public $id, $etunimi, $sukunimi, $syntymaaika;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }


    public static function all() {
        $query = DB::connection()->prepare('SELECT * 
                                            FROM Potilas
                                            ORDER BY sukunimi');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row) {
            $potilaat[] = new Potilas(array(
                'id' => $row['id'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'syntymaaika' => $row['syntymaaika']
            ));
        }
        return $potilaat;
    }

}
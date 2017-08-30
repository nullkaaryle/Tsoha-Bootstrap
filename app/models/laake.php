<?php

class Laake extends BaseModel {

    public $id, $tuotenimi, $pakkaus, $kayttoaihe;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Laake');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row) {
            $laakkeet[] = new Laake(array(
                'id' => $row['id'],
                'tuotenimi' => $row['tuotenimi'],
                'pakkaus' => $row['pakkaus'],
                'kayttoaihe' => $row['kayttoaihe']
            ));
        }

        return $laakkeet;
    }

   


    public static function find($id) {
        $query = DB::connection()->prepare('SELECT  la.id,
                                                    la.tuotenimi,
                                                    la.pakkaus,
                                                    la.kayttoaihe,
                                                    ao.aine AS ainesosa,
                                                    lo.vahvuus AS vahvuus
                                            FROM Laake la
                                            INNER JOIN Laakkeenosa lo ON la.id = lo.laake
                                            INNER JOIN Ainesosa ao ON lo.ainesosa = ao.id 
                                            WHERE la.id = :id');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $laake = new Laake(array(
                'id'        => $row['id'],
                'tuotenimi' => $row['tuotenimi'],
                'pakkaus'   => $row['pakkaus'],
                'kayttoaihe' => $row['kayttoaihe'],
                'ainesosa' => $row['ainesosa'],
                'vahvuus' => $row['vahvuus']
            ));

            return $laake;
        }

        return null;
    }


    public static function find_laakkeenosat($id) {
       
        $query = DB::connection()->prepare('SELECT  la.id,
                                                    ao.aine AS ainesosa,
                                                    lo.vahvuus AS vahvuus
                                            FROM Laake la
                                            INNER JOIN Laakkeenosa lo ON la.id = lo.laake
                                            INNER JOIN Ainesosa ao ON lo.ainesosa = ao.id 
                                            WHERE la.id = :id');

        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $laake = new Laake(array(
                'id'        => $row['id'],
                'ainesosa' => $row['ainesosa'],
                'vahvuus' => $row['vahvuus']
            ));

            return $laake;
        }

        return null;
    }
     
    


    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Laake (aine) 
                                            VALUES (:aine) 
                                            RETURNING id');
        $query->execute(array(
                            'aine' => $this->aine));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    
    
}
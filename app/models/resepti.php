<?php

class Resepti extends BaseModel{

    public $id, $apteekki, $potilas, $laakari, $laake, $ohje, $paivamaara;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT r.id, 
                                                    ap.nimi AS apteekki, 
                                                    po.sukunimi AS potilas_sukunimi, 
                                                    po.etunimi AS potilas_etunimi, 
                                                    li.sukunimi AS laakari_sukunimi, 
                                                    li.etunimi AS laakari_etunimi, 
                                                    le.tuotenimi AS laake, 
                                                    r.ohje, 
                                                    r.paivamaara
                                            FROM Resepti r
                                            INNER JOIN Apteekki ap ON r.apteekki = ap.id
                                            INNER JOIN Potilas po ON r.potilas = po.id
                                            INNER JOIN Laakari li ON r.laakari = li.id
                                            INNER JOIN Laake le ON r.laake = le.id');

        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();

        foreach($rows as $row){
            $reseptit[] = new Resepti(array(
                'id'        =>  $row['id'],
                'apteekki'  =>  $row['apteekki'],
                'potilas'   =>  $row['potilas_sukunimi'] . ', ' . $row['potilas_etunimi'],
                'laakari'   =>  $row['laakari_sukunimi'] . ', ' . $row['laakari_etunimi'],
                'laake'     =>  $row['laake'],
                'ohje'      =>  $row['ohje'],
                'paivamaara' =>  $row['paivamaara']
            ));
        }

        return $reseptit;
    }


    public static function find($id){
        $query = DB::connection()->prepare('SELECT r.id, 
                                                    ap.nimi AS apteekki, 
                                                    po.sukunimi AS potilas_sukunimi, 
                                                    po.etunimi AS potilas_etunimi, 
                                                    li.sukunimi AS laakari_sukunimi, 
                                                    li.etunimi AS laakari_etunimi, 
                                                    le.tuotenimi AS laake, 
                                                    r.ohje, 
                                                    r.paivamaara
                                            FROM Resepti r
                                            INNER JOIN Apteekki ap ON r.apteekki = ap.id
                                            INNER JOIN Potilas po ON r.potilas = po.id
                                            INNER JOIN Laakari li ON r.laakari = li.id
                                            INNER JOIN Laake le ON r.laake = le.id
                                            WHERE r.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $resepti = new Resepti(array(
                'id'        => $row['id'],
                'apteekki'  =>  $row['apteekki'],
                'potilas'   =>  $row['potilas_sukunimi'] . ', ' . $row['potilas_etunimi'],
                'laakari'   =>  $row['laakari_sukunimi'] . ', ' . $row['laakari_etunimi'],
                'laake'     =>  $row['laake'],
                'ohje'      =>  $row['ohje'],
                'paivamaara' => $row['paivamaara']
            ));

            return $resepti;
        }

        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Resepti (
                                                            apteekki, 
                                                            potilas, 
                                                            laakari, 
                                                            laake, 
                                                            ohje, 
                                                            paivamaara) 
                                                    VALUES (
                                                            :apteekki, 
                                                            :potilas, 
                                                            :laakari, 
                                                            :laake, 
                                                            :ohje, 
                                                            :paivamaara) 
                                                    RETURNING id');
        $query->execute(array(
                            'apteekki'  => $this->apteekki, 
                            'potilas'   => $this->potilas,
                            'laakari'   => $this->laakari,
                            'laake'     => $this->laake,
                            'ohje'      => $this->ohje,
                            'paivamaara' => $this->paivamaara
                            ));
        $row = $query->fetch();

        $this->id = $row['id'];
    }
}
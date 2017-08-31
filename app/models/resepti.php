<?php

class Resepti extends BaseModel {

    public $id, $apteekki, $potilas, $laakari, $laake, $ohje, $paivamaara;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }


    public static function all() {
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
                                            ORDER BY r.id');

        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();

        foreach($rows as $row) {
            $reseptit[] = new Resepti(array(
                'id'        =>  $row['id'],
                'apteekki'  =>  $row['apteekki'],
                'potilas'   =>  $row['potilas_sukunimi'] . ', ' . $row['potilas_etunimi'],
                'laakari'   =>  $row['laakari_sukunimi'] . ', ' . $row['laakari_etunimi'],
                'laake'     =>  $row['laake'],
                'ohje'      =>  $row['ohje'],
                'paivamaara' => $row['paivamaara']
            ));
        }

        return $reseptit;
    }


    public static function find($id) {
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

        if ($row) {
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


    public static function find_ids($id) {
        $query = DB::connection()->prepare('SELECT r.id, 
                                                    ap.id AS apteekki, 
                                                    po.id AS potilas,
                                                    li.id AS laakari,
                                                    le.id AS laake, 
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

        if ($row) {
            $resepti = new Resepti(array(
                'id'        =>  $row['id'],
                'apteekki'  =>  $row['apteekki'],
                'potilas'   =>  $row['potilas'],
                'laakari'   =>  $row['laakari'],
                'laake'     =>  $row['laake'],
                'ohje'      =>  $row['ohje'],
                'paivamaara' => $row['paivamaara']
            ));

            return $resepti;
        }

        return null;
    }




    public function save() {
        $paivamaara = date("Y-m-d"); 
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
                            'paivamaara'=> $paivamaara
                            ));
        
        $row = $query->fetch();

        $this->id = $row['id'];
    }


    public function update() {
        $query = DB::connection()->prepare('UPDATE Resepti 
                                            SET potilas = :potilas,
                                                laakari = :laakari,
                                                laake = :laake,
                                                ohje = :ohje
                                            WHERE id = :id 
                                            RETURNING id');
        $query->execute(array(
                            'id'        => $this->id,    
                            'potilas'   => $this->potilas,
                            'laakari'   => $this->laakari,
                            'laake'     => $this->laake,
                            'ohje'      => $this->ohje
                            ));

        $row = $query->fetch();
        $this->id = $row['id'];
    }



    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Resepti 
                                            WHERE id = :id');
        $query->execute(array(
                            'id' => $this->id));
    }

}
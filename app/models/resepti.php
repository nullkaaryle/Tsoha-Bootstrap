<?php

class Resepti extends BaseModel {

    public $id, $apteekki, $potilas, $laakari, $laake, $ohje, $paivamaara;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_pituus');
    }


    public static function hae_kaikki() {
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
                                            ORDER BY    r.paivamaara DESC, 
                                                        r.id DESC');
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
                'paivamaara' => $row['paivamaara']));
        }

        return $reseptit;
    }


    public static function hae($id) {
        $query = DB::connection()->prepare('SELECT r.id, 
                                                    ap.nimi AS apteekki, 
                                                    po.sukunimi AS potilas_sukunimi, 
                                                    po.etunimi AS potilas_etunimi,
                                                    po.syntymaaika AS potilas_syntymaaika, 
                                                    li.sukunimi AS laakari_sukunimi, 
                                                    li.etunimi AS laakari_etunimi,
                                                    li.tunnus AS laakari_tunnus,
                                                    le.tuotenimi AS laake_tuotenimi,
                                                    le.pakkaus AS laake_pakkaus,
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
                'potilas'   =>  $row['potilas_sukunimi'] . ' ' . $row['potilas_etunimi'] . ', ' . $row['potilas_syntymaaika'],
                'laakari'   =>  $row['laakari_sukunimi'] . ' ' . $row['laakari_etunimi'] . ' - tunnus: ' . $row['laakari_tunnus'],
                'laake'     =>  $row['laake_tuotenimi'] . ' - ' . $row['laake_pakkaus'],
                'ohje'      =>  $row['ohje'],
                'paivamaara' => $row['paivamaara']));
            return $resepti;
        }

        return null;
    }


    public static function hae_idt($id) {
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
                'paivamaara' => $row['paivamaara']));
            return $resepti;
        }

        return null;
    }


    public function tallenna() {
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
                            'paivamaara'=> $paivamaara));
        $row = $query->fetch();
        $this->id = $row['id'];
    }


    public function paivita() {
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
                            'ohje'      => $this->ohje));
        $row = $query->fetch();
        $this->id = $row['id'];
    }



    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Resepti 
                                            WHERE id = :id');
        $query->execute(array(
                            'id' => $this->id));
    }

//VALIDOINTIMETODI
    public function validoi_pituus() {
        return parent::validoi_merkkijonon_pituus($this->ohje, 1, 100, 'Käyttöohjeen');  
    }


}
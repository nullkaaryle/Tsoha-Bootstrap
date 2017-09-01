<?php

class Ainesosa extends BaseModel {

    public $id, $aine;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_pituus','validoi_numerot');
    }


    public static function all() {
        $query = DB::connection()->prepare('SELECT * 
                                            FROM Ainesosa
                                            ORDER BY id');
        $query->execute();
        $rows = $query->fetchAll();
        $ainesosat = array();

        foreach($rows as $row) {
            $ainesosat[] = new Ainesosa(array(
                'id' => $row['id'],
                'aine' => $row['aine']
            ));
        }
        return $ainesosat;
    }


    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Ainesosa 
                                            WHERE id = :id 
                                            LIMIT 1');
        $query->execute(array(
                            'id' => $id));
        $row = $query->fetch();
        
        if ($row){
            $ainesosa = new Ainesosa(array(
                                        'id' => $row['id'],
                                        'aine' => $row['aine']));
            return $ainesosa;
        }
        return null;
    }


    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ainesosa (aine) 
                                            VALUES (:aine) 
                                            RETURNING id');
        $query->execute(array(
                            'aine' => $this->aine));
        $row = $query->fetch();
        $this->id = $row['id'];
    }


    public function update() {
        $query = DB::connection()->prepare('UPDATE Ainesosa 
                                            SET aine = :aine 
                                            WHERE id = :id 
                                            RETURNING id');
        $query->execute(array(
                            'aine'  => $this->aine,
                            'id'    => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }


    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Ainesosa 
                                            WHERE id = :id');
        $query->execute(array(
                            'id' => $this->id));
    }

//VALIDOINTIMETODIT

    public function validoi_pituus() {
        return parent::validoi_merkkijonon_pituus($this->aine, 5, 30, 'Ainesosan nimen');  
    }

    public function validoi_numerot() {
        return parent::validoi_merkkijonon_numeerisuus($this->aine, 'Ainesosan nimessä');  
    }



}